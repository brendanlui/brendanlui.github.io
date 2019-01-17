<?php include 'get_ip_address_and_insert_in_database.php';?>
<?php
if( isset( $_POST["Upload"] ) )
{
	include 'config_database_value.php';
	$con=mysqli_connect($servername, $username, $password, $dbname);
	// Check connection
	if (mysqli_connect_errno())
	{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

	$result = mysqli_query($con,"SELECT * FROM database_comment");
	$code_real = "";
	while($row = mysqli_fetch_array($result))
	{
		$save = $row['id'];
		if( isset($_POST[$save]) ){	
			$GLOBALS['code_real'] = $row['keyword'];
			break;
		}
	}
	$code_user_type = $_POST['code'];
	if(strcmp($code_user_type,  $code_real) != 0)
		 echo "<script type='text/javascript'>alert('Not match code. Type again.');</script>";
	else{
		$target_path = "img/album/";
		$target_path = $target_path . basename( $_FILES['filename']['name']); 
		if(move_uploaded_file($_FILES['filename']['tmp_name'], $target_path)) {
			echo "<script type='text/javascript'>alert('Uploaded.');</script>";
			$photo = $_FILES['filename']['name'];
			$handle = fopen("album.php","a");
			fwrite ($handle,'	
				<div class="gallery">
				  <a target="_blank" href="/img/album/'.$photo.'">
					<img src="/img/album/'.$photo.'" alt="Forest" width="300" height="200">
				  </a>
				  <!-- <div class="desc"></div> -->
				</div>');
			fclose ($handle);	
		} else{
			 echo "<script type='text/javascript'>alert('There was an error uploading the file, please try again.');</script>";
		}
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width">
	<link id="stylecall" rel="stylesheet" href="/academic_style.css" />
	<link id="stylecall" rel="stylesheet" href="/logo_dadiu.css" />
	<link rel="icon" 
	  type="image/png" 
	  href="/img/d01.png">
	  <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
	  <script type="text/javascript" src="js/jquery.scrollTo.js"></script>
</head>

<title>Dadiu | Album</title>

<body>

<link id="stylecall" rel="stylesheet" href="/album_style.css" />

<body>	
	<div id="head">
	<a href="/">
		<div id="logo">
			<img src="/img/dadiu.png" alt="dai01" class="logo_dadiu">
		</div>	
	</a>
	</div>

	<h2>Album</h2></br>
	<h4>Welcome to upload any picture!</h4>
	<!--enctype="multipart/form-data" is for upload file -->
	<form method="post" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
		<input type="hidden" name="MAX_FILE_SIZE" value="640000" />
		<input type="file" name="filename" />
					<?php
					//echo data
					include 'config_database_value.php';
					$con=mysqli_connect($servername, $username, $password, $dbname);
					// Check connection
					if (mysqli_connect_errno())
					{
					echo "Failed to connect to MySQL: " . mysqli_connect_error();
					}

					$result = mysqli_query($con,"SELECT * FROM database_comment");

					$rand_num = rand(1, 11);
					while($row = mysqli_fetch_array($result))
					{
						if($rand_num == $row['id']){
							echo '
									</br><input type = "text" name = "code">
									<img src="/security_code_img/'.$row['photo'].'" class="code_img"><input type="hidden" name="'.$row['id'].'">
							';	
							break;
						}
					}
					mysqli_close($con);
					?>
		<input type="submit" value="Upload" name="Upload" />
	</form>
					
	
		
<div class="gallery">
  <a target="_blank" href="/img/album/banner.jpg">
	<img src="/img/album/banner.jpg" alt="Forest" width="300" height="200">
  </a>
  <!-- <div class="desc"></div> -->
</div>	
		
<div class="gallery">
  <a target="_blank" href="/img/album/dadiu.png">
	<img src="/img/album/dadiu.png" alt="Forest" width="300" height="200">
  </a>
  <!-- <div class="desc"></div> -->
</div>	
		
<div class="gallery">
  <a target="_blank" href="/img/album/dadiu-01.png">
	<img src="/img/album/dadiu-01.png" alt="Forest" width="300" height="200">
  </a>
  <!-- <div class="desc"></div> -->
</div>	
		
<div class="gallery">
  <a target="_blank" href="/img/album/d01.png">
	<img src="/img/album/d01.png" alt="Forest" width="300" height="200">
  </a>
  <!-- <div class="desc"></div> -->
</div>	
		
<div class="gallery">
  <a target="_blank" href="/img/album/dlogo.png">
	<img src="/img/album/dlogo.png" alt="Forest" width="300" height="200">
  </a>
  <!-- <div class="desc"></div> -->
</div>	
		
<div class="gallery">
  <a target="_blank" href="/img/album/IMG_2910.JPG">
	<img src="/img/album/IMG_2910.JPG" alt="Forest" width="300" height="200">
  </a>
  <!-- <div class="desc"></div> -->
</div>	
	
		
<div class="gallery">
  <a target="_blank" href="/img/album/new_icon_transparent.png">
	<img src="/img/album/new_icon_transparent.png" alt="Forest" width="300" height="200">
  </a>
  <!-- <div class="desc"></div> -->
</div>	
		
<div class="gallery">
  <a target="_blank" href="/img/album/new_icon_transparent2.png">
	<img src="/img/album/new_icon_transparent2.png" alt="Forest" width="300" height="200">
  </a>
  <!-- <div class="desc"></div> -->
</div>	
		
<div class="gallery">
  <a target="_blank" href="/img/album/ajax-loader.gif">
	<img src="/img/album/ajax-loader.gif" alt="Forest" width="300" height="200">
  </a>
  <!-- <div class="desc"></div> -->
</div>	
		
<div class="gallery">
  <a target="_blank" href="/img/album/500px-Broken_heart.svg.png">
	<img src="/img/album/500px-Broken_heart.svg.png" alt="Forest" width="300" height="200">
  </a>
  <!-- <div class="desc"></div> -->
</div>	
		
<div class="gallery">
  <a target="_blank" href="/img/album/heart_coming_soon.png">
	<img src="/img/album/heart_coming_soon.png" alt="Forest" width="300" height="200">
  </a>
  <!-- <div class="desc"></div> -->
</div>	
		
<div class="gallery">
  <a target="_blank" href="/img/album/heart_coming_soon_small.png">
	<img src="/img/album/heart_coming_soon_small.png" alt="Forest" width="300" height="200">
  </a>
  <!-- <div class="desc"></div> -->
</div>	
		
<div class="gallery">
  <a target="_blank" href="/img/album/fb-logo.png">
	<img src="/img/album/fb-logo.png" alt="Forest" width="300" height="200">
  </a>
  <!-- <div class="desc"></div> -->
</div>	
		
<div class="gallery">
  <a target="_blank" href="/img/album/home-cart.png">
	<img src="/img/album/home-cart.png" alt="Forest" width="300" height="200">
  </a>
  <!-- <div class="desc"></div> -->
</div>	
		
<div class="gallery">
  <a target="_blank" href="/img/album/spinner.gif">
	<img src="/img/album/spinner.gif" alt="Forest" width="300" height="200">
  </a>
  <!-- <div class="desc"></div> -->
</div>	
				<div class="gallery">
				  <a target="_blank" href="/img/album/no-image-found.jpg">
					<img src="/img/album/no-image-found.jpg" alt="Forest" width="300" height="200">
				  </a>
				  <!-- <div class="desc"></div> -->
				</div>	
				<div class="gallery">
				  <a target="_blank" href="/img/album/ajax-loader_black_bg.gif">
					<img src="/img/album/ajax-loader_black_bg.gif" alt="Forest" width="300" height="200">
				  </a>
				  <!-- <div class="desc"></div> -->
				</div>	
				<div class="gallery">
				  <a target="_blank" href="/img/album/ajax-loader_transparent_black_eat.gif">
					<img src="/img/album/ajax-loader_transparent_black_eat.gif" alt="Forest" width="300" height="200">
				  </a>
				  <!-- <div class="desc"></div> -->
				</div>	
				<div class="gallery">
				  <a target="_blank" href="/img/album/ajax-loader_transparent_bar.gif">
					<img src="/img/album/ajax-loader_transparent_bar.gif" alt="Forest" width="300" height="200">
				  </a>
				  <!-- <div class="desc"></div> -->
				</div>