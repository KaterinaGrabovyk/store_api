CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    price DECIMAL(10,2) UNSIGNED NOT NULL,
    amount int UNSIGNED  NOT NULL,
    in_stock BOOLEAN NOT NULL
);
