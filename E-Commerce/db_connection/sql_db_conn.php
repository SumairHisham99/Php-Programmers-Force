<?php

class DatabaseCreator {
    private $conn;
    
    public function __construct($servername, $username, $password) {
        $this->conn = new mysqli($servername, $username, $password);
    }
    
    public function createDatabase($dbname) {
        $result = $this->conn->query("SHOW DATABASES LIKE '$dbname'");
        
        if ($result->num_rows > 0) {
            $this->conn->select_db($dbname);
            echo "Connection established to existing database: $dbname";
        } else {
            $createDbQuery = "CREATE DATABASE $dbname";
            
            if ($this->conn->query($createDbQuery) === TRUE) {
                echo "Database created successfully.";
                $this->conn->select_db($dbname);
                echo "Connection established to newly created database: $dbname";
            } else {
                echo "Error creating database: " . $this->conn->error;
                return;
            }
            $this->createTables();
        }
    }
    
    public function createTables() {
        $sql1 = "CREATE TABLE users (
            id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            firstname VARCHAR(30) NOT NULL,
            lastname VARCHAR(30) NOT NULL,
            email VARCHAR(50),
            user_role ENUM('admin', 'customer'),
            reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";
        
        $sql2 = "CREATE TABLE category (
            id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            category_name VARCHAR(30) NOT NULL,
            category_type VARCHAR(30) NOT NULL,
            reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";
        
        $sql3 = "CREATE TABLE products (
            id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            product_name VARCHAR(30) NOT NULL,
            category_id INT UNSIGNED,
            reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            FOREIGN KEY (category_id) REFERENCES category(id)
        )";
        
        $sql4 = "CREATE TABLE orders (
            id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            customer_id INT UNSIGNED,
            product_id INT UNSIGNED,
            reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            FOREIGN KEY (customer_id) REFERENCES users(id),
            FOREIGN KEY (product_id) REFERENCES products(id)
        )";
        
        $sql5 = "CREATE TABLE order_details (
            id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            order_id INT UNSIGNED,
            customer_id INT UNSIGNED,
            product_id INT UNSIGNED,
            reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            FOREIGN KEY (order_id) REFERENCES users(id),
            FOREIGN KEY (customer_id) REFERENCES products(id),
            FOREIGN KEY (product_id) REFERENCES users(id)
        )";
        
        if ($this->conn->query($sql1) && $this->conn->query($sql2) && $this->conn->query($sql3) && $this->conn->query($sql4) && $this->conn->query($sql5)) {
            echo "Tables Users, Products, Category, Orders, Order Details created successfully!";
        } else {
            echo "Error creating table: " . $this->conn->error;
        }
    }
    
    public function closeConnection() {
        $this->conn->close();
    }
}

$servername = 'localhost';

if ($_SERVER["REQUEST_METHOD"]=='POST'){
        
    if($_POST['dbname']){
        $dbname = test_input($_POST['dbname']);
    }

    if($_POST['username']){
        $username = test_input($_POST['username']);
    }

    if(empty($_POST['password'])){
        $password = '';
    }
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Create a DatabaseCreator Object
$installer = new DatabaseCreator($servername, $username, $password);

// Create the database
$installer->createDatabase($dbname);

// Create the tables
// $installer->createTables();

// Close the connection
$installer->closeConnection();
?>
