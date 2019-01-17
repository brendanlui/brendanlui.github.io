
<?php
include 'config_database_value.php';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// sql to create table
$sql = "CREATE TABLE database_admins (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
username VARCHAR(20),
password VARCHAR(255),
firstname VARCHAR(20),
lastname VARCHAR(20),
mobile VARCHAR(8),
hkid VARCHAR(10),
email VARCHAR(50),
last_activity VARCHAR(20),
ip_address_used VARCHAR(255)
)";

if ($conn->query($sql) === TRUE) {
    echo "Table database_admins created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
?>
