<?php include 'get_ip_address_and_insert_in_database.php';?>
<?php 
    $url = $_GET['url'];
	$title = $_GET['title'];
	
	$id = $_GET['id'];
	$sql = "SELECT * FROM database_movie_no WHERE id = '$id'";
	
	include 'config_database_value.php';
	$conn=mysqli_connect($servername, $username, $password, $dbname);
	// Check connection
	if (mysqli_connect_errno())
	{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

	$result = mysqli_query($conn, $sql);

	while($row = mysqli_fetch_array($result))
	{
		$viewcount = $row['viewcount'] + 1;
	}

	$sql = "UPDATE database_movie_no SET viewcount='".$viewcount."' WHERE id=".$id."";

	if (mysqli_query($conn, $sql)) {
		//echo "Record updated successfully";
	} else {
		echo "Error updating record: " . mysqli_error($conn);
	}

	mysqli_close($conn);
	
	
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width">
	<link id="stylecall" rel="stylesheet" href="/logo_dadiu.css" />
	<link rel="icon" 
	  type="image/png" 
	  href="/img/d01.png">
</head>

<title>Dadiu | Movie</title>

<link id="stylecall" rel="stylesheet" href="/movie_style.css" />

<body>	
	<div id="head">
	<a href="/">
		<div id="logo">
			<img src="/img/dadiu.png" alt="dai01" class="logo_dadiu">
		</div>
	</a>
		<div id="title">
			<h1><?php echo "$title"; ?></h1></br>
		</div>
		
	</div>
	
	<div class="video_frame">
		<video style="width:100%; display:block; margin:0 auto;" controls preload="auto" controlsList="nodownload">
			<source src="<?php echo "$url"; ?>" type="video/mp4">
		</video>
	</div>

			
			
			
</body>

</html>