<?php include 'get_ip_address_and_insert_in_database.php';?>
<?php
if(isset($_GET['sort'])) {
	$sort = $_GET['sort'];
}else{
	$sort = "";
}
if(isset($_GET['time_name'])) {
	$time_name = $_GET['time_name'];
}else{
	$time_name = "";
}
if(isset($_GET['lang'])) {
	$lang = $_GET['lang'];
}else{
	$lang = "";
}
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

<title>Dadiu | Category</title>

<link id="stylecall" rel="stylesheet" href="/movie_style.css" />
<link id="stylecall" rel="stylesheet" href="/movie_yes_style.css" />
<link id="stylecall" rel="stylesheet" href="/movie_yes_pre_style.css" />
<link id="stylecall" rel="stylesheet" href="/loading_img_style.css" />
<style>
a.button{
	background-color:#fdebeb;
	border: 0px;
	padding-right: 50px;
	padding-left: 50px;
}
</style>
<body>	
	<div id="head">
	<a href="movie_pre">
		<div id="logo">
			<img src="/img/dadiu.png" alt="dai01" class="logo_dadiu">
		</div>	
	</a>
	</div>
	<div id="pre_movie_title">
		<h2>Category</h2>
	</div>
	
	<link id="stylecall" rel="stylesheet" href="/drop_list_style.css" />
	<div class="dropdown">
		<button class="dropbtn">
			<?php
				if($lang == "")
					echo"Language 語言";
				else{
					if(strcmp($lang,'en')==0)
						echo 'English';
					elseif(strcmp($lang,'zh')==0)
						echo '中文(繁體)';
				}
			?>
		</button>
		<div class="dropdown-content" style="left:0;">
		<?php
			echo'<a href="/movie_pre_category.php?sort='.$sort.'&time_name='.$time_name.'&lang=en" class="sort_button">English</a>';
			echo'<a href="/movie_pre_category.php?sort='.$sort.'&time_name='.$time_name.'&lang=zh" class="sort_button">中文(繁體)</a>';
		?>
	 </div>
	</div>

	
<?php
	$category_zh = array('肛交', '黑膚色' ,'口交','顏射','角色扮演','兩穴抽插','媚藥' ,'眼鏡誘惑','雜交','手交','H動畫','亂倫','女同性戀','按摩','自慰手淫','其他','乳交','公共場所/户外' ,'強姦' ,'雙性人' ,'SM變態虐待' ,'潮吹' ,'電車痴漢' ,'無碼' ,'制服誘惑' ,'尿尿' ,'白色膚色');
	$category = array('anal', 'black' ,'blowjob','bukkake','cosplay','doublePenetrate','drugged' ,'glasses','group','handjob','hentai','incest','lesbian','massage','masturbate','other','paizuri','public' ,'rape' ,'shemale' ,'sm' ,'squirt' ,'train' ,'uncensored' ,'uniform' ,'urinate' ,'white');
	if($lang == "" || strcmp($lang, 'en') == 0){
		for($i = 0; $i < sizeof($category); $i++){
			echo('<a href="/movie_pre.php?sort='.$sort.'&category_name='.$category[$i].'&time_name='.$time_name.'" class="button">'.ucfirst($category[$i]).'</a>');
		}
	}elseif(strcmp($lang, 'zh') == 0){
		for($i = 0; $i < sizeof($category); $i++){
			echo('<a href="/movie_pre.php?sort='.$sort.'&category_name='.$category[$i].'&time_name='.$time_name.'" class="button">'.$category_zh[$i].'</a>');
		}		
	}
?>	
</body>

</html>