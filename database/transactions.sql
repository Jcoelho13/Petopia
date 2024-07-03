-- Transaction Functions
CREATE OR REPLACE PROCEDURE add_funds(IN input_user_id INT, IN input_payment_method_id INT, IN input_amount DECIMAL)
LANGUAGE plpgsql
AS $$
  DECLARE payment_amount DECIMAL(10, 2);
  BEGIN 
    BEGIN

      SET TRANSACTION ISOLATION LEVEL SERIALIZABLE;

      IF NOT EXISTS (SELECT 1 FROM User_PaymentMethod WHERE user_id = input_user_id AND paymentMethod_id = input_payment_method_id) THEN
        ROLLBACK;
        RAISE EXCEPTION 'Invalid user_id-payment_method_id pair: %-%', input_user_id, input_payment_method_id;
      END IF;

      payment_amount := input_amount;

      UPDATE "User"
      SET wallet = wallet + payment_amount
      WHERE id = input_user_id;

      COMMIT;

    END;

  END;
$$;

CREATE OR REPLACE PROCEDURE make_purchase(IN input_user_id INT, IN input_payment_method_id INT)
LANGUAGE plpgsql
AS $$
DECLARE 
  purchase_amount DECIMAL(10, 2);
  purchase_id INT;
  tracking_number INT;
  tracking_number_exists BOOLEAN;
BEGIN
  BEGIN
    SET TRANSACTION ISOLATION LEVEL SERIALIZABLE;

    SELECT SUM(price * quantity)
    INTO purchase_amount
    FROM CartDetail cart
    WHERE shoppingCart_id = (SELECT shoppingcart_id FROM "User" WHERE id = input_user_id);

    IF (SELECT wallet FROM "User" WHERE id = input_user_id) >= purchase_amount THEN
      UPDATE "User"
      SET wallet = wallet - purchase_amount
      WHERE id = input_user_id;

      tracking_number_exists := true;

      WHILE tracking_number_exists LOOP
        tracking_number := FLOOR(RANDOM() * 1000000);

        SELECT EXISTS (SELECT 1 FROM Purchase WHERE tracking_number = tracking_number)
        INTO tracking_number_exists;
      END LOOP;

      INSERT INTO Purchase (user_id, paymentMethod_id, tracking_status, tracking_number, "date")
      VALUES (input_user_id, input_payment_method_id, 'Pending', tracking_number, CURRENT_DATE)
      RETURNING id INTO purchase_id;

      COMMIT;

      -- Start a new transaction block to add the products in the cart to the purchase details
      BEGIN
        INSERT INTO PurchaseDetail (purchase_id, product_id, quantity)
        SELECT purchase_id, product_id, quantity
        FROM CartDetail
        WHERE user_id = input_user_id AND (SELECT stock FROM Product WHERE id = product_id) >= quantity;

        DELETE FROM CartDetail
        WHERE user_id = input_user_id;

        COMMIT;
      END; 

    ELSE
      RAISE EXCEPTION 'Insufficient funds to complete the purchase.';
    END IF;
  END; 
END;
$$;
