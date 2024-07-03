-- Performance Indexes

CREATE INDEX product_review ON review USING btree (product_id);
CLUSTER review USING product_review;

CREATE INDEX user_purchase ON purchase USING hash (user_id);

CREATE INDEX user_notification ON notification USING hash (user_id);

-- Full Text Search Index

ALTER TABLE Product
    ADD COLUMN tsv_vector TSVECTOR;
UPDATE Product SET tsv_vector = to_tsvector('english', "name" || ' ' || description);

CREATE OR REPLACE FUNCTION product_update_tsv_vector() RETURNS TRIGGER AS $$
BEGIN
    IF (TG_OP = 'INSERT') THEN
        NEW.tsv_vector = (
            setweight(to_tsvector('english', NEW.name), 'A') ||
            setweight(to_tsvector('english', NEW.description), 'B')
        );

    ELSEIF (TG_OP = 'UPDATE') THEN
        IF (NEW.name <> OLD.name) OR (NEW.description <> OLD.description)  THEN
            NEW.tsv_vector = (
                setweight(to_tsvector('english', NEW.name), 'A') ||
                setweight(to_tsvector('english', NEW.description), 'B')
            );
END IF;
END IF;
RETURN NEW;
END;
$$
LANGUAGE plpgsql;

CREATE TRIGGER product_update_tsv_vector_trigger
    BEFORE INSERT OR UPDATE ON product
                         FOR EACH ROW EXECUTE PROCEDURE product_update_tsv_vector();

CREATE INDEX products_tsv_idx ON product USING gin(tsv_vector);
