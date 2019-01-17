
<?php
include 'config_database_value.php';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// sql to create table
$sql = "CREATE TABLE database_notice (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
subject VARCHAR(20),
subject_mobile INT(8),
verb VARCHAR(20),
object VARCHAR(20),
object_mobile INT(8),
title NVARCHAR(20),
date VARCHAR(20),
read_or_unread VARCHAR(6),
record_id INT(6)
)";

if ($conn->query($sql) === TRUE) {
    echo "Table database_notice created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
?>
