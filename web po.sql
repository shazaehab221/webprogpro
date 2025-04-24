create schema web;
use web;
CREATE TABLE contact (
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    message TEXT NOT NULL
    
);
CREATE TABLE users (
    
    name VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password varchar(100) not null
);
CREATE TABLE menu_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    category VARCHAR(100) NOT NULL,  
    rating DECIMAL(2, 1) DEFAULT 0
);
INSERT INTO menu_items (name, price, category, rating)
VALUES
('Chocolate Croissant',  50, 'Croissants', 4.5),
('Classic Butter Croissant',  70, 'Croissants',  4.0),
('Almond Roll Croissant', 60, 'Croissants', 5.0),
('Chocolate Ganache Tart', 65, 'Tarts', 5.0),
('Fresh Strawberry Tart',  70, 'Tarts',  4.7),
('French Lemon Tart',  60, 'Tarts', 4.0),
('Chocolate Dream Crepe',  80, 'Crepes', 4.6),
('Ice Cream Sundae Crepe',  90, 'Crepes', 5.0),
('Berry Jam Crepe', 65, 'Crepes',  4.0);
CREATE TABLE cart (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    price DECIMAL(10,2),
    quantity INt,
    menu_item_id INT NOT NULL,  
   FOREIGN KEY (menu_item_id) REFERENCES menu_items(id) ON DELETE CASCADE
);
alter table user
drop foreign key cart_ibfk_1;
select *
from contact



