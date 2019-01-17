
<?php
include 'config_database_value.php';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// sql to create table
$sql = "CREATE TABLE database_ip (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
ip_address VARCHAR(20),
date VARCHAR(20),
page_name VARCHAR(40)
)";

if ($conn->query($sql) === TRUE) {
    echo "Table database_ip created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
?>
