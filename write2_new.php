<?php
if ($_POST){

$video_base = explode(".", $_POST['video']);
array_pop($video_base);
$video_base = implode('.', $video_base);
$photo_base = explode(".", $_POST['photo']);
array_pop($photo_base);
$photo_base = implode('.', $photo_base);
$video = $_POST['video'];
$photo = $_POST['photo'];

date_default_timezone_set('UTC');
$today = date("Ymd"); 

$d1 = $_POST['duration_hour'];
$d2 = $_POST['duration_minute'];
$d3 = $_POST['duration_second'];
$duration = $d1.":".$d2.":".$d3;
$size = $_POST['size'];
$handle = fopen("write_view.php","a");
fwrite ($handle,"('".$video."', '".$photo."', '".$duration."', '".$size."', '".$today."', 'Free', '$0.00', 0),
");
fclose ($handle);}

?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width">
	<link id="stylecall" rel="stylesheet" href="/academic_style.css" />
	<link rel="icon" 
	  type="image/png" 
	  href="/img/d01.png">
</head>

<title>Dadiu | Write2</title>

<body>

<h2>Type the html in write_view.php</h2></br>
<h4>//rename video_file_name as same as the file name as code</h4>
<h4>//rename the photo name be the title with code</h4></br>
<h4>//check the ID first</h4></br>

<form action="" method="POST">
	Video (.mp4): <input name="video" TYPE="file">
	Photo (.jpg): <input name="photo" TYPE="file"></br>
	Size (need unit): <input name="size" TYPE="text"></br>
	Duration: <input name="duration_hour" TYPE="text"> :
	<input name="duration_minute" TYPE="text"> :
	<input name="duration_second" TYPE="text">
	<input type = "submit" value = "Post" name="Post"">
</form>

	
</body>
</html>
