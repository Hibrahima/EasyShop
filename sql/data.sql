
create database web_project_db;
CREATE USER 'ninja'@'localhost' IDENTIFIED BY '2Jb_Ub';
GRANT ALL PRIVILEGES ON web_project_db . * TO 'ninja'@'localhost';
FLUSH PRIVILEGES;

create table if not exists users(
id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
first_name varchar(255) NOT NULL,
last_name varchar(255) NOT NULL,
password varchar(255) NOT NULL,
email varchar(255) NOT NULL,
street varchar(255) NOT NULL,
postal_code varchar(255) NOT NULL,
city varchar(255) NOT NULL,
country varchar(255) NOT NULL,
credit_card_number varchar(255) NOT NULL,
cvc varchar(255) NOT NULL,
credit_card_expiry_date varchar(255) NOT NULL,
birthday varchar(255) NOT NULL
);

CREATE TABLE order_items(
id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
order_id INT NOT NULL,
product_id INT,
quantity INT NOT NULL,
variation_price float not null,
accesory_id int
);

create table if not exists orders(
id INT(11) AUTO_INCREMENT NOT NULL PRIMARY KEY,
user_id INT(11),
registered INT(11) NOT NULL,
order_date varchar(255) NOT NULL,
status varchar(20) NOT NULL,
session varchar(100),
total float NOT NULL,
delivery_id int(11) not null,
delivery_address_id int not null
);

create table if not exists products(
id INT(11) AUTO_INCREMENT NOT NULL PRIMARY KEY,
name varchar(255) NOT NULL,
image_url varchar(255) NOT NULL,
stock INT(11),
type varchar(30) NOT NULL,
category_id INT(11) NOT NULL,
price50_gr float not null,
price100_gr float not null,
price150_gr float not null
);

create table if not exists categories(
id INT(11) AUTO_INCREMENT NOT NULL PRIMARY KEY,
name varchar(50) NOT NULL
);

create table if not exists accesories(
id INT(11) AUTO_INCREMENT NOT NULL PRIMARY KEY,
name varchar(50) NOT NULL,
image_url varchar(255) NOT NULL,
price float NOT NULL,
category_id int not null,
type varchar(30) not null
);

create table if not exists delivery_address(
id INT(11) AUTO_INCREMENT NOT NULL PRIMARY KEY,
customer_first_name varchar(255) not null,
customer_last_name varchar(255) not null,
customer_email varchar(255) not null,
customer_country varchar(255) not null,
customer_city varchar(255)not null,
customer_postal_code varchar(255) not null,
customer_credit_card_number varchar(255) not null,
customer_cvc varchar(255) not null,
customer_credit_card_expiry_date varchar(255) not null
);



create table if not exists delivery_type(
id INT(11) AUTO_INCREMENT NOT NULL PRIMARY KEY,
name varchar(30) NOT NULL,
price float NOT NULL
);

create table if not exists online_users(
id int(11) AUTO_INCREMENT not null primary key,
name varchar(255) not null,
email varchar(255) not null
); 































