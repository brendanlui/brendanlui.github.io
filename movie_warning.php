<?php include 'get_ip_address_and_insert_in_database.php';?>
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
</head>

<title>Dadiu | Home</title>

<link id="stylecall" rel="stylesheet" href="/movie_style.css" />
<link id="stylecall" rel="stylesheet" href="/movie_warning_style.css" />

<body>	
	<div id="head">
	<a href="/">
		<div id="logo">
			<img src="/img/dadiu.png" alt="dai01" class="logo_dadiu">
		</div>	
	</a>		
	</div>
	<div id="warning">
			<h2>Age Authentication</h2></br>
			<h3>You must be 18 or over to access this site.</h3>
			<h3>Before processing you must read and agree to the terms below.</h3>
			<iframe src="/movie_warning_message" class="movie_warning">
			  <p>Your browser does not support iframes.</p>
			</iframe>
			<h3>Are you aged 18 or over?</h3></br>
			
			
			<form class="yes_or_no" action="/movie_pre">
				<input type="submit" value="Yes" />
			</form>
			<form class="yes_or_no" action="/movie_no_pre">
				<input type="submit" value="No" />
			</form>
	</div>
	<ul id="foot">
	</br>
	<li>© Copyright 2017. All Rights Reserved.</li>
	</ul></br>
	
</body>

</html>