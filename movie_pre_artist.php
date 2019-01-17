<?php include 'get_ip_address_and_insert_in_database.php';?>
<?php

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

<title>Dadiu | Artist</title>

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
	font-size:12px;
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
		<h2>Artist</h2>
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
			echo'<a href="/movie_pre_artist.php?lang=en" class="sort_button">English</a>';
			echo'<a href="/movie_pre_artist.php?lang=zh" class="sort_button">中文(繁體)</a>';
		?>
	 </div>
	</div>

	
<?php
	$artist_zh = array('AIKA','JULIA','RION','蒂亞','三上悠亞','三原穗香','上原花戀','並樹光','九重環奈','佐佐木明希'
			,'倉多真央','初川南','初美鈴','前田由美','加藤绫乃','古川伊織','吉澤明步','園田美櫻','夏川明'
			,'大島優香','天使萌','天海翼','妃月留衣','小島七海','小野寺梨纱','山岸逢花','川上奈奈美'
			,'希島爱理','希美真由','彩美旬果','愛葉渚','愛音瑪莉亞','推川悠里','明日花綺羅','星川光希'
			,'星野美優','杉浦杏奈','東凛','松本奈奈惠','松本美','桃乃木香奈','桐嶋莉乃','森川涼花','椎名空'
			,'榊梨梨亞','榮川乃亞','櫻由羅','櫻井綾','櫻空桃','水野朝陽','波多野結衣','波木遙','涼川絢音'
			,'瀨野雅','白石苿莉奈','百合咲潤美','相澤南','石原莉奈','神納花','秋元希','結月恭子','美竹涼子'
			,'舞島明里','若菜奈央','若葉加奈','葵司','蓮實克蕾雅','藤浦惠','西田卡莉娜'
			,'里美尤里婭','鈴村愛里','長谷川留衣','香椎梨亞','香苗玲音','香西咲','高橋祥子','麻生希','麻里梨夏');

	$artist = array('AIKA','JULIA','RION','蒂亞','三上悠亞','三原穗香','上原花戀','並樹','九重','佐佐木'
			,'倉多','初川','初美','前田由美','加藤绫乃','古川','吉澤明步','園田','夏川'
			,'大島','天使萌','天海','妃月','小島','小野寺','山岸','川上'
			,'希島','希美','旬果','愛葉','愛音','推川悠里','明日花','星川'
			,'星野','杉浦','東凛','松本奈','松本美','桃乃木','桐嶋','森川','椎名'
			,'榊梨','榮川','樱由','櫻井','櫻空','水野朝陽','波多野','波木','涼川'
			,'瀬野','白石苿莉奈','百合咲','相澤南','石原莉奈','神納花','秋元','結月恭子','美竹'
			,'舞島明里','若菜奈央','若葉加奈','葵','蓮實克蕾雅','藤浦惠','西田'
			,'里美','鈴村愛里','長谷川','香椎梨亞','香苗玲音','香西咲','高橋祥子','麻生希','麻里梨夏');

	$artist_en = array('AIKA','JULIA','RION','TIA','Mikami Yua','Honoka Mihara','Karen Uehara','Namiki Hikari','Kokonoe Kanna','Sasaki Nozomi'
			,'Kurata Mao','Minami Hatsukawa','Hatsumi Rin','Yumi Maeda','Ayano Kato','Iori Kogawa','Yoshizawa Akiho','Mion Sonoda','Natsukawa Akari'
			,'Yuka Oshima','Moe Amatsuka','Amami Tsubasa','Hizuki Rui','Nanami Kojima','Risa Onodera','Yamagishi Aika','Kawakami Nanami'
			,'Airi Kijima','Nozomi Mayu','Ayami Shunka','Samurai Porn','Aine Maria','Yuri Oshikawa','Kirara Asuka','Hoshikawa Mitsuki'
			,'Miyu Hoshino','Sugiura Anna','Azuma Rin','Matsumoto Nanae','Mei Matsumoto','Kana Momonogi','Rino Kirishima','Morikawa Anna','Sora Shiina'
			,'Sakaki Riria','Eikawa Noa','Sakura Yura','Sakurai Aya','Sakura Momo','Asahi Mizuno','Hatano Yui','Namiki Haruka','Ayane Suzukawa'
			,'Seno Miyabi','Shiraishi Marina','Urumi Yurisaki','Aizawa Minami','Ishihara Rina','Kano Hana','Marin Oumi','Yuzuki Kyoko','Kimoto Ryoko'
			,'Akari Mai','Nao Wakana','Wakaba Kana','Tsukasa Aoi','Hasumi Kurea','Fujiura Megu','Karina Nishida'
			,'Satomi Yuria','Suzumura Airi','Hasegawa Rui','Sayaka Miyabi','Kanae Renon','Saki Kouzai','Takahashi Shoko','Nozomi Aso','Urumi Narumi');

	if($lang == "" || strcmp($lang, 'en') == 0){
		for($i = 0; $i < sizeof($artist); $i++){
			echo('<a href="/movie_pre.php?artist_name='.$artist[$i].'" class="button">'.$artist_en[$i].'</a>');
		}
	}elseif(strcmp($lang, 'zh') == 0){
		for($i = 0; $i < sizeof($artist); $i++){
			echo('<a href="/movie_pre.php?artist_name='.$artist[$i].'" class="button">'.$artist_zh[$i].'</a>');
		}		
	}
?>	
</body>

</html>