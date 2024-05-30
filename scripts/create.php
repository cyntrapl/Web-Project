<?php
$host = "localhost";
$user = "root";
$password = "";

$conn = new mysqli($host, $user, $password);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "CREATE DATABASE IF NOT EXISTS music_store";
if ($conn->query($sql) !== TRUE) {
    echo "Error creating database: " . $conn->error . "<br>";
}

$conn->select_db("music_store");

$sql = "CREATE TABLE IF NOT EXISTS genres (
    genre_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL
)";
if ($conn->query($sql) !== TRUE) {
    echo "Error creating table 'genres': " . $conn->error . "<br>";
}

$sql = "CREATE TABLE IF NOT EXISTS item_types (
    type_id INT AUTO_INCREMENT PRIMARY KEY,
    type VARCHAR(50) NOT NULL
)";
if ($conn->query($sql) !== TRUE) {
    echo "Error creating table 'item_types': " . $conn->error . "<br>";
}

$sql = "CREATE TABLE IF NOT EXISTS artists (
    artist_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL
)";
if ($conn->query($sql) !== TRUE) {
    echo "Error creating table 'artists': " . $conn->error . "<br>";
}

$sql = "CREATE TABLE IF NOT EXISTS music_companies (
    company_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL
)";
if ($conn->query($sql) !== TRUE) {
    echo "Error creating table 'music_companies': " . $conn->error . "<br>";
}

$sql = "CREATE TABLE IF NOT EXISTS customers (
    customer_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    address VARCHAR(255) NOT NULL,
    phone VARCHAR(15) NOT NULL
)";
if ($conn->query($sql) !== TRUE) {
    echo "Error creating table 'customers': " . $conn->error . "<br>";
}

$sql = "CREATE TABLE IF NOT EXISTS employees (
    employee_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    position VARCHAR(50) NOT NULL,
    phone VARCHAR(15) NOT NULL
)";
if ($conn->query($sql) !== TRUE) {
    echo "Error creating table 'employees': " . $conn->error . "<br>";
}

$sql = "CREATE TABLE IF NOT EXISTS items (
    item_id INT AUTO_INCREMENT PRIMARY KEY,
    type_id INT,
    year YEAR,
    title VARCHAR(100) NOT NULL,
    artist_id INT,
    genre_id INT,
    company_id INT,
    unit_price DECIMAL(10, 2),
    FOREIGN KEY (type_id) REFERENCES item_types(type_id),
    FOREIGN KEY (artist_id) REFERENCES artists(artist_id),
    FOREIGN KEY (genre_id) REFERENCES genres(genre_id),
    FOREIGN KEY (company_id) REFERENCES music_companies(company_id)
)";
if ($conn->query($sql) !== TRUE) {
    echo "Error creating table 'items': " . $conn->error . "<br>";
}

$sql = "CREATE TABLE IF NOT EXISTS sales (
    sale_id INT AUTO_INCREMENT PRIMARY KEY,
    customer_id INT,
    employee_id INT,
    sale_date DATE,
    FOREIGN KEY (customer_id) REFERENCES customers(customer_id),
    FOREIGN KEY (employee_id) REFERENCES employees(employee_id)
)";
if ($conn->query($sql) !== TRUE) {
    echo "Error creating table 'sales': " . $conn->error . "<br>";
}

$sql = "CREATE TABLE IF NOT EXISTS sale_items (
    sale_item_id INT AUTO_INCREMENT PRIMARY KEY,
    sale_id INT,
    item_id INT,
    quantity INT,
    FOREIGN KEY (sale_id) REFERENCES sales(sale_id),
    FOREIGN KEY (item_id) REFERENCES items(item_id)
)";
if ($conn->query($sql) !== TRUE) {
    echo "Error creating table 'sale_items': " . $conn->error . "<br>";
}

$conn->close();
?>
