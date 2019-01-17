<?php include 'get_ip_address_and_insert_in_database.php';?>
<?php include 'config_logined.php';?>
<HTML>
<head>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width">
	<link id="stylecall" rel="stylesheet" href="/register_style.css" />
	<link id="stylecall" rel="stylesheet" href="/logo_dadiu.css" />
	<link id="stylecall" rel="stylesheet" href="/logined_style.css" />
	<link rel="icon" 
	  type="image/png" 
	  href="/img/d01.png">
	  
	<title>Dadiu | New Post</title>
</head>
<body>
	<div id="head">
		<div id="logo">
			<img src="/img/dadiu.png" style="width:300px;height:240px;">
		</div>
	</div>
	<div class="first_words">Here you can order everything!</div>
	<div class="sign_out">
		<p><a href="logout.php" class="btn btn-danger">Sign Out</a></p>
		<h6>*remember to sign out</h6>
	</div>
<?php

echo '
<div class="form_of">
	<form  method="POST" enctype="multipart/form-data" action="/logined_new_post_success.php">
	  <div class="container_new_post">
	  <label><b>Title</b></label></br>
		<input type="text" placeholder="Enter Title" name="title" maxlength="20" required></br>
		
		<label><b>Tag</b></label></br>
		<input type="text" placeholder="Enter Tag e.g #god#hand" name="category" maxlength="10" required></br>
		

		<label><b>Detail</b></label></br>
		<textarea rows ="10" cols ="30" type="text" placeholder="Enter Detail" name="detail" maxlength="200" required></textarea>
		</br>
		
		<label><b>Reward</b></label></br>
		<input type="text" placeholder="HK $" name="reward" maxlength="8" required>
		</br>
		
		<label><b>Photo</b></label></br>
		<input type="hidden" name="MAX_FILE_SIZE" value="640000" />
		<input type="file" name="filename" />
		</br>
		
		<input type = "submit" value = "Post"></br>
	  </div>
	</form>	
				<link id="stylecall" rel="stylesheet" href="/logined_dispear_back.css" />
					<form class="back_to_logined_next" action="/logined_next.php">
						<input type = "submit" value = "Cancel"></br>
					</form></br>
					<form class="back_to_logined" action="/logined.php">
						<input type = "submit" value = "Cancel"></br>
					</form></br>
</div>
';

	
?>	
</body>

</HTML>	