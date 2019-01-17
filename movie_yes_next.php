<?php include 'get_ip_address_and_insert_in_database.php';?>
<?php 
    $url = $_GET['url'];
	$title = $_GET['title'];

	$id = $_GET['id'];
	$sql = "SELECT * FROM database_movie_yes WHERE id = '$id'";
	
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

	$sql = "UPDATE database_movie_yes SET viewcount='".$viewcount."' WHERE id=".$id."";

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
<style>
#title{
	color:black;
}
</style>
<title>Dadiu | Movie</title>

<link id="stylecall" rel="stylesheet" href="/movie_style.css" />
<link id="stylecall" rel="stylesheet" href="/movie_yes_style.css" />

<body>	
	<div id="head">
	<a href="movie_pre">
		<div id="logo">
			<img src="/img/dadiu.png" alt="dai01" class="logo_dadiu">
		</div>
	</a>
		<div id="title">
			<h1><?php echo "$title"; ?></h1></br>
		</div>
		
	</div>
	
	<div class="video_frame">
	
		<link href="http://vjs.zencdn.net/6.2.5/video-js.css" rel="stylesheet">
		
		<link id="stylecall" rel="stylesheet" href="/movie_yes_next_style.css" />
	  <!-- If you'd like to support IE8 -->
	  <script src="http://vjs.zencdn.net/ie8/1.1.2/videojs-ie8.min.js"></script>
	  <video id="my-video" class="video-js" controls preload="auto" data-setup="{}">
		<source src="<?php echo "$url"; ?>" type='video/mp4'>
		<p class="vjs-no-js">
		  To view this video please enable JavaScript, and consider upgrading to a web browser that
		  <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
		</p>
	  </video>
	  <script src="http://vjs.zencdn.net/6.2.5/video.js"></script>		
	</div>
</br>

			
</body>

</html>