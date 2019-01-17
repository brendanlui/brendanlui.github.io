<?php
include 'config_database_value.php';
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// sql to create table
$sql = "CREATE TABLE database_piano_code_right (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
name VARCHAR(50),
right_hand VARCHAR(30000)
)";

if ($conn->query($sql) === TRUE) {
    echo "Table database_piano_code_right created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
?>


<?php
include 'config_database_value.php';
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// sql to create table
$sql = "CREATE TABLE database_piano_code_left (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
name VARCHAR(50),
left_hand VARCHAR(30000)
)";

if ($conn->query($sql) === TRUE) {
    echo "Table database_piano_code_left created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
?>