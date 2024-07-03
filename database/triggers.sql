DROP TRIGGER IF EXISTS enforce_product_stock_before_add_to_cart ON CartDetail; -- TRIGGER01
DROP TRIGGER IF EXISTS decrease_product_stock_after_buy ON PurchaseDetail; -- TRIGGER02
DROP TRIGGER IF EXISTS delete_payment_method ON PaymentMethod; -- TRIGGER03
DROP TRIGGER IF EXISTS product_editor_trigger ON Product; -- TRIGGER04

-- TRIGGER01

CREATE OR REPLACE FUNCTION check_product_available_stock(product_id INT, quantity INT)
RETURNS BOOLEAN AS
$$
BEGIN
RETURN (SELECT stock FROM product WHERE id = product_id) >= quantity;
END;
$$
LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION check_available_product()
RETURNS TRIGGER AS
$$
BEGIN
    IF NOT check_product_available_stock(NEW.product_id, NEW.quantity) THEN
        RAISE EXCEPTION 'Product does not have enough stock.';
END IF;

RETURN NEW;
END;
$$
LANGUAGE plpgsql;

CREATE TRIGGER before_insert_product_in_cart
    BEFORE INSERT ON CartDetail
    FOR EACH ROW
    EXECUTE FUNCTION check_available_product();


-- TRIGGER02

CREATE OR REPLACE FUNCTION decrease_product_stock()
RETURNS TRIGGER AS
$$
BEGIN
UPDATE product
SET stock = stock - NEW.quantity
WHERE id = NEW.product_id;

RETURN NEW;
END;
$$
LANGUAGE plpgsql;

CREATE TRIGGER decrease_product_stock_after_buy
    AFTER INSERT
    ON PurchaseDetail
    FOR EACH ROW
    EXECUTE FUNCTION decrease_product_stock();


-- TRIGGER03

/* CREATE OR REPLACE FUNCTION delete_mbway_or_cc()
RETURNS TRIGGER AS
$$
BEGIN
DELETE FROM MBWay
    USING CreditCard
WHERE MBWay.id = CreditCard.id AND MBWay.id = OLD.id;

RETURN OLD;
END;
$$
LANGUAGE plpgsql;

CREATE TRIGGER delete_payment_method
    AFTER DELETE ON PaymentMethod
    FOR EACH ROW
    EXECUTE FUNCTION delete_mbway_or_cc();*/


-- TRIGGER04

CREATE OR REPLACE FUNCTION update_last_editor()
RETURNS TRIGGER AS
$$
DECLARE id_admin INT = 1; -- FAKE ID
BEGIN
    -- TODO: Find a way in PHP to insert the admin_id to the local variable above.
    -- SELECT current_setting('admin')::INT INTO id_admin;

INSERT INTO Editor (admin_id, product_id, "date")
VALUES (id_admin,
        NEW.id,
        CURRENT_DATE)
    ON CONFLICT (admin_id, product_id) DO UPDATE
                                              SET "date" = CURRENT_DATE;

RETURN NEW;
END;
$$
LANGUAGE plpgsql;

CREATE TRIGGER product_last_editor_trigger
    AFTER UPDATE ON Product
    FOR EACH ROW
    EXECUTE FUNCTION update_last_editor();


-- Purchase Notifications
CREATE OR REPLACE FUNCTION purchase_notification()
RETURNS TRIGGER AS $$
DECLARE
    purchase_notification_id INT;
BEGIN
    IF NEW.id IS NOT NULL THEN
        INSERT INTO PurchaseNotification (purchase_id, body)
        VALUES (NEW.id, 'The purchase with id ' || NEW.id || ' has been confirmed.')
        RETURNING id INTO purchase_notification_id;

        INSERT INTO Notification (user_id, is_read, notify_id, notify_type)
        VALUES (NEW.user_id, 0, purchase_notification_id, 'App\Models\Notifications\PurchaseNotification');
    END IF;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER after_purchase
AFTER INSERT ON Purchase
FOR EACH ROW
EXECUTE FUNCTION purchase_notification();


-- Tracking Status Notifications
CREATE OR REPLACE FUNCTION tracking_status_notification()
RETURNS TRIGGER AS $$
DECLARE
    product_notification_id INT;
BEGIN
    IF NEW.tracking_status <> OLD.tracking_status THEN
        INSERT INTO ProductNotification (product_id, body)
        VALUES (NEW.id, 'The tracking status of purchase ' || NEW.id || ' has been changed from ' || OLD.tracking_status || ' to ' || NEW.tracking_status || '.')
        RETURNING id INTO product_notification_id;

        INSERT INTO Notification (user_id, is_read, notify_id, notify_type)
        VALUES (NEW.user_id, 0, product_notification_id, 'App\Models\Notifications\ProductNotification');
    END IF;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER after_tracking_status
AFTER UPDATE OF tracking_status ON Purchase
FOR EACH ROW
EXECUTE FUNCTION tracking_status_notification();


-- Stock Change Notifications
CREATE OR REPLACE FUNCTION stock_change_notification()
RETURNS TRIGGER AS $$
DECLARE
    wishlist_user_id INT;
    product_wishlist_id INT;
    new_wishlist_notification_id INT;
    product_name TEXT;
BEGIN
    SELECT pw.wishlist_id, w.user_id
    INTO product_wishlist_id, wishlist_user_id
    FROM Product_WishList pw
    JOIN WishList w ON pw.wishlist_id = w.id
    WHERE pw.product_id = NEW.id;

    SELECT name
    INTO product_name
    FROM Product
    WHERE id = NEW.id;

    IF product_wishlist_id IS NOT NULL THEN
        IF OLD.stock = 0 AND NEW.stock > OLD.stock AND NEW.stock > 0 THEN
            INSERT INTO WishListNotification (wishlist_id, body)
            VALUES (product_wishlist_id, 'Go to your WishList! There are now ' || New.stock || ' ' || product_name || ' available.')
            RETURNING id INTO new_wishlist_notification_id;

            INSERT INTO Notification (user_id, is_read, notify_id, notify_type)
            VALUES (wishlist_user_id, 0, new_wishlist_notification_id, 'App\Models\Notifications\WishListNotification');
        END IF;
    END IF;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER after_stock_change
AFTER UPDATE OF stock ON Product
FOR EACH ROW
EXECUTE FUNCTION stock_change_notification();


-- Price Change Notifications
CREATE OR REPLACE FUNCTION price_change_notification()
RETURNS TRIGGER AS $$
DECLARE
    cart_user_id INT;
    cartdetail_id INT;
    shoppingcart_notification_id INT;
    product_name TEXT;
BEGIN
    SELECT cd.shoppingCart_id, sc.user_id
    INTO cartdetail_id, cart_user_id
    FROM ShoppingCart sc
    JOIN CartDetail cd ON sc.id = cd.shoppingCart_id
    WHERE cd.product_id = NEW.id;

    SELECT name
    INTO product_name
    FROM Product
    WHERE id = NEW.id;

    IF NEW.price <> OLD.price THEN
        INSERT INTO ShoppingCartNotification (shoppingCart_id, body)
        VALUES (cartdetail_id, 'The price of ' || product_name || ' has been changed from ' || OLD.price || ' to ' || NEW.price || '. Check your Shopping Cart!')
        RETURNING id INTO shoppingcart_notification_id;

        INSERT INTO Notification (user_id, is_read, notify_id, notify_type)
        VALUES (cart_user_id, 0, shoppingcart_notification_id, 'App\Models\Notifications\CartNotification');
    END IF;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER after_price_change
AFTER UPDATE OF price ON Product
FOR EACH ROW
EXECUTE FUNCTION price_change_notification();