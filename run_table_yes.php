
<?php
include 'config_database_value.php';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// sql to create table
$sql = "CREATE TABLE database_movie_yes (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
video NVARCHAR(1500),
photo NVARCHAR(500),
duration VARCHAR(10),
size VARCHAR(10),
date INT(8) NOT NULL,
state VARCHAR(10),
fee VARCHAR(6),
reg_date TIMESTAMP,
viewcount INT(10) UNSIGNED,
category NVARCHAR(100)
)";

if ($conn->query($sql) === TRUE) {
    echo "Table database_movie_yes created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
?>
