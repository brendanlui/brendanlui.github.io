
<?php
include 'config_database_value.php';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// sql to create table
$sql = "CREATE TABLE database_comment (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
photo VARCHAR(50),
keyword VARCHAR(6)
)";

if ($conn->query($sql) === TRUE) {
    echo "Table database_comment created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
?>

<?php
//need to comment avoid duplicate
include 'config_database_value.php';
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$link = mysqli_connect($servername, $username, $password, $dbname);
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
// Attempt insert query execution
$sql = "INSERT INTO database_comment (photo,keyword) VALUES
            ('epw_112.png', 'A84c0D'),
			('epw_132.png', '5Iv6D1'),
			('epw_189.png', 'LaV4sB'),
			('epw_001.png', 'wT25Hv'),
			('epw_002.png', 'Q6e8Jk'),
			('epw_003.png', 'gPf79c'),
			('epw_004.png', 'bv3Bz5'),
			('epw_005.png', '7DLe52'),
			('epw_006.png', 'K0hi84'),
			('epw_010.png', 'Jn64Rs'),
            ('epw_123.png', '6dn4Rx')";
if(mysqli_query($link, $sql)){
    echo "Records added successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
 
// Close connection
mysqli_close($link);
?>