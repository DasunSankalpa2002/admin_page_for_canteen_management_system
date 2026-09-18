create database canteen_admin_db;

USE canteen_admin_db;

CREATE TABLE items (
    item_id INT PRIMARY KEY auto_increment,
    item_name VARCHAR(100) NOT NULL,
    image_url VARCHAR(255),
    price DECIMAL(10, 2) NOT NULL,
    availability VARCHAR(20) NOT NULL
);

INSERT INTO items (item_id, item_name, image_url, price, availability) VALUES
(101, 'Rice and Curry', NULL, 350.00, 'Available'),
(102, 'Chicken Kottu', NULL, 500.00, 'Available'),
(103, 'Noodles', NULL, 400.00, 'Unavailable');


select * FROM items;

UPDATE items SET
                item_name = 'FRIED RICE',
                price = '800.00',
                availability = 'Available',
                image_url = 'null'
            WHERE item_id = 101;
            


CREATE TABLE user_details (
    user_id INT PRIMARY KEY auto_increment,
    user_name VARCHAR(100) NOT NULL,
    email VARCHAR(255),
    user_role VARCHAR(20) NOT NULL
);

select * FROM user_details;

DROP TABLE user_complaint; 



CREATE TABLE user_complaint (
    complaint_id INT PRIMARY KEY auto_increment,
    user_name VARCHAR(100) ,
    complaint VARCHAR(255),
    complaint_date DATETIME 
);


INSERT INTO user_complaint (complaint_id, user_name, complaint, complaint_date) VALUES
(201, 'Nimal Perera', 'My order was ready later than the estimated time.', '2026-07-26 12:30:00'),
(202, 'Amali Silva', 'The item shown as available was sold out.', '2026-07-26 12:42:00');


select * FROM user_complaint;

CREATE TABLE orders (
    order_id INT AUTO_INCREMENT PRIMARY KEY,
    order_date DATE NOT NULL,
    status VARCHAR(20) NOT NULL,
    total_amount DECIMAL(10,2) NOT NULL
);

INSERT INTO orders (order_date, status, total_amount) VALUES
('2026-07-24', 'Completed', 500.00),
('2026-07-24', 'Completed', 400.00),
('2026-07-24', 'Completed', 300.00),

('2026-07-25', 'Completed', 600.00),
('2026-07-25', 'Completed', 450.00),

('2026-07-26', 'Completed', 800.00),
('2026-07-26', 'Completed', 400.00);
