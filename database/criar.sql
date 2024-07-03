DROP SCHEMA IF EXISTS lbaw2396 CASCADE;
CREATE SCHEMA IF NOT EXISTS lbaw2396;
SET search_path TO lbaw2396;

DROP TABLE IF EXISTS ProductNotification;
DROP TABLE IF EXISTS PurchaseNotification;
DROP TABLE IF EXISTS WishListNotification;
DROP TABLE IF EXISTS ShoppingCartNotification;
DROP TABLE IF EXISTS Notification;
DROP TABLE IF EXISTS PurchaseDetail;
DROP TABLE IF EXISTS CartDetail;
DROP TABLE IF EXISTS Product_Category;
DROP TABLE IF EXISTS Purchase;
DROP TABLE IF EXISTS ShoppingCart;
DROP TABLE IF EXISTS Category;
DROP TABLE IF EXISTS CreditCard;
DROP TABLE IF EXISTS MBWay;
DROP TABLE IF EXISTS User_PaymentMethod;
DROP TABLE IF EXISTS PaymentMethod;
DROP TABLE IF EXISTS Editor;
DROP TABLE IF EXISTS Review;
DROP TABLE IF EXISTS Product_WishList;
DROP TABLE IF EXISTS Product;
DROP TABLE IF EXISTS WishList;
DROP TABLE IF EXISTS "users";
DROP TABLE IF EXISTS Admin;

CREATE TABLE WishList (
    id SERIAL PRIMARY KEY,
    user_id INT NOT NULL UNIQUE
);

CREATE TABLE ShoppingCart (
    id SERIAL PRIMARY KEY,
    user_id INT NOT NULL UNIQUE
);

CREATE TABLE "users" (
    id SERIAL PRIMARY KEY,
    email TEXT NOT NULL UNIQUE,
    "password" TEXT NOT NULL,
    "name" TEXT NOT NULL,
    profile_image TEXT DEFAULT '/image/profile.png',
    remember_token VARCHAR,
    is_admin INT NOT NULL DEFAULT 0,
    isbanned INT NOT NULL DEFAULT 0
);

CREATE TABLE Admin (
    id INT PRIMARY KEY REFERENCES "users" (id)
);

CREATE TABLE "user" (
    id INT PRIMARY KEY REFERENCES "users" (id),
    admin_id INT,
    wishlist_id INT,
    shoppingcart_id INT,
    wallet FLOAT NOT NULL DEFAULT 0 CHECK (wallet >= 0.00),
    FOREIGN KEY (admin_id) REFERENCES Admin (id),
    FOREIGN KEY (wishlist_id) REFERENCES WishList (id),
    FOREIGN KEY (shoppingcart_id) REFERENCES ShoppingCart (id)
);

CREATE TABLE tokens (
    id SERIAL PRIMARY KEY,
    token_value VARCHAR NOT NULL,
    is_active INT NOT NULL DEFAULT 1,
    user_id INT REFERENCES users(id)
);


CREATE TABLE Product (
    id SERIAL PRIMARY KEY,
    "name" TEXT NOT NULL,
    image TEXT NOT NULL,
    description TEXT NOT NULL,
    price DECIMAL(10,2) NOT NULL CHECK (price >= 0.00),
    tags TEXT,
    stock INT NOT NULL CHECK (stock >= 0)
);

CREATE TABLE Category (
    id SERIAL PRIMARY KEY,
    "name" TEXT NOT NULL UNIQUE
);

-- join table that represents the association between the Product and Category tables
CREATE TABLE Product_Category (
    product_id INT NOT NULL,
    category_id INT NOT NULL,
    PRIMARY KEY (product_id, category_id),
	FOREIGN KEY (category_id) REFERENCES Category (id),
    FOREIGN KEY (product_id) REFERENCES Product (id)
);


-- join table that represents the association between the Admin and Product tables
CREATE TABLE Editor (
    admin_id INT NOT NULL,
    product_id INT NOT NULL,
    "date" DATE NOT NULL DEFAULT CURRENT_DATE,
    PRIMARY KEY (admin_id, product_id),
    FOREIGN KEY (admin_id) REFERENCES Admin (id),
    FOREIGN KEY (product_id) REFERENCES Product (id)
);

CREATE TABLE Review (
    id SERIAL PRIMARY KEY,
    user_id INT NOT NULL,
    product_id INT NOT NULL,
    "date" DATE NOT NULL DEFAULT CURRENT_DATE,
    body TEXT,
    title TEXT,
    rating INT NOT NULL CHECK (rating > 0 AND rating <= 5),
    FOREIGN KEY (user_id) REFERENCES "users" (id),
    FOREIGN KEY (product_id) REFERENCES Product (id)
);


-- join table that represents the association between the Product and WishList tables
CREATE TABLE Product_WishList (
    product_id INT NOT NULL,
    wishlist_id INT NOT NULL,
    PRIMARY KEY (product_id, wishlist_id),
    FOREIGN KEY (product_id) REFERENCES Product (id),
    FOREIGN KEY (wishlist_id) REFERENCES WishList (id)
);

CREATE TABLE PaymentMethod (
    id SERIAL PRIMARY KEY,
    "name" TEXT NOT NULL
);

CREATE TABLE CreditCard (
    paymentMethod_id INT NOT NULL PRIMARY KEY,
    cvv TEXT NOT NULL,
    "number" TEXT NOT NULL,
    "date" DATE NOT NULL,
    FOREIGN KEY (paymentMethod_id) REFERENCES PaymentMethod (id)
    ON DELETE CASCADE
);

CREATE TABLE MBWay (
    paymentMethod_id INT NOT NULL PRIMARY KEY,
    phoneNumber TEXT NOT NULL,
    FOREIGN KEY (paymentMethod_id) REFERENCES PaymentMethod (id)
    ON DELETE CASCADE
);

CREATE TABLE Purchase (
    id SERIAL PRIMARY KEY,
    user_id INT NOT NULL,
    paymentMethod_id INT NOT NULL,
    tracking_status TEXT NOT NULL,
    tracking_number TEXT UNIQUE,
    "date" DATE NOT NULL DEFAULT CURRENT_DATE,
    "address" TEXT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES "users" (id),
    FOREIGN KEY (paymentmethod_id) REFERENCES PaymentMethod (id)
);

-- join table that represents the association between the Purchase and Product tables
CREATE TABLE PurchaseDetail (
    purchase_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL CHECK (quantity >= 0),
    price DECIMAL(10,2) NOT NULL CHECK (price >= 0.00),
    PRIMARY KEY (purchase_id, product_id),
    FOREIGN KEY (purchase_id) REFERENCES Purchase (id),
    FOREIGN KEY (product_id) REFERENCES Product (id)
);

-- join table that represents the association between the Product and ShoppingCart
CREATE TABLE CartDetail (
    shoppingCart_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL DEFAULT 0,
    PRIMARY KEY (shoppingCart_id, product_id),
    FOREIGN KEY (shoppingCart_id) REFERENCES ShoppingCart (id),
    FOREIGN KEY (product_id) REFERENCES Product (id)
);

-- join table that represents the association between the GlobalUser and PaymentMethod
CREATE TABLE User_PaymentMethod (
    user_id INT NOT NULL,
    paymentMethod_id INT NOT NULL,
    PRIMARY KEY (user_id, paymentMethod_id),
    FOREIGN KEY (user_id) REFERENCES "users" (id),
    FOREIGN KEY (paymentMethod_id) REFERENCES PaymentMethod (id)
);

CREATE TABLE Notification (
    id SERIAL PRIMARY KEY,
    "date" TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
    user_id INT NOT NULL,
    is_read INT NOT NULL DEFAULT 0,
    notify_type TEXT NOT NULL,
    notify_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES "users" (id)
);

CREATE TABLE PurchaseNotification (
    id SERIAL PRIMARY KEY,
    purchase_id INT NOT NULL,
    body TEXT NOT NULL,
    FOREIGN KEY (purchase_id) REFERENCES Purchase (id)
    ON DELETE CASCADE
);

CREATE TABLE ProductNotification (
    id SERIAL PRIMARY KEY,
    product_id INT NOT NULL,
    body TEXT NOT NULL,
    FOREIGN KEY (product_id) REFERENCES Product (id)
    ON DELETE CASCADE
);

CREATE TABLE WishListNotification (
    id SERIAL PRIMARY KEY,
    wishlist_id INT NOT NULL,
    body TEXT NOT NULL,
    FOREIGN KEY (wishlist_id) REFERENCES WishList (id)
    ON DELETE CASCADE
);

CREATE TABLE ShoppingCartNotification (
    id SERIAL PRIMARY KEY,
    shoppingCart_id INT NOT NULL,
    body TEXT NOT NULL,
    FOREIGN KEY (shoppingCart_id) REFERENCES ShoppingCart (id)
    ON DELETE CASCADE
);

CREATE TABLE UserStories (
    id serial PRIMARY KEY,
    number text NOT NULL,
    name text NOT NULL,
    priority text NOT NULL,
    description text NOT NULL
);

CREATE TABLE FAQ (
    id serial PRIMARY KEY,
    question text NOT NULL,
    answer text NOT NULL
);