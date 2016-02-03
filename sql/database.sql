DROP DATABASE IF EXISTS vitrine;
CREATE DATABASE vitrine;
use vitrine;
DROP TABLE IF EXISTS Products;
DROP TABLE  IF EXISTS Categories;
DROP TABLE  IF EXISTS Users;
DROP TABLE  IF EXISTS Address;
DROP TABLE  IF EXISTS Wishlists;
DROP TABLE  IF EXISTS Products_categories;
CREATE TABLE Products (
    id SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    name VARCHAR(40) NOT NULL,
    price INTEGER NOT NULL,
	short_desc VARCHAR(60),
	long_desc TEXT,
	updated_at DATETIME,
	created_at DATETIME,
    PRIMARY KEY (id)
);

CREATE TABLE Categories (
    id SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    name VARCHAR(40) NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE Users (
    id SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    name VARCHAR(40) NOT NULL,
    mail VARCHAR(40) NOT NULL,
	status VARCHAR(60),
    PRIMARY KEY (id)
);

CREATE TABLE Address (
    id SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    country VARCHAR(20) NOT NULL,
    address VARCHAR(60) NOT NULL,
	zip_code INTEGER NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE Wishlists (
    id SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    product_id SMALLINT UNSIGNED NOT NULL ,
	user_id SMALLINT UNSIGNED NOT NULL ,
    `order_list` VARCHAR(60) NOT NULL,
    PRIMARY KEY (id),
	FOREIGN KEY (user_id) REFERENCES Users(id),
	FOREIGN KEY (product_id) REFERENCES Products(id)
);

CREATE TABLE Products_categories (
    id SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    product_id SMALLINT UNSIGNED NOT NULL,
	category_id SMALLINT UNSIGNED NOT NULL,
    PRIMARY KEY (id),
	FOREIGN KEY (category_id) REFERENCES Categories(id),
	FOREIGN KEY (product_id) REFERENCES Products(id)
);          