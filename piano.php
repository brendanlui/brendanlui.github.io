<?php include 'get_ip_address_and_insert_in_database.php';?>
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

<title>Dadiu | Piano Practice</title>

<body onload="disable_btn_L();disable_btn_R();">
<body>

	<div id="head">
		<a href="/">
		<div id="logo">
			<img src="/img/dadiu.png" alt="dai01" class="logo_dadiu">
		</div>
		</a>
	</div>
	<link id="stylecall" rel="stylesheet" href="/piano_coming_style.css" />
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<img src="/img/album/heart_coming_soon.png" id="coming">
	

<div class="content">

<h2>Keyboard (C2 - C6)</h2>
</br>

<link rel="stylesheet" href="piano_on_off_toggle_style.css">

<h4>Saved Melody:</h4>
<?php
echo ("Right Hand: ");

$sql = "SELECT * FROM database_piano_code_right";
include 'config_database_value.php';
$conn=mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$result = mysqli_query($conn, $sql);

if($result){
	while($row = mysqli_fetch_array($result))
	{
		echo"
		<script>
		function load_right_".$row['id']."(){
			start_beat_num_drawing_clear_one_hand(9);
			right_note_num_save = [];
			string = '".$row['right_hand']."';
			right_note_num_save = JSON.parse('[' + string.slice(1, -1) + ']');
			
			//plot only
			start_left_pos = 105;
			start_right_pos = 105;
			for(i = 0; i < left_note_num_save.length; i++){
				if(i % 5 == 0){
					if(left_note_num_save[i+3]){	//sync
						if(i!=0)
							start_left_pos -= 22.5/left_note_num_save[i-5+1] *25;
					}
					if(left_note_num_save[i]!=0 && left_note_num_save[i]!=999 && left_note_num_save[i]!=99){
						if(left_note_num_save[i]==2||left_note_num_save[i]==4||left_note_num_save[i]==7||left_note_num_save[i]==9||left_note_num_save[i]==11||left_note_num_save[i]==14
						||left_note_num_save[i]==16||left_note_num_save[i]==19||left_note_num_save[i]==21||left_note_num_save[i]==23||left_note_num_save[i]==26||left_note_num_save[i]==28||left_note_num_save[i]==31
						||left_note_num_save[i]==33||left_note_num_save[i]==35||left_note_num_save[i]==38||left_note_num_save[i]==40||left_note_num_save[i]==43||left_note_num_save[i]==45||left_note_num_save[i]==47){
							plot_note_with_flat(start_left_pos, notes[left_note_num_save[i] - 1], left_note_num_save[i+1]);
						}else
							plot_note(start_left_pos, notes[left_note_num_save[i] - 1], left_note_num_save[i+1]);
					}else{
						if(left_note_num_save[i]==0)
							plot_rest(start_left_pos, left_note_num_save[i+4], left_note_num_save[i+1]);
						else if(left_note_num_save[i]==99){
							if(left_note_num_save[i-5]!=99){
								if(left_note_num_save[i-5] != 999 )
									plot_tie(start_left_pos, notes[left_note_num_save[i-5] - 1], left_note_num_save[i+1], start_left_pos - 22.5/left_note_num_save[i-5+1] *25);
								else
									plot_tie(start_left_pos, notes[left_note_num_save[i-10] - 1], left_note_num_save[i+1], start_left_pos - 22.5/left_note_num_save[i-5+1] *25 - 22.5/left_note_num_save[i-10+1] *25);
							}else{
								left_note_num_save.pop();
								left_note_num_save.pop();
								left_note_num_save.pop();
								left_note_num_save.pop();
								left_note_num_save.pop();
								start_left_pos -= 22.5/left_note_num_save[i+1] *25;
							}
						}
						else if(left_note_num_save[i]==999){
							if(left_note_num_save[i-5] != 0 && left_note_num_save[i-5] != 999){
								left_note_num_save[i+1] = left_note_num_save[i-4] * 2;
								if(left_note_num_save[i-5] != 99)
									plot_dot(start_left_pos - 22.5/left_note_num_save[i-5+1] *25, notes[left_note_num_save[i-5] - 1], left_note_num_save[i+1]);
								else{
									if(left_note_num_save[i-10] != 999)
										plot_dot(start_left_pos - 22.5/left_note_num_save[i-5+1] *25, notes[left_note_num_save[i-10] - 1], left_note_num_save[i+1]);
									else
										plot_dot(start_left_pos - 22.5/left_note_num_save[i-5+1] *25, notes[left_note_num_save[i-15] - 1], left_note_num_save[i+1]);
									}
								}else{
								left_note_num_save.pop();
								left_note_num_save.pop();
								left_note_num_save.pop();
								left_note_num_save.pop();
								left_note_num_save.pop();
								start_left_pos -= 22.5/left_note_num_save[i+1] *25;
							}
						}
					}
					start_left_pos += 22.5/left_note_num_save[i+1] *25;
				}
			}	
			for(i = 0; i < right_note_num_save.length; i++){
				if(i % 5 == 0){
					if(right_note_num_save[i+3]){
						if(i!=0)
							start_right_pos -= 22.5/right_note_num_save[i-5+1] *25;
					}
					if(right_note_num_save[i]!=0 && right_note_num_save[i]!=999 && right_note_num_save[i]!=99){
						if(right_note_num_save[i]==2||right_note_num_save[i]==4||right_note_num_save[i]==7||right_note_num_save[i]==9||right_note_num_save[i]==11||right_note_num_save[i]==14
						||right_note_num_save[i]==16||right_note_num_save[i]==19||right_note_num_save[i]==21||right_note_num_save[i]==23||right_note_num_save[i]==26||right_note_num_save[i]==28||right_note_num_save[i]==31
						||right_note_num_save[i]==33||right_note_num_save[i]==35||right_note_num_save[i]==38||right_note_num_save[i]==40||right_note_num_save[i]==43||right_note_num_save[i]==45||right_note_num_save[i]==47){
							plot_note_with_flat(start_right_pos, notes[right_note_num_save[i] - 1], right_note_num_save[i+1]);
						}else
							plot_note(start_right_pos, notes[right_note_num_save[i] - 1], right_note_num_save[i+1]);	
					}else{
						if(right_note_num_save[i]==0)
							plot_rest(start_right_pos, right_note_num_save[i+4], right_note_num_save[i+1]);
						else if(right_note_num_save[i]==99){
							if(right_note_num_save[i-5]!=99){
								if(right_note_num_save[i-5] != 999)
									plot_tie(start_right_pos, notes[right_note_num_save[i-5] - 1], right_note_num_save[i+1], start_right_pos - 22.5/right_note_num_save[i-5+1] *25);
								else
									plot_tie(start_right_pos, notes[right_note_num_save[i-10] - 1], right_note_num_save[i+1], start_right_pos - 22.5/right_note_num_save[i-5+1] *25 - 22.5/right_note_num_save[i-10+1] *25);
							}else{
								right_note_num_save.pop();
								right_note_num_save.pop();
								right_note_num_save.pop();
								right_note_num_save.pop();
								right_note_num_save.pop();
								start_right_pos -= 22.5/right_note_num_save[i+1] *25;
							}
						}
						else if(right_note_num_save[i]==999){
							if(right_note_num_save[i-5] != 0 && right_note_num_save[i-5] != 999){
								right_note_num_save[i+1] = right_note_num_save[i-4] * 2;
								if(right_note_num_save[i-5] != 99)
									plot_dot(start_right_pos - 22.5/right_note_num_save[i-5+1] *25, notes[right_note_num_save[i-5] - 1], right_note_num_save[i+1]);
								else{
									if(right_note_num_save[i-10] != 999)
										plot_dot(start_right_pos - 22.5/right_note_num_save[i-5+1] *25, notes[right_note_num_save[i-10] - 1], right_note_num_save[i+1]);
									else
										plot_dot(start_right_pos - 22.5/right_note_num_save[i-5+1] *25, notes[right_note_num_save[i-15] - 1], right_note_num_save[i+1]);
								}
							}else{
								right_note_num_save.pop();
								right_note_num_save.pop();
								right_note_num_save.pop();
								right_note_num_save.pop();
								right_note_num_save.pop();
								start_right_pos -= 22.5/right_note_num_save[i+1] *25;
							}
						}
					}
					start_right_pos += 22.5/right_note_num_save[i+1] *25;
				}
			}
		}
		</script>
		<a id ='".$row['id']."' class='load_data' href='#' onclick='load_right_".$row['id']."();' >";
		if($row['name'] != "")
			echo ($row['name']);
		else
			echo"R.H.".$row['id'];
		echo"</a>
		";
	}
}
mysqli_close($conn);
echo "</br>";

echo ("Left Hand: ");

$sql = "SELECT * FROM database_piano_code_left";
include 'config_database_value.php';
$conn=mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$result = mysqli_query($conn, $sql);

if($result){
	while($row = mysqli_fetch_array($result))
	{
		echo"
		<script>
		function load_left_".$row['id']."(){
			start_beat_num_drawing_clear_one_hand(1);
			left_note_num_save = [];
			string = '".$row['left_hand']."';
			left_note_num_save = JSON.parse('[' + string.slice(1, -1) + ']');
			
			//plot only
			start_left_pos = 105;
			start_right_pos = 105;
			for(i = 0; i < left_note_num_save.length; i++){
				if(i % 5 == 0){
					if(left_note_num_save[i+3]){	//sync
						if(i!=0)
							start_left_pos -= 22.5/left_note_num_save[i-5+1] *25;
					}
					if(left_note_num_save[i]!=0 && left_note_num_save[i]!=999 && left_note_num_save[i]!=99){
						if(left_note_num_save[i]==2||left_note_num_save[i]==4||left_note_num_save[i]==7||left_note_num_save[i]==9||left_note_num_save[i]==11||left_note_num_save[i]==14
						||left_note_num_save[i]==16||left_note_num_save[i]==19||left_note_num_save[i]==21||left_note_num_save[i]==23||left_note_num_save[i]==26||left_note_num_save[i]==28||left_note_num_save[i]==31
						||left_note_num_save[i]==33||left_note_num_save[i]==35||left_note_num_save[i]==38||left_note_num_save[i]==40||left_note_num_save[i]==43||left_note_num_save[i]==45||left_note_num_save[i]==47){
							plot_note_with_flat(start_left_pos, notes[left_note_num_save[i] - 1], left_note_num_save[i+1]);
						}else
							plot_note(start_left_pos, notes[left_note_num_save[i] - 1], left_note_num_save[i+1]);
					}else{
						if(left_note_num_save[i]==0)
							plot_rest(start_left_pos, left_note_num_save[i+4], left_note_num_save[i+1]);
						else if(left_note_num_save[i]==99){
							if(left_note_num_save[i-5]!=99){
								if(left_note_num_save[i-5] != 999 )
									plot_tie(start_left_pos, notes[left_note_num_save[i-5] - 1], left_note_num_save[i+1], start_left_pos - 22.5/left_note_num_save[i-5+1] *25);
								else
									plot_tie(start_left_pos, notes[left_note_num_save[i-10] - 1], left_note_num_save[i+1], start_left_pos - 22.5/left_note_num_save[i-5+1] *25 - 22.5/left_note_num_save[i-10+1] *25);
							}else{
								left_note_num_save.pop();
								left_note_num_save.pop();
								left_note_num_save.pop();
								left_note_num_save.pop();
								left_note_num_save.pop();
								start_left_pos -= 22.5/left_note_num_save[i+1] *25;
							}
						}
						else if(left_note_num_save[i]==999){
							if(left_note_num_save[i-5] != 0 && left_note_num_save[i-5] != 999){
								left_note_num_save[i+1] = left_note_num_save[i-4] * 2;
								if(left_note_num_save[i-5] != 99)
									plot_dot(start_left_pos - 22.5/left_note_num_save[i-5+1] *25, notes[left_note_num_save[i-5] - 1], left_note_num_save[i+1]);
								else{
									if(left_note_num_save[i-10] != 999)
										plot_dot(start_left_pos - 22.5/left_note_num_save[i-5+1] *25, notes[left_note_num_save[i-10] - 1], left_note_num_save[i+1]);
									else
										plot_dot(start_left_pos - 22.5/left_note_num_save[i-5+1] *25, notes[left_note_num_save[i-15] - 1], left_note_num_save[i+1]);
									}
								}else{
								left_note_num_save.pop();
								left_note_num_save.pop();
								left_note_num_save.pop();
								left_note_num_save.pop();
								left_note_num_save.pop();
								start_left_pos -= 22.5/left_note_num_save[i+1] *25;
							}
						}
					}
					start_left_pos += 22.5/left_note_num_save[i+1] *25;
				}
			}	
			for(i = 0; i < right_note_num_save.length; i++){
				if(i % 5 == 0){
					if(right_note_num_save[i+3]){
						if(i!=0)
							start_right_pos -= 22.5/right_note_num_save[i-5+1] *25;
					}
					if(right_note_num_save[i]!=0 && right_note_num_save[i]!=999 && right_note_num_save[i]!=99){
						if(right_note_num_save[i]==2||right_note_num_save[i]==4||right_note_num_save[i]==7||right_note_num_save[i]==9||right_note_num_save[i]==11||right_note_num_save[i]==14
						||right_note_num_save[i]==16||right_note_num_save[i]==19||right_note_num_save[i]==21||right_note_num_save[i]==23||right_note_num_save[i]==26||right_note_num_save[i]==28||right_note_num_save[i]==31
						||right_note_num_save[i]==33||right_note_num_save[i]==35||right_note_num_save[i]==38||right_note_num_save[i]==40||right_note_num_save[i]==43||right_note_num_save[i]==45||right_note_num_save[i]==47){
							plot_note_with_flat(start_right_pos, notes[right_note_num_save[i] - 1], right_note_num_save[i+1]);
						}else
							plot_note(start_right_pos, notes[right_note_num_save[i] - 1], right_note_num_save[i+1]);	
					}else{
						if(right_note_num_save[i]==0)
							plot_rest(start_right_pos, right_note_num_save[i+4], right_note_num_save[i+1]);
						else if(right_note_num_save[i]==99){
							if(right_note_num_save[i-5]!=99){
								if(right_note_num_save[i-5] != 999)
									plot_tie(start_right_pos, notes[right_note_num_save[i-5] - 1], right_note_num_save[i+1], start_right_pos - 22.5/right_note_num_save[i-5+1] *25);
								else
									plot_tie(start_right_pos, notes[right_note_num_save[i-10] - 1], right_note_num_save[i+1], start_right_pos - 22.5/right_note_num_save[i-5+1] *25 - 22.5/right_note_num_save[i-10+1] *25);
							}else{
								right_note_num_save.pop();
								right_note_num_save.pop();
								right_note_num_save.pop();
								right_note_num_save.pop();
								right_note_num_save.pop();
								start_right_pos -= 22.5/right_note_num_save[i+1] *25;
							}
						}
						else if(right_note_num_save[i]==999){
							if(right_note_num_save[i-5] != 0 && right_note_num_save[i-5] != 999){
								right_note_num_save[i+1] = right_note_num_save[i-4] * 2;
								if(right_note_num_save[i-5] != 99)
									plot_dot(start_right_pos - 22.5/right_note_num_save[i-5+1] *25, notes[right_note_num_save[i-5] - 1], right_note_num_save[i+1]);
								else{
									if(right_note_num_save[i-10] != 999)
										plot_dot(start_right_pos - 22.5/right_note_num_save[i-5+1] *25, notes[right_note_num_save[i-10] - 1], right_note_num_save[i+1]);
									else
										plot_dot(start_right_pos - 22.5/right_note_num_save[i-5+1] *25, notes[right_note_num_save[i-15] - 1], right_note_num_save[i+1]);
								}
							}else{
								right_note_num_save.pop();
								right_note_num_save.pop();
								right_note_num_save.pop();
								right_note_num_save.pop();
								right_note_num_save.pop();
								start_right_pos -= 22.5/right_note_num_save[i+1] *25;
							}
						}
					}
					start_right_pos += 22.5/right_note_num_save[i+1] *25;
				}
			}
		}
		</script>
		<a id ='".$row['id']."' class='load_data' href='#' onclick='load_left_".$row['id']."();' >";
		if($row['name'] != "")
			echo ($row['name']);
		else
			echo"L.H.".$row['id'];
		echo"</a>
		";
	}
}
mysqli_close($conn);
?></br></br>

<h4>&nbsp;&nbsp;&nbsp;2-2&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2-4
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3-2
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3-4
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3-8
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;4-2
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;4-4</h4>

<label class="switch">
  <input id="start_beat_num_button22" type="checkbox" onclick="start_beat_num(22);">
  <span class="slider round"></span>
</label>
<label class="switch">
  <input id="start_beat_num_button24" type="checkbox" onclick="start_beat_num(24);">
  <span class="slider round"></span>
</label>
<label class="switch">
  <input id="start_beat_num_button32" type="checkbox" onclick="start_beat_num(32);">
  <span class="slider round"></span>
</label>
<label class="switch">
  <input id="start_beat_num_button34" type="checkbox" onclick="start_beat_num(34);">
  <span class="slider round"></span>
</label>
<label class="switch">
  <input id="start_beat_num_button38" type="checkbox" onclick="start_beat_num(38);">
  <span class="slider round"></span>
</label>
<label class="switch">
  <input id="start_beat_num_button42" type="checkbox" onclick="start_beat_num(42);">
  <span class="slider round"></span>
</label>
<label class="switch">
  <input id="start_beat_num_button44" type="checkbox" onclick="start_beat_num(44);">
  <span class="slider round"></span>
</label>

<h4>Lento&nbsp;&nbsp;Adagio&nbsp;Andante&nbsp;Allegretto&nbsp;Allegro</h4>
<label class="switch">
  <input id="speed_button8000" type="checkbox" onclick="set_speed(8000);"> 
  <span class="slider round"></span>
</label>
<label class="switch">
  <input id="speed_button6000" type="checkbox" onclick="set_speed(6000);">
  <span class="slider round"></span>
</label>
<label class="switch">
  <input id="speed_button4000" type="checkbox" onclick="set_speed(4000);">
  <span class="slider round"></span>
</label>
<label class="switch">
  <input id="speed_button3000" type="checkbox" onclick="set_speed(3000);">
  <span class="slider round"></span>
</label>
<label class="switch">
  <input id="speed_button2000" type="checkbox" onclick="set_speed(2000);">
  <span class="slider round"></span>
</label>


<canvas id="my_1_Canvas" width="1230" height="180" style="margin-left:-20px; border:1px solid #d3d3d3;">
Your browser does not support the HTML5 canvas tag.</canvas>
<?php
for($i = 2; $i <100; $i++){
	echo'
		<canvas id="my_'.$i.'_Canvas" width="1230" height="180" style="margin-left:-20px; border:1px solid #d3d3d3; display:none;">
		Your browser does not support the HTML5 canvas tag.</canvas>
		';
}
?>

<h4>&nbsp;&nbsp;&nbsp;L/R&nbsp;&nbsp;Down/Up&nbsp;Sync</h4>

<label class="switch">
  <input id="handbutton" type="checkbox" onclick="hand_mode();">
  <span class="slider round"></span>
</label>
<label class="switch">
  <input id="restbutton" type="checkbox" onclick="rest_mode();">
  <span class="slider round"></span>
</label>
<label class="switch">
  <input id="same_time_button" type="checkbox" onclick="same_time();">
  <span class="slider round"></span>
</label>

<h4>&nbsp;Whole&nbsp;&nbsp;&nbsp;&nbsp;Half&nbsp;&nbsp;&nbsp;Quarter
&nbsp;&nbsp;&nbsp;8th&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;16th
&nbsp;&nbsp;&nbsp;&nbsp;32nd&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Dot</h4>
<label class="switch">
  <input id="whole_note_button" type="checkbox" onclick="whole(1);">
  <span class="slider round"></span>
</label>
<label class="switch">
  <input id="half_note_button" type="checkbox" onclick="whole(2);">
  <span class="slider round"></span>
</label>
<label class="switch">
  <input id="quarter_note_button" type="checkbox" onclick="whole(4);">
  <span class="slider round"></span>
</label>
<label class="switch">
  <input id="eighth_note_button" type="checkbox" onclick="whole(8);">
  <span class="slider round"></span>
</label>
<label class="switch">
  <input id="sixteenth_note_button" type="checkbox" onclick="whole(16);">
  <span class="slider round"></span>
</label>
<label class="switch">
  <input id="thirty_second_note_button" type="checkbox" onclick="whole(32);">
  <span class="slider round"></span>
</label>
<label class="switch">
  <input id="dot_button" type="checkbox" onclick="play(999);">
  <span class="slider round"></span>
</label>
<h4>&nbsp;&nbsp;&nbsp;&nbsp;pp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;mf
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ff</h4>
<label class="switch">
  <input id="sound_pp" name="sound" type="checkbox" onclick="pp_mode();">
  <span class="slider round"></span>
</label>
<label class="switch">
  <input id="sound_mf" name="sound" type="checkbox" onclick="mf_mode();">
  <span class="slider round"></span>
</label>
<label class="switch">
  <input id="sound_ff" name="sound" type="checkbox" onclick="ff_mode();">
  <span class="slider round"></span>
</label>

<h4>&nbsp;&nbsp;Clear&nbsp;&nbsp;&nbsp;&nbsp;Undo&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Play</h4>
<label class="switch">
  <input id="resetbutton" type="checkbox" onclick="clear_mode();">
  <span class="slider round"></span>
</label>
<label class="switch">
  <input id="undobutton" type="checkbox" onclick="undo_mode();">
  <span class="slider round"></span>
</label>
<label class="switch">
  <input id="playbutton" type="checkbox" onclick="jusi_play_only();">
  <span class="slider round"></span>
</label>



<script>
var left_note_num_save = [];
var right_note_num_save = [];
document.getElementById("start_beat_num_button44").checked = true;
var beat_num = 44;
function start_beat_num(b_num){
	if(b_num == 22){
		document.getElementById("start_beat_num_button22").checked = true;
		document.getElementById("start_beat_num_button24").checked = false;
		document.getElementById("start_beat_num_button32").checked = false;
		document.getElementById("start_beat_num_button34").checked = false;
		document.getElementById("start_beat_num_button38").checked = false;
		document.getElementById("start_beat_num_button42").checked = false;
		document.getElementById("start_beat_num_button44").checked = false;
	}else if(b_num == 24){
		document.getElementById("start_beat_num_button22").checked = false;
		document.getElementById("start_beat_num_button24").checked = true;
		document.getElementById("start_beat_num_button32").checked = false;
		document.getElementById("start_beat_num_button34").checked = false;
		document.getElementById("start_beat_num_button38").checked = false;
		document.getElementById("start_beat_num_button42").checked = false;
		document.getElementById("start_beat_num_button44").checked = false;
	}else if(b_num == 32){
		document.getElementById("start_beat_num_button22").checked = false;
		document.getElementById("start_beat_num_button24").checked = false;
		document.getElementById("start_beat_num_button32").checked = true;
		document.getElementById("start_beat_num_button34").checked = false;
		document.getElementById("start_beat_num_button38").checked = false;
		document.getElementById("start_beat_num_button42").checked = false;
		document.getElementById("start_beat_num_button44").checked = false;
	}else if(b_num == 34){
		document.getElementById("start_beat_num_button22").checked = false;
		document.getElementById("start_beat_num_button24").checked = false;
		document.getElementById("start_beat_num_button32").checked = false;
		document.getElementById("start_beat_num_button34").checked = true;
		document.getElementById("start_beat_num_button38").checked = false;
		document.getElementById("start_beat_num_button42").checked = false;
		document.getElementById("start_beat_num_button44").checked = false;
	}else if(b_num == 38){
		document.getElementById("start_beat_num_button22").checked = false;
		document.getElementById("start_beat_num_button24").checked = false;
		document.getElementById("start_beat_num_button32").checked = false;
		document.getElementById("start_beat_num_button34").checked = false;
		document.getElementById("start_beat_num_button38").checked = true;
		document.getElementById("start_beat_num_button42").checked = false;
		document.getElementById("start_beat_num_button44").checked = false;
	}else if(b_num == 42){
		document.getElementById("start_beat_num_button22").checked = false;
		document.getElementById("start_beat_num_button24").checked = false;
		document.getElementById("start_beat_num_button32").checked = false;
		document.getElementById("start_beat_num_button34").checked = false;
		document.getElementById("start_beat_num_button38").checked = false;
		document.getElementById("start_beat_num_button42").checked = true;
		document.getElementById("start_beat_num_button44").checked = false;
	}else if(b_num == 44){
		document.getElementById("start_beat_num_button22").checked = false;
		document.getElementById("start_beat_num_button24").checked = false;
		document.getElementById("start_beat_num_button32").checked = false;
		document.getElementById("start_beat_num_button34").checked = false;
		document.getElementById("start_beat_num_button38").checked = false;
		document.getElementById("start_beat_num_button42").checked = false;
		document.getElementById("start_beat_num_button44").checked = true;
	}
	beat_num = b_num;
	document.getElementById("resetbutton").checked = false;
	document.getElementById("undobutton").checked = false;
	document.getElementById("playbutton").checked = false;
	start_beat_num_drawing();
}



document.getElementById("speed_button4000").checked = true;
var speed = 4000;
function set_speed(v){
	if(v == 4000){
		document.getElementById("speed_button8000").checked = false;
		document.getElementById("speed_button4000").checked = true;
		document.getElementById("speed_button6000").checked = false;
		document.getElementById("speed_button3000").checked = false;
		document.getElementById("speed_button2000").checked = false;
	}else if(v == 8000){
		document.getElementById("speed_button8000").checked = true;
		document.getElementById("speed_button4000").checked = false;
		document.getElementById("speed_button2000").checked = false;
		document.getElementById("speed_button6000").checked = false;
		document.getElementById("speed_button3000").checked = false;
	}else if(v == 2000){
		document.getElementById("speed_button8000").checked = false;
		document.getElementById("speed_button4000").checked = false;
		document.getElementById("speed_button2000").checked = true;
		document.getElementById("speed_button6000").checked = false;
		document.getElementById("speed_button3000").checked = false;
	}else if(v == 3000){
		document.getElementById("speed_button8000").checked = false;
		document.getElementById("speed_button4000").checked = false;
		document.getElementById("speed_button2000").checked = false;
		document.getElementById("speed_button6000").checked = false;
		document.getElementById("speed_button3000").checked = true;
	}else if(v == 6000){
		document.getElementById("speed_button8000").checked = false;
		document.getElementById("speed_button4000").checked = false;
		document.getElementById("speed_button2000").checked = false;
		document.getElementById("speed_button6000").checked = true;
		document.getElementById("speed_button3000").checked = false;
	}
	speed = v;
	document.getElementById("resetbutton").checked = false;
	document.getElementById("undobutton").checked = false;
	document.getElementById("playbutton").checked = false;
}



var up_or_down = false;
function rest_mode(){
	if(document.getElementById("restbutton").checked == true){
		up_or_down = true;
	}else{
		up_or_down = false;
	}
	document.getElementById("resetbutton").checked = false;
	document.getElementById("undobutton").checked = false;
	document.getElementById("playbutton").checked = false;
}

document.getElementById("sound_mf").checked = true;
var sound_voice = "mf";
function pp_mode(){
	if(document.getElementById("sound_pp").checked == true){
		sound_voice = "pp";
		document.getElementById("sound_mf").checked = false;
		document.getElementById("sound_ff").checked = false;
	}else{
		sound_voice = "mf";
		document.getElementById("sound_mf").checked = true;
		document.getElementById("sound_pp").checked = false;
		document.getElementById("sound_ff").checked = false;
	}
	document.getElementById("resetbutton").checked = false;
	document.getElementById("undobutton").checked = false;
	document.getElementById("playbutton").checked = false;
}
function ff_mode(){
	if(document.getElementById("sound_ff").checked == true){
		sound_voice = "ff";
		document.getElementById("sound_mf").checked = false;
		document.getElementById("sound_pp").checked = false;
	}else{
		sound_voice = "mf";
		document.getElementById("sound_mf").checked = true;
		document.getElementById("sound_pp").checked = false;
		document.getElementById("sound_ff").checked = false;
	}
	document.getElementById("resetbutton").checked = false;
	document.getElementById("undobutton").checked = false;
	document.getElementById("playbutton").checked = false;
}
function mf_mode(){
	if(document.getElementById("sound_mf").checked == true){
		sound_voice = "mf";
		document.getElementById("sound_ff").checked = false;
		document.getElementById("sound_pp").checked = false;
	}else{
		sound_voice = "ff";
		document.getElementById("sound_ff").checked = true;
		document.getElementById("sound_pp").checked = false;
		document.getElementById("sound_mf").checked = false;
	}
	document.getElementById("resetbutton").checked = false;
	document.getElementById("undobutton").checked = false;
	document.getElementById("playbutton").checked = false;
}


var changed = false;
function change_mode(){
	if(changed == false){
		var x = document.getElementsByClassName("music")[0];
		x.style.display = 'block';
		var y = document.getElementsByClassName("music_note")[0];
		y.style.display = 'none';
		var z = document.getElementsByClassName("notebook")[0];
		z.style.display = 'none';
		changed = true;
		document.getElementById("resetbutton").checked = false;
		cleaned = false;
	}else{
		var x = document.getElementsByClassName("music")[0];
		x.style.display = 'none';
		var y = document.getElementsByClassName("music_note")[0];
		y.style.display = 'block';
		var z = document.getElementsByClassName("notebook")[0];
		z.style.display = 'none';		
		changed = false;
		document.getElementById("resetbutton").checked = false;
		cleaned = false;
	}
	document.getElementById("resetbutton").checked = false;
	document.getElementById("undobutton").checked = false;
	document.getElementById("playbutton").checked = false;
}

var cleaned = false;
function clear_mode(){
	if(cleaned == false){
		var x = document.getElementsByClassName("music")[0];
		x.style.display = 'none';
		var y = document.getElementsByClassName("music_note")[0];
		y.style.display = 'none';
		var z = document.getElementsByClassName("notebook")[0];
		z.style.display = 'block';
		document.getElementById("changebutton").checked = false;
		cleaned = true;
	}else{
		var x = document.getElementsByClassName("music")[0];
		x.style.display = 'none';
		var y = document.getElementsByClassName("music_note")[0];
		y.style.display = 'block';
		var z = document.getElementsByClassName("notebook")[0];
		z.style.display = 'none';	
		cleaned = false;
	}
	
	var array_of_canvas = [];
	for(i = 1; i < 100; i++){
		array_of_canvas[i] = "my_"+i+"_Canvas";
	}

	<?php
	for($i = 2; $i < 100; $i++){
		if($i != 1)
			echo"
			var c = document.getElementById(array_of_canvas[$i]);
			var context = c.getContext('2d');
			context.clearRect(0, 0, c.width, c.height);
			c.style.display = 'none';
			context = c.getContext('2d');
			context.beginPath();
			for(i = 0; i < 5; i++){
				context.moveTo(105 + 22.5/(beat_num%10) *25 *Math.floor(beat_num/10)*(i + 1) - 10, 40);
				context.lineTo(105 + 22.5/(beat_num%10) *25 *Math.floor(beat_num/10)*(i + 1) - 10, 80);
				context.moveTo(105 + 22.5/(beat_num%10) *25 *Math.floor(beat_num/10)*(i + 1) - 10, 100);
				context.lineTo(105 + 22.5/(beat_num%10) *25 *Math.floor(beat_num/10)*(i + 1) - 10, 140);
			}
			context.stroke();
			";
	}
	?>
	
	var c = document.getElementById(array_of_canvas[1]);
	var ctx = c.getContext('2d');
	ctx.clearRect(0, 0, c.width, c.height);
	set_drawing();
	//4-4beat
	ctx.beginPath();
	
	for(i = 0; i < 5; i++){
		ctx.moveTo(105 + 22.5/(beat_num%10) *25 *Math.floor(beat_num/10)*(i + 1) - 10, 40);
		ctx.lineTo(105 + 22.5/(beat_num%10) *25 *Math.floor(beat_num/10)*(i + 1) - 10, 80);
		ctx.moveTo(105 + 22.5/(beat_num%10) *25 *Math.floor(beat_num/10)*(i + 1) - 10, 100);
		ctx.lineTo(105 + 22.5/(beat_num%10) *25 *Math.floor(beat_num/10)*(i + 1) - 10, 140);
	}
	
	beat_num = 44;
	if(beat_num > 40 && beat_num < 50){
		ctx.moveTo(84, 40);
		ctx.lineTo(72, 50);
		ctx.lineTo(86, 50);
		ctx.moveTo(84, 40);
		ctx.lineTo(84, 60);

		ctx.moveTo(84, 100);
		ctx.lineTo(72, 110);
		ctx.lineTo(86, 110);
		ctx.moveTo(84, 100);
		ctx.lineTo(84, 120);
	}else if(beat_num > 30 && beat_num < 40){
		ctx.moveTo(74, 46);
		ctx.arc(80, 46, 6, Math.PI, Math.PI/4);
		ctx.lineTo(80, 50);
		ctx.arc(80, 54, 6, 7*Math.PI/4, Math.PI);
			
		ctx.moveTo(74, 106);
		ctx.arc(80, 106, 6, Math.PI, Math.PI/4);
		ctx.lineTo(80, 110);
		ctx.arc(80, 114, 6, 7*Math.PI/4, Math.PI);
	}else if(beat_num > 20 && beat_num < 30){
		ctx.moveTo(74, 46);
		ctx.arc(80, 46, 6, Math.PI, Math.PI/4);
		ctx.lineTo(74, 60);
		ctx.lineTo(86, 60);
		
		ctx.moveTo(74, 106);
		ctx.arc(80, 106, 6, Math.PI, Math.PI/4);
		ctx.lineTo(74, 120);
		ctx.lineTo(86, 120);
	}
		
	if(beat_num % 10 == 8){
		ctx.moveTo(80, 60);	
		ctx.arc(80, 66, 6, 3*Math.PI/2, Math.PI/4);
		ctx.moveTo(86, 70);	
		ctx.arc(80, 66, 6, 3*Math.PI/4, 3*Math.PI/2);
		ctx.moveTo(80, 70);
		ctx.arc(80, 74, 6, 7*Math.PI/4, 5*Math.PI/4);
		
		ctx.moveTo(80, 120);	
		ctx.arc(80, 126, 6, 3*Math.PI/2, Math.PI/4);
		ctx.moveTo(86, 130);	
		ctx.arc(80, 126, 6, 3*Math.PI/4, 3*Math.PI/2);
		ctx.moveTo(80, 130);
		ctx.arc(80, 134, 6, 7*Math.PI/4, 5*Math.PI/4);			
	}else if(beat_num % 10 == 4){
		ctx.moveTo(84, 60);
		ctx.lineTo(72, 70);
		ctx.lineTo(86, 70);
		ctx.moveTo(84, 60);
		ctx.lineTo(84, 80);		
		
		ctx.moveTo(84, 120);
		ctx.lineTo(72, 130);
		ctx.lineTo(86, 130);
		ctx.moveTo(84, 120);
		ctx.lineTo(84, 140);
	}else if(beat_num % 10 == 2){
		ctx.moveTo(74, 66);
		ctx.arc(80, 66, 6, Math.PI, Math.PI/4);
		ctx.lineTo(74, 80);
		ctx.lineTo(86, 80);
		
		ctx.moveTo(74, 126);
		ctx.arc(80, 126, 6, Math.PI, Math.PI/4);
		ctx.lineTo(74, 140);
		ctx.lineTo(86, 140);
	}
	ctx.stroke();
	
	document.getElementById("start_beat_num_button22").checked = false;
	document.getElementById("start_beat_num_button24").checked = false;
	document.getElementById("start_beat_num_button32").checked = false;
	document.getElementById("start_beat_num_button34").checked = false;
	document.getElementById("start_beat_num_button38").checked = false;
	document.getElementById("start_beat_num_button42").checked = false;
	document.getElementById("start_beat_num_button44").checked = true;
	
	left_note_num_save = [];
	right_note_num_save = [];
	
	document.getElementById("undobutton").checked = false;
	document.getElementById("playbutton").checked = false;
	document.getElementById("same_time_button").checked = false;
	same_time_with_before = false;

	document.getElementById("speed_button8000").checked = false;
	document.getElementById("speed_button4000").checked = true;
	document.getElementById("speed_button6000").checked = false;
	document.getElementById("speed_button3000").checked = false;
	document.getElementById("speed_button2000").checked = false;
	speed = 4000;
	
	document.getElementById("sound_mf").checked = true;
	document.getElementById("sound_ff").checked = false;
	document.getElementById("sound_pp").checked = false;
	sound_voice = "mf";
	

	document.getElementById("whole_note_button").checked = false;
	document.getElementById("half_note_button").checked = false;
	document.getElementById("quarter_note_button").checked = true;
	document.getElementById("eighth_note_button").checked = false;
	document.getElementById("sixteenth_note_button").checked = false;
	document.getElementById("thirty_second_note_button").checked = false;
	beat = 4;
	
	stop_all_play();
}

function undo_mode(){
	var array_of_canvas = [];
	for(i = 1; i < 100; i++){
		array_of_canvas[i] = "my_"+i+"_Canvas";
	}

	<?php
	for($i = 2; $i < 100; $i++){
		if($i != 1)
			echo"
			var c = document.getElementById(array_of_canvas[$i]);
			var context = c.getContext('2d');
			context.clearRect(0, 0, c.width, c.height);
			c.style.display = 'none';
			context = c.getContext('2d');
			context.beginPath();
			for(i = 0; i < 5; i++){
				context.moveTo(105 + 22.5/(beat_num%10) *25 *Math.floor(beat_num/10)*(i + 1) - 10, 40);
				context.lineTo(105 + 22.5/(beat_num%10) *25 *Math.floor(beat_num/10)*(i + 1) - 10, 80);
				context.moveTo(105 + 22.5/(beat_num%10) *25 *Math.floor(beat_num/10)*(i + 1) - 10, 100);
				context.lineTo(105 + 22.5/(beat_num%10) *25 *Math.floor(beat_num/10)*(i + 1) - 10, 140);
			}
			context.stroke();
			";
	}
	?>
	
	var c = document.getElementById(array_of_canvas[1]);
	var ctx = c.getContext('2d');
	ctx.clearRect(0, 0, c.width, c.height);
	set_drawing();
	//4-4beat
	ctx.beginPath();
	
	for(i = 0; i < 5; i++){
		ctx.moveTo(105 + 22.5/(beat_num%10) *25 *Math.floor(beat_num/10)*(i + 1) - 10, 40);
		ctx.lineTo(105 + 22.5/(beat_num%10) *25 *Math.floor(beat_num/10)*(i + 1) - 10, 80);
		ctx.moveTo(105 + 22.5/(beat_num%10) *25 *Math.floor(beat_num/10)*(i + 1) - 10, 100);
		ctx.lineTo(105 + 22.5/(beat_num%10) *25 *Math.floor(beat_num/10)*(i + 1) - 10, 140);
	}
	
	if(beat_num > 40 && beat_num < 50){
		ctx.moveTo(84, 40);
		ctx.lineTo(72, 50);
		ctx.lineTo(86, 50);
		ctx.moveTo(84, 40);
		ctx.lineTo(84, 60);

		ctx.moveTo(84, 100);
		ctx.lineTo(72, 110);
		ctx.lineTo(86, 110);
		ctx.moveTo(84, 100);
		ctx.lineTo(84, 120);
	}else if(beat_num > 30 && beat_num < 40){
		ctx.moveTo(74, 46);
		ctx.arc(80, 46, 6, Math.PI, Math.PI/4);
		ctx.lineTo(80, 50);
		ctx.arc(80, 54, 6, 7*Math.PI/4, Math.PI);
			
		ctx.moveTo(74, 106);
		ctx.arc(80, 106, 6, Math.PI, Math.PI/4);
		ctx.lineTo(80, 110);
		ctx.arc(80, 114, 6, 7*Math.PI/4, Math.PI);
	}else if(beat_num > 20 && beat_num < 30){
		ctx.moveTo(74, 46);
		ctx.arc(80, 46, 6, Math.PI, Math.PI/4);
		ctx.lineTo(74, 60);
		ctx.lineTo(86, 60);
		
		ctx.moveTo(74, 106);
		ctx.arc(80, 106, 6, Math.PI, Math.PI/4);
		ctx.lineTo(74, 120);
		ctx.lineTo(86, 120);
	}
		
	if(beat_num % 10 == 8){
		ctx.moveTo(80, 60);	
		ctx.arc(80, 66, 6, 3*Math.PI/2, Math.PI/4);
		ctx.moveTo(86, 70);	
		ctx.arc(80, 66, 6, 3*Math.PI/4, 3*Math.PI/2);
		ctx.moveTo(80, 70);
		ctx.arc(80, 74, 6, 7*Math.PI/4, 5*Math.PI/4);
		
		ctx.moveTo(80, 120);	
		ctx.arc(80, 126, 6, 3*Math.PI/2, Math.PI/4);
		ctx.moveTo(86, 130);	
		ctx.arc(80, 126, 6, 3*Math.PI/4, 3*Math.PI/2);
		ctx.moveTo(80, 130);
		ctx.arc(80, 134, 6, 7*Math.PI/4, 5*Math.PI/4);			
	}else if(beat_num % 10 == 4){
		ctx.moveTo(84, 60);
		ctx.lineTo(72, 70);
		ctx.lineTo(86, 70);
		ctx.moveTo(84, 60);
		ctx.lineTo(84, 80);		
		
		ctx.moveTo(84, 120);
		ctx.lineTo(72, 130);
		ctx.lineTo(86, 130);
		ctx.moveTo(84, 120);
		ctx.lineTo(84, 140);
	}else if(beat_num % 10 == 2){
		ctx.moveTo(74, 66);
		ctx.arc(80, 66, 6, Math.PI, Math.PI/4);
		ctx.lineTo(74, 80);
		ctx.lineTo(86, 80);
		
		ctx.moveTo(74, 126);
		ctx.arc(80, 126, 6, Math.PI, Math.PI/4);
		ctx.lineTo(74, 140);
		ctx.lineTo(86, 140);
	}
	ctx.stroke();
	
	if(changed_hand == false){
		left_note_num_save.pop();
		left_note_num_save.pop();
		left_note_num_save.pop();
		left_note_num_save.pop();
		left_note_num_save.pop();
	}else{
		right_note_num_save.pop();
		right_note_num_save.pop();
		right_note_num_save.pop();
		right_note_num_save.pop();
		right_note_num_save.pop();
	}
	start_left_pos = 105;
	start_right_pos = 105;	
	for(i = 0; i < left_note_num_save.length; i++){
		if(i % 5 == 0){
			if(left_note_num_save[i+3]){	//sync
				if(i!=0)
					start_left_pos -= 22.5/left_note_num_save[i-5+1] *25;
			}
			if(left_note_num_save[i]!=0 && left_note_num_save[i]!=999 && left_note_num_save[i]!=99){
				if(left_note_num_save[i]==2||left_note_num_save[i]==4||left_note_num_save[i]==7||left_note_num_save[i]==9||left_note_num_save[i]==11||left_note_num_save[i]==14
				||left_note_num_save[i]==16||left_note_num_save[i]==19||left_note_num_save[i]==21||left_note_num_save[i]==23||left_note_num_save[i]==26||left_note_num_save[i]==28||left_note_num_save[i]==31
				||left_note_num_save[i]==33||left_note_num_save[i]==35||left_note_num_save[i]==38||left_note_num_save[i]==40||left_note_num_save[i]==43||left_note_num_save[i]==45||left_note_num_save[i]==47){
					plot_note_with_flat(start_left_pos, notes[left_note_num_save[i] - 1], left_note_num_save[i+1]);
				}else
					plot_note(start_left_pos, notes[left_note_num_save[i] - 1], left_note_num_save[i+1]);
			}else{
				if(left_note_num_save[i]==0)
					plot_rest(start_left_pos, left_note_num_save[i+4], left_note_num_save[i+1]);
				else if(left_note_num_save[i]==99){
					if(left_note_num_save[i-5]!=99){
						if(left_note_num_save[i-5] != 999 )
							plot_tie(start_left_pos, notes[left_note_num_save[i-5] - 1], left_note_num_save[i+1], start_left_pos - 22.5/left_note_num_save[i-5+1] *25);
						else
							plot_tie(start_left_pos, notes[left_note_num_save[i-10] - 1], left_note_num_save[i+1], start_left_pos - 22.5/left_note_num_save[i-5+1] *25 - 22.5/left_note_num_save[i-10+1] *25);
					}else{
						left_note_num_save.pop();
						left_note_num_save.pop();
						left_note_num_save.pop();
						left_note_num_save.pop();
						left_note_num_save.pop();
						start_left_pos -= 22.5/left_note_num_save[i+1] *25;
					}
				}
				else if(left_note_num_save[i]==999){
					if(left_note_num_save[i-5] != 0 && left_note_num_save[i-5] != 999){
						left_note_num_save[i+1] = left_note_num_save[i-4] * 2;
						if(left_note_num_save[i-5] != 99)
							plot_dot(start_left_pos - 22.5/left_note_num_save[i-5+1] *25, notes[left_note_num_save[i-5] - 1], left_note_num_save[i+1]);
						else{
							if(left_note_num_save[i-10] != 999)
								plot_dot(start_left_pos - 22.5/left_note_num_save[i-5+1] *25, notes[left_note_num_save[i-10] - 1], left_note_num_save[i+1]);
							else
								plot_dot(start_left_pos - 22.5/left_note_num_save[i-5+1] *25, notes[left_note_num_save[i-15] - 1], left_note_num_save[i+1]);
							}
						}else{
						left_note_num_save.pop();
						left_note_num_save.pop();
						left_note_num_save.pop();
						left_note_num_save.pop();
						left_note_num_save.pop();
						start_left_pos -= 22.5/left_note_num_save[i+1] *25;
					}
				}
			}
			start_left_pos += 22.5/left_note_num_save[i+1] *25;
		}
	}	
	for(i = 0; i < right_note_num_save.length; i++){
		if(i % 5 == 0){
			if(right_note_num_save[i+3]){
				if(i!=0)
					start_right_pos -= 22.5/right_note_num_save[i-5+1] *25;
			}
			if(right_note_num_save[i]!=0 && right_note_num_save[i]!=999 && right_note_num_save[i]!=99){
				if(right_note_num_save[i]==2||right_note_num_save[i]==4||right_note_num_save[i]==7||right_note_num_save[i]==9||right_note_num_save[i]==11||right_note_num_save[i]==14
				||right_note_num_save[i]==16||right_note_num_save[i]==19||right_note_num_save[i]==21||right_note_num_save[i]==23||right_note_num_save[i]==26||right_note_num_save[i]==28||right_note_num_save[i]==31
				||right_note_num_save[i]==33||right_note_num_save[i]==35||right_note_num_save[i]==38||right_note_num_save[i]==40||right_note_num_save[i]==43||right_note_num_save[i]==45||right_note_num_save[i]==47){
					plot_note_with_flat(start_right_pos, notes[right_note_num_save[i] - 1], right_note_num_save[i+1]);
				}else
					plot_note(start_right_pos, notes[right_note_num_save[i] - 1], right_note_num_save[i+1]);	
			}else{
				if(right_note_num_save[i]==0)
					plot_rest(start_right_pos, right_note_num_save[i+4], right_note_num_save[i+1]);
				else if(right_note_num_save[i]==99){
					if(right_note_num_save[i-5]!=99){
						if(right_note_num_save[i-5] != 999)
							plot_tie(start_right_pos, notes[right_note_num_save[i-5] - 1], right_note_num_save[i+1], start_right_pos - 22.5/right_note_num_save[i-5+1] *25);
						else
							plot_tie(start_right_pos, notes[right_note_num_save[i-10] - 1], right_note_num_save[i+1], start_right_pos - 22.5/right_note_num_save[i-5+1] *25 - 22.5/right_note_num_save[i-10+1] *25);
					}else{
						right_note_num_save.pop();
						right_note_num_save.pop();
						right_note_num_save.pop();
						right_note_num_save.pop();
						right_note_num_save.pop();
						start_right_pos -= 22.5/right_note_num_save[i+1] *25;
					}
				}
				else if(right_note_num_save[i]==999){
					if(right_note_num_save[i-5] != 0 && right_note_num_save[i-5] != 999){
						right_note_num_save[i+1] = right_note_num_save[i-4] * 2;
						if(right_note_num_save[i-5] != 99)
							plot_dot(start_right_pos - 22.5/right_note_num_save[i-5+1] *25, notes[right_note_num_save[i-5] - 1], right_note_num_save[i+1]);
						else{
							if(right_note_num_save[i-10] != 999)
								plot_dot(start_right_pos - 22.5/right_note_num_save[i-5+1] *25, notes[right_note_num_save[i-10] - 1], right_note_num_save[i+1]);
							else
								plot_dot(start_right_pos - 22.5/right_note_num_save[i-5+1] *25, notes[right_note_num_save[i-15] - 1], right_note_num_save[i+1]);
						}
					}else{
						right_note_num_save.pop();
						right_note_num_save.pop();
						right_note_num_save.pop();
						right_note_num_save.pop();
						right_note_num_save.pop();
						start_right_pos -= 22.5/right_note_num_save[i+1] *25;
					}
				}
			}
			start_right_pos += 22.5/right_note_num_save[i+1] *25;
		}
	}
	document.getElementById("playbutton").checked = false;
	document.getElementById("resetbutton").checked = false;
}

var changed_hand = false;
function hand_mode(){
	if(changed_hand == false)
		changed_hand = true;
	else
		changed_hand = false;
	
	document.getElementById("resetbutton").checked = false;
	document.getElementById("undobutton").checked = false;
	document.getElementById("playbutton").checked = false;
}

function start_beat_num_drawing(){
	var array_of_canvas = [];
	for(i = 1; i < 100; i++){
		array_of_canvas[i] = "my_"+i+"_Canvas";
	}

	<?php
	for($i = 1; $i < 100; $i++){
		if($i != 1)
			echo"
			var c = document.getElementById(array_of_canvas[$i]);
			var context = c.getContext('2d');
			context.clearRect(0, 0, c.width, c.height);
			c.style.display = 'none';
			context = c.getContext('2d');
			context.beginPath();
			for(i = 0; i < 5; i++){
				context.moveTo(105 + 22.5/(beat_num%10) *25 *Math.floor(beat_num/10)*(i + 1) - 10, 40);
				context.lineTo(105 + 22.5/(beat_num%10) *25 *Math.floor(beat_num/10)*(i + 1) - 10, 80);
				context.moveTo(105 + 22.5/(beat_num%10) *25 *Math.floor(beat_num/10)*(i + 1) - 10, 100);
				context.lineTo(105 + 22.5/(beat_num%10) *25 *Math.floor(beat_num/10)*(i + 1) - 10, 140);
			}
			context.stroke();
			";
	}
	?>


	
	var c = document.getElementById(array_of_canvas[1]);
	var ctx = c.getContext('2d');
	ctx.clearRect(0, 0, c.width, c.height);
	set_drawing();
	//4-4beat
	ctx.beginPath();
	
	for(i = 0; i < 5; i++){
		ctx.moveTo(105 + 22.5/(beat_num%10) *25 *Math.floor(beat_num/10)*(i + 1) - 10, 40);
		ctx.lineTo(105 + 22.5/(beat_num%10) *25 *Math.floor(beat_num/10)*(i + 1) - 10, 80);
		ctx.moveTo(105 + 22.5/(beat_num%10) *25 *Math.floor(beat_num/10)*(i + 1) - 10, 100);
		ctx.lineTo(105 + 22.5/(beat_num%10) *25 *Math.floor(beat_num/10)*(i + 1) - 10, 140);
	}
	
	if(beat_num > 40 && beat_num < 50){
		ctx.moveTo(84, 40);
		ctx.lineTo(72, 50);
		ctx.lineTo(86, 50);
		ctx.moveTo(84, 40);
		ctx.lineTo(84, 60);

		ctx.moveTo(84, 100);
		ctx.lineTo(72, 110);
		ctx.lineTo(86, 110);
		ctx.moveTo(84, 100);
		ctx.lineTo(84, 120);
	}else if(beat_num > 30 && beat_num < 40){
		ctx.moveTo(74, 46);
		ctx.arc(80, 46, 6, Math.PI, Math.PI/4);
		ctx.lineTo(80, 50);
		ctx.arc(80, 54, 6, 7*Math.PI/4, Math.PI);
			
		ctx.moveTo(74, 106);
		ctx.arc(80, 106, 6, Math.PI, Math.PI/4);
		ctx.lineTo(80, 110);
		ctx.arc(80, 114, 6, 7*Math.PI/4, Math.PI);
	}else if(beat_num > 20 && beat_num < 30){
		ctx.moveTo(74, 46);
		ctx.arc(80, 46, 6, Math.PI, Math.PI/4);
		ctx.lineTo(74, 60);
		ctx.lineTo(86, 60);
		
		ctx.moveTo(74, 106);
		ctx.arc(80, 106, 6, Math.PI, Math.PI/4);
		ctx.lineTo(74, 120);
		ctx.lineTo(86, 120);
	}
		
	if(beat_num % 10 == 8){
		ctx.moveTo(80, 60);	
		ctx.arc(80, 66, 6, 3*Math.PI/2, Math.PI/4);
		ctx.moveTo(86, 70);	
		ctx.arc(80, 66, 6, 3*Math.PI/4, 3*Math.PI/2);
		ctx.moveTo(80, 70);
		ctx.arc(80, 74, 6, 7*Math.PI/4, 5*Math.PI/4);
		
		ctx.moveTo(80, 120);	
		ctx.arc(80, 126, 6, 3*Math.PI/2, Math.PI/4);
		ctx.moveTo(86, 130);	
		ctx.arc(80, 126, 6, 3*Math.PI/4, 3*Math.PI/2);
		ctx.moveTo(80, 130);
		ctx.arc(80, 134, 6, 7*Math.PI/4, 5*Math.PI/4);			
	}else if(beat_num % 10 == 4){
		ctx.moveTo(84, 60);
		ctx.lineTo(72, 70);
		ctx.lineTo(86, 70);
		ctx.moveTo(84, 60);
		ctx.lineTo(84, 80);		
		
		ctx.moveTo(84, 120);
		ctx.lineTo(72, 130);
		ctx.lineTo(86, 130);
		ctx.moveTo(84, 120);
		ctx.lineTo(84, 140);
	}else if(beat_num % 10 == 2){
		ctx.moveTo(74, 66);
		ctx.arc(80, 66, 6, Math.PI, Math.PI/4);
		ctx.lineTo(74, 80);
		ctx.lineTo(86, 80);
		
		ctx.moveTo(74, 126);
		ctx.arc(80, 126, 6, Math.PI, Math.PI/4);
		ctx.lineTo(74, 140);
		ctx.lineTo(86, 140);
	}
	ctx.stroke();
	
	start_left_pos = 105;
	start_right_pos = 105;
		for(i = 0; i < left_note_num_save.length; i++){
			if(i % 5 == 0){
				if(left_note_num_save[i+3]){	//sync
					if(i!=0)
						start_left_pos -= 22.5/left_note_num_save[i-5+1] *25;
				}
				if(left_note_num_save[i]!=0 && left_note_num_save[i]!=999 && left_note_num_save[i]!=99){
					if(left_note_num_save[i]==2||left_note_num_save[i]==4||left_note_num_save[i]==7||left_note_num_save[i]==9||left_note_num_save[i]==11||left_note_num_save[i]==14
					||left_note_num_save[i]==16||left_note_num_save[i]==19||left_note_num_save[i]==21||left_note_num_save[i]==23||left_note_num_save[i]==26||left_note_num_save[i]==28||left_note_num_save[i]==31
					||left_note_num_save[i]==33||left_note_num_save[i]==35||left_note_num_save[i]==38||left_note_num_save[i]==40||left_note_num_save[i]==43||left_note_num_save[i]==45||left_note_num_save[i]==47){
						plot_note_with_flat(start_left_pos, notes[left_note_num_save[i] - 1], left_note_num_save[i+1]);
					}else
						plot_note(start_left_pos, notes[left_note_num_save[i] - 1], left_note_num_save[i+1]);
				}else{
					if(left_note_num_save[i]==0)
						plot_rest(start_left_pos, left_note_num_save[i+4], left_note_num_save[i+1]);
					else if(left_note_num_save[i]==99){
						if(left_note_num_save[i-5] != 999)
							plot_tie(start_left_pos, notes[left_note_num_save[i-5] - 1], left_note_num_save[i+1], start_left_pos - 22.5/left_note_num_save[i+1] *25);
						else
							plot_tie(start_left_pos, notes[left_note_num_save[i-10] - 1], left_note_num_save[i+1], start_left_pos - 22.5/left_note_num_save[i+1] *25 - 22.5/left_note_num_save[i-5+1] *25);
					}
					else if(left_note_num_save[i]==999){
						if(left_note_num_save[i-5] != 0 && left_note_num_save[i-5] != 999){
							left_note_num_save[i+1] = left_note_num_save[i-4] * 2;
							if(left_note_num_save[i-5] != 99)
								plot_dot(start_left_pos - 22.5/left_note_num_save[i-5+1] *25, notes[left_note_num_save[i-5] - 1], left_note_num_save[i+1]);
							else{
								if(left_note_num_save[i-10] != 999)
									plot_dot(start_left_pos - 22.5/left_note_num_save[i-5+1] *25, notes[left_note_num_save[i-10] - 1], left_note_num_save[i+1]);
								else
									plot_dot(start_left_pos - 22.5/left_note_num_save[i-5+1] *25, notes[left_note_num_save[i-15] - 1], left_note_num_save[i+1]);
								}
							}else{
							left_note_num_save.pop();
							left_note_num_save.pop();
							left_note_num_save.pop();
							left_note_num_save.pop();
							left_note_num_save.pop();
							start_left_pos -= 22.5/left_note_num_save[i+1] *25;
						}
					}
				}
				start_left_pos += 22.5/left_note_num_save[i+1] *25;
			}
		}	
		for(i = 0; i < right_note_num_save.length; i++){
			if(i % 5 == 0){
				if(right_note_num_save[i+3]){
					if(i!=0)
						start_right_pos -= 22.5/right_note_num_save[i-5+1] *25;
				}
				if(right_note_num_save[i]!=0 && right_note_num_save[i]!=999 && right_note_num_save[i]!=99){
					if(right_note_num_save[i]==2||right_note_num_save[i]==4||right_note_num_save[i]==7||right_note_num_save[i]==9||right_note_num_save[i]==11||right_note_num_save[i]==14
					||right_note_num_save[i]==16||right_note_num_save[i]==19||right_note_num_save[i]==21||right_note_num_save[i]==23||right_note_num_save[i]==26||right_note_num_save[i]==28||right_note_num_save[i]==31
					||right_note_num_save[i]==33||right_note_num_save[i]==35||right_note_num_save[i]==38||right_note_num_save[i]==40||right_note_num_save[i]==43||right_note_num_save[i]==45||right_note_num_save[i]==47){
						plot_note_with_flat(start_right_pos, notes[right_note_num_save[i] - 1], right_note_num_save[i+1]);
					}else
						plot_note(start_right_pos, notes[right_note_num_save[i] - 1], right_note_num_save[i+1]);	
				}else{
					if(right_note_num_save[i]==0)
						plot_rest(start_right_pos, right_note_num_save[i+4], right_note_num_save[i+1]);
					else if(right_note_num_save[i]==99){
						if(right_note_num_save[i-5] != 999)
							plot_tie(start_right_pos, notes[right_note_num_save[i-5] - 1], right_note_num_save[i+1], start_right_pos - 22.5/right_note_num_save[i+1] *25);
						else
							plot_tie(start_right_pos, notes[right_note_num_save[i-10] - 1], right_note_num_save[i+1], start_right_pos - 22.5/right_note_num_save[i+1] *25 - 22.5/right_note_num_save[i-5+1] *25);
					}
					else if(right_note_num_save[i]==999){
						if(right_note_num_save[i-5] != 0 && right_note_num_save[i-5] != 999){
							right_note_num_save[i+1] = right_note_num_save[i-4] * 2;
							if(right_note_num_save[i-5] != 99)
								plot_dot(start_right_pos - 22.5/right_note_num_save[i-5+1] *25, notes[right_note_num_save[i-5] - 1], right_note_num_save[i+1]);
							else{
								if(right_note_num_save[i-10] != 999)
									plot_dot(start_right_pos - 22.5/right_note_num_save[i-5+1] *25, notes[right_note_num_save[i-10] - 1], right_note_num_save[i+1]);
								else
									plot_dot(start_right_pos - 22.5/right_note_num_save[i-5+1] *25, notes[right_note_num_save[i-15] - 1], right_note_num_save[i+1]);
							}
						}else{
							right_note_num_save.pop();
							right_note_num_save.pop();
							right_note_num_save.pop();
							right_note_num_save.pop();
							right_note_num_save.pop();
							start_right_pos -= 22.5/right_note_num_save[i+1] *25;
						}
					}
				}
				start_right_pos += 22.5/right_note_num_save[i+1] *25;
			}
		}
	
	document.getElementById("playbutton").checked = false;
	document.getElementById("resetbutton").checked = false;
	document.getElementById("undobutton").checked = false;
}
</script></br>


<script>
document.getElementById("quarter_note_button").checked = true;
var beat = 4;
function whole(x){
	beat = x;
	if(beat == 1){
		document.getElementById("whole_note_button").checked = true;
		document.getElementById("half_note_button").checked = false;
		document.getElementById("quarter_note_button").checked = false;
		document.getElementById("eighth_note_button").checked = false;
		document.getElementById("sixteenth_note_button").checked = false;
		document.getElementById("thirty_second_note_button").checked = false;
	}else if(beat == 2){
		document.getElementById("half_note_button").checked == true;
		document.getElementById("whole_note_button").checked = false;
		document.getElementById("quarter_note_button").checked = false;
		document.getElementById("eighth_note_button").checked = false;
		document.getElementById("sixteenth_note_button").checked = false;
		document.getElementById("thirty_second_note_button").checked = false;
	}else if(beat == 4){
		document.getElementById("quarter_note_button").checked == true;
		document.getElementById("whole_note_button").checked = false;
		document.getElementById("half_note_button").checked = false;
		document.getElementById("eighth_note_button").checked = false;
		document.getElementById("sixteenth_note_button").checked = false;
		document.getElementById("thirty_second_note_button").checked = false;
	}else if(beat == 8){
		document.getElementById("eighth_note_button").checked == true;
		document.getElementById("whole_note_button").checked = false;
		document.getElementById("quarter_note_button").checked = false;
		document.getElementById("half_note_button").checked = false;
		document.getElementById("sixteenth_note_button").checked = false;
		document.getElementById("thirty_second_note_button").checked = false;
	}else if(beat == 16){
		document.getElementById("sixteenth_note_button").checked == true;
		document.getElementById("whole_note_button").checked = false;
		document.getElementById("quarter_note_button").checked = false;
		document.getElementById("eighth_note_button").checked = false;
		document.getElementById("half_note_button").checked = false;
		document.getElementById("thirty_second_note_button").checked = false;
	}else if(beat == 32){
		document.getElementById("thirty_second_note_button").checked == true;
		document.getElementById("whole_note_button").checked = false;
		document.getElementById("quarter_note_button").checked = false;
		document.getElementById("eighth_note_button").checked = false;
		document.getElementById("sixteenth_note_button").checked = false;
		document.getElementById("half_note_button").checked = false;
	}
	document.getElementById("resetbutton").checked = false;
	document.getElementById("undobutton").checked = false;
	document.getElementById("playbutton").checked = false;
}

function set_drawing(){
	
	var array_of_canvas = [];
	for(i = 1; i < 100; i++){
		array_of_canvas[i] = "my_"+i+"_Canvas";
	}
		
	for(i = 1; i < array_of_canvas.length; i++){
		var c = document.getElementById(array_of_canvas[i]);
		var ctx = c.getContext("2d");
		ctx.beginPath();

		//draw ten lines
		ctx.moveTo(20, 40);
		ctx.lineTo(1260, 40);
		ctx.moveTo(20, 50);
		ctx.lineTo(1260, 50);
		ctx.moveTo(20, 60);
		ctx.lineTo(1260, 60);
		ctx.moveTo(20, 70);
		ctx.lineTo(1260, 70);
		ctx.moveTo(20, 80);
		ctx.lineTo(1260, 80);

		ctx.moveTo(20, 100);
		ctx.lineTo(1260, 100);
		ctx.moveTo(20, 110);
		ctx.lineTo(1260, 110);
		ctx.moveTo(20, 120);
		ctx.lineTo(1260, 120);
		ctx.moveTo(20, 130);
		ctx.lineTo(1260, 130);
		ctx.moveTo(20, 140);
		ctx.lineTo(1260, 140);

		//Treble Clef
			ctx.moveTo(30, 70);
			ctx.arc(40, 70, 10, Math.PI, Math.PI / 2);
			ctx.moveTo(40, 80);
			ctx.arc(40, 65, 15, Math.PI / 2, 3 * Math.PI / 2);
			ctx.moveTo(40, 30);
			ctx.arc(40, 40, 10, 3 * Math.PI / 2, Math.PI / 2);
			ctx.moveTo(40, 30);
			ctx.lineTo(40, 85);
			ctx.moveTo(40, 85);
			ctx.arc(34, 85, 6, 2*Math.PI, Math.PI);

		ctx.stroke();

		//Bass clef
			//3 points
			ctx.beginPath();
			ctx.fillStyle = "#000000";
			ctx.moveTo(30, 110);
			ctx.arc(30, 110, 3, 0, Math.PI * 2, true);
			ctx.fill();
			ctx.stroke();

			ctx.beginPath();
			ctx.fillStyle = "#000000";
			ctx.moveTo(60, 105);
			ctx.arc(60, 105, 1, 0, Math.PI * 2, true);
			ctx.fill();
			ctx.stroke();

			ctx.beginPath();
			ctx.fillStyle = "#000000";
			ctx.moveTo(60, 115);
			ctx.arc(60, 115, 1, 0, Math.PI * 2, true);
			ctx.fill();
			ctx.stroke();

			//line
			ctx.beginPath();
			ctx.moveTo(33, 110);
			ctx.arc(37, 110, 10, Math.PI, 3 * Math.PI / 2);
			ctx.moveTo(38, 100);
			ctx.arc(38, 115, 15, 3 * Math.PI / 2, Math.PI / 2);
			ctx.moveTo(43, 130);
			ctx.lineTo(32, 134);
			ctx.stroke();

	}
}
start_beat_num(44);
</script>




<link id="stylecall" rel="stylesheet" href="piano_piano_style.css" />
<div id="p-wrapper">
	<ul id="piano">
		<li><div id="00" class="anchor" onclick="play('99')"><b>TIE</b></div></li>
		<li><div id="00" class="anchor" onclick="play('00')"><b>REST</b></div></li>
		
		<li><div id="01" class="anchor" onclick="play('01')"></div></li>
		<li><div id="03" class="anchor" onclick="play('03')"></div><span id="02" onclick="play('02')"></span></li>
		<li><div id="05" class="anchor" onclick="play('05')"></div><span id="04" onclick="play('04')"></span></li>
		<li><div id="06" class="anchor" onclick="play('06')"></div></li>
		<li><div id="08" class="anchor" onclick="play('08')"></div><span id="07" onclick="play('07')"></span></li>
		<li><div id="10" class="anchor" onclick="play('10')"></div><span id="09" onclick="play('09')"></span></li>
		<li><div id="12" class="anchor" onclick="play('12')"></div><span id="11" onclick="play('11')"></span></li>
		
		<li><div id="13" class="anchor" onclick="play('13')"></div></li>
		<li><div id="15" class="anchor" onclick="play('15')"></div><span id="14" onclick="play('14')"></span></li>
		<li><div id="17" class="anchor" onclick="play('17')"></div><span id="16" onclick="play('16')"></span></li>
		<li><div id="18" class="anchor" onclick="play('18')"></div></li>
		<li><div id="20" class="anchor" onclick="play('20')"></div><span id="19" onclick="play('19')"></span></li>
		<li><div id="22" class="anchor" onclick="play('22')"></div><span id="21" onclick="play('21')"></span></li>
		<li><div id="24" class="anchor" onclick="play('24')"></div><span id="23" onclick="play('23')"></span></li>
		
		<li><div id="25" class="anchor" onclick="play('25')"></div></li>
		<li><div id="27" class="anchor" onclick="play('27')"></div><span id="26" onclick="play('26')"></span></li>
		<li><div id="29" class="anchor" onclick="play('29')"></div><span id="28" onclick="play('28')"></span></li>
		<li><div id="30" class="anchor" onclick="play('30')"></div></li>
		<li><div id="32" class="anchor" onclick="play('32')"></div><span id="31" onclick="play('31')"></span></li>
		<li><div id="34" class="anchor" onclick="play('34')"></div><span id="33" onclick="play('33')"></span></li>
		<li><div id="36" class="anchor" onclick="play('36')"></div><span id="35" onclick="play('35')"></span></li>
		
		<li><div id="37" class="anchor" onclick="play('37')"></div></li>
		<li><div id="39" class="anchor" onclick="play('39')"></div><span id="38" onclick="play('38')"></span></li>
		<li><div id="41" class="anchor" onclick="play('41')"></div><span id="40" onclick="play('40')"></span></li>
		<li><div id="42" class="anchor" onclick="play('42')"></div></li>
		<li><div id="44" class="anchor" onclick="play('44')"></div><span id="43" onclick="play('43')"></span></li>
		<li><div id="46" class="anchor" onclick="play('46')"></div><span id="45" onclick="play('45')"></span></li>
		<li><div id="48" class="anchor" onclick="play('48')"></div><span id="47" onclick="play('47')"></span></li>
		
		<li><div id="49" class="anchor" onclick="play('49')"></div></li>
	</ul>
</div></br>
<script>
	var notes_key = ['C2','Db2','D2','Eb2','E2','F2','Gb2','G2','Ab2','A2','Bb2','B2',
				'C3','Db3','D3','Eb3','E3','F3','Gb3','G3','Ab3','A3','Bb3','B3',
				'C4','Db4','D4','Eb4','E4','F4','Gb4','G4','Ab4','A4','Bb4','B4',
				'C5','Db5','D5','Eb5','E5','F5','Gb5','G5','Ab5','A5','Bb5','B5',
				'C6'];
	var notes = [];
	notes[0] = 160;
	for (i = 1; i < 50; i++) {
		if(i % 12 == 0 || i % 12 == 1 || i % 12 == 3 || i % 12 == 5 || i % 12 == 6 || i % 12 == 8 || i % 12 == 10)
			notes[i] = notes[i-1] - 5;
		else{
			notes[i] = notes[i-1];
		}
	}

				
	var start_left_pos = 51;
	var start_right_pos = 51;
	function plot_note(x, y, num_beat){
		if(beat_num == 38){
			if(x < 1150)
				save_int = 1;
			else
				save_int = Math.floor((x - 1150) / 1052) + 2;
			x -= 1055 * (save_int - 1);			
		}else if(Math.floor(beat_num / 10) == 2 || Math.floor(beat_num / 10) == 4){
			if(x < 1230)
				save_int = 1;
			else
				save_int = Math.floor((x - 1230) / 1122) + 2;
			x -= 1125 * (save_int - 1);
		}else if(beat_num == 32 || beat_num == 34){
			if(x < 940)
				save_int = 1;
			else
				save_int = Math.floor((x - 940) / 842) + 2;
			x -= 845 * (save_int - 1);		
		}
		
		var c = document.getElementById("my_" + save_int + "_Canvas");
		c.style.display = "block";
		
		var ctx = c.getContext("2d");
		ctx.beginPath();
		if(y == 150 || y == 90 || y == 30){
			ctx.moveTo(x-10, y);
			ctx.lineTo(x+10, y);
		}else if(y == 160){
			ctx.moveTo(x-10, y);
			ctx.lineTo(x+10, y);
			ctx.moveTo(x-10, y-10);
			ctx.lineTo(x+10, y-10);
		}else if(y == 20){
			ctx.moveTo(x-10, y);
			ctx.lineTo(x+10, y);
			ctx.moveTo(x-10, y+10);
			ctx.lineTo(x+10, y+10);
		}else if(y == 155){
			ctx.moveTo(x-10, y-5);
			ctx.lineTo(x+10, y-5);
		}else if(y == 25){
			ctx.moveTo(x-10, y+5);
			ctx.lineTo(x+10, y+5);
		}
		ctx.moveTo(x+4, y);
		ctx.arc(x, y, 4, 0, 2 * Math.PI);
		
		//<beat>
		if(num_beat > 2){
			ctx.fillStyle = "#3f3f3f";
			ctx.fill();
		}
		if(num_beat >= 2){
			if((y <= 120 && y >90)||y < 60){
				ctx.moveTo(x-5, y);
				ctx.lineTo(x-5, y+25);
				if(num_beat >= 8){
					ctx.moveTo(x-5, y+25);
					ctx.arc(x, y+25, 5, Math.PI, 2 * Math.PI);
					if(num_beat >= 16){
						ctx.moveTo(x-5, y+20);
						ctx.arc(x, y+20, 5, Math.PI, 2 * Math.PI);
						if(num_beat >= 32){
							ctx.moveTo(x-5, y+15);
							ctx.arc(x, y+15, 5, Math.PI, 2 * Math.PI);
						}
					}
				}
			}else{
				ctx.moveTo(x+5, y);
				ctx.lineTo(x+5, y-25);
				if(num_beat >= 8){
					ctx.moveTo(x+15, y-25);
					ctx.arc(x+10, y-25, 5, 2 * Math.PI, Math.PI);
					if(num_beat >= 16){
						ctx.moveTo(x+15, y-20);
						ctx.arc(x+10, y-20, 5, 2 * Math.PI, Math.PI);
						if(num_beat >= 32){
							ctx.moveTo(x+15, y-15);
							ctx.arc(x+10, y-15, 5, 2 * Math.PI, Math.PI);
						}
					}
				}
			}
		}
		//<beat>
		
		ctx.stroke();
	}
	
	function plot_tie(x, y, num_beat, past_x){
		if(beat_num == 38){
			if(x < 1150)
				save_int = 1;
			else
				save_int = Math.floor((x - 1150) / 1052) + 2;
			x -= 1055 * (save_int - 1);			
		}else if(Math.floor(beat_num / 10) == 2 || Math.floor(beat_num / 10) == 4){
			if(x < 1230)
				save_int = 1;
			else
				save_int = Math.floor((x - 1230) / 1122) + 2;
			x -= 1125 * (save_int - 1);
		}else if(beat_num == 32 || beat_num == 34){
			if(x < 940)
				save_int = 1;
			else
				save_int = Math.floor((x - 940) / 842) + 2;
			x -= 845 * (save_int - 1);		
		}
		
		var c = document.getElementById("my_" + save_int + "_Canvas");
		c.style.display = "block";
		
		var ctx = c.getContext("2d");
		
		ctx.beginPath();
		//set past_x
		if(beat_num == 38){
			if(past_x < 1150)
				save_int = 1;
			else
				save_int = Math.floor((past_x - 1150) / 1052) + 2;
			past_x -= 1055 * (save_int - 1);			
		}else if(Math.floor(beat_num / 10) == 2 || Math.floor(beat_num / 10) == 4){
			if(past_x < 1230)
				save_int = 1;
			else
				save_int = Math.floor((past_x - 1230) / 1122) + 2;
			past_x -= 1125 * (save_int - 1);
		}else if(beat_num == 32 || beat_num == 34){
			if(past_x < 940)
				save_int = 1;
			else
				save_int = Math.floor((past_x - 940) / 842) + 2;
			past_x -= 845 * (save_int - 1);		
		}		
		//plot tie
		if(past_x < x){
			if((y <= 120 && y >90)||y < 60){
				ctx.moveTo(past_x, y-10);
				ctx.bezierCurveTo(past_x, y-10-20, x, y-10-20, x, y-10);
			}else{
				ctx.moveTo(past_x, y+10);
				ctx.bezierCurveTo(past_x, y+10+20, x, y+10+20, x, y+10);
			}
		}else{
			if((y <= 120 && y >90)||y < 60){
				ctx.moveTo(70, y-10);
				ctx.bezierCurveTo(70, y-10-10, x, y-10-10, x, y-10);
			}else{
				ctx.moveTo(70, y+10);
				ctx.bezierCurveTo(70, y+10+10, x, y+10+10, x, y+10);
			}	
		}
		ctx.stroke();		
		//plot tie
		
		ctx.beginPath();
		if(y == 150 || y == 90 || y == 30){
			ctx.moveTo(x-10, y);
			ctx.lineTo(x+10, y);
		}else if(y == 160){
			ctx.moveTo(x-10, y);
			ctx.lineTo(x+10, y);
			ctx.moveTo(x-10, y-10);
			ctx.lineTo(x+10, y-10);
		}else if(y == 20){
			ctx.moveTo(x-10, y);
			ctx.lineTo(x+10, y);
			ctx.moveTo(x-10, y+10);
			ctx.lineTo(x+10, y+10);
		}else if(y == 155){
			ctx.moveTo(x-10, y-5);
			ctx.lineTo(x+10, y-5);
		}else if(y == 25){
			ctx.moveTo(x-10, y+5);
			ctx.lineTo(x+10, y+5);
		}
		ctx.moveTo(x+4, y);
		ctx.arc(x, y, 4, 0, 2 * Math.PI);
		
		//<beat>
		if(num_beat > 2){
			ctx.fillStyle = "#3f3f3f";
			ctx.fill();
		}
		if(num_beat >= 2){
			if((y <= 120 && y >90)||y < 60){
				ctx.moveTo(x-5, y);
				ctx.lineTo(x-5, y+25);
				if(num_beat >= 8){
					ctx.moveTo(x-5, y+25);
					ctx.arc(x, y+25, 5, Math.PI, 2 * Math.PI);
					if(num_beat >= 16){
						ctx.moveTo(x-5, y+20);
						ctx.arc(x, y+20, 5, Math.PI, 2 * Math.PI);
						if(num_beat >= 32){
							ctx.moveTo(x-5, y+15);
							ctx.arc(x, y+15, 5, Math.PI, 2 * Math.PI);
						}
					}
				}
			}else{
				ctx.moveTo(x+5, y);
				ctx.lineTo(x+5, y-25);
				if(num_beat >= 8){
					ctx.moveTo(x+15, y-25);
					ctx.arc(x+10, y-25, 5, 2 * Math.PI, Math.PI);
					if(num_beat >= 16){
						ctx.moveTo(x+15, y-20);
						ctx.arc(x+10, y-20, 5, 2 * Math.PI, Math.PI);
						if(num_beat >= 32){
							ctx.moveTo(x+15, y-15);
							ctx.arc(x+10, y-15, 5, 2 * Math.PI, Math.PI);
						}
					}
				}
			}
		}
		//<beat>
		
		ctx.stroke();
	}	
	function plot_note_with_flat(x, y, num_beat){
		if(beat_num == 38){
			if(x < 1150)
				save_int = 1;
			else
				save_int = Math.floor((x - 1150) / 1052) + 2;
			x -= 1055 * (save_int - 1);			
		}else if(Math.floor(beat_num / 10) == 2 || Math.floor(beat_num / 10) == 4){
			if(x < 1230)
				save_int = 1;
			else
				save_int = Math.floor((x - 1230) / 1122) + 2;
			x -= 1125 * (save_int - 1);
		}else if(beat_num == 32 || beat_num == 34){
			if(x < 940)
				save_int = 1;
			else
				save_int = Math.floor((x - 940) / 842) + 2;
			x -= 845 * (save_int - 1);		
		}
		
		var c = document.getElementById("my_" + save_int + "_Canvas");
		c.style.display = "block";
		
		var ctx = c.getContext("2d");
		ctx.beginPath();
		if(y == 150 || y == 90 || y == 30){
			ctx.moveTo(x-10, y);
			ctx.lineTo(x+10, y);
		}else if(y == 160){
			ctx.moveTo(x-10, y);
			ctx.lineTo(x+10, y);
			ctx.moveTo(x-10, y-10);
			ctx.lineTo(x+10, y-10);
		}else if(y == 20){
			ctx.moveTo(x-10, y);
			ctx.lineTo(x+10, y);
			ctx.moveTo(x-10, y+10);
			ctx.lineTo(x+10, y+10);
		}else if(y == 155){
			ctx.moveTo(x-10, y-5);
			ctx.lineTo(x+10, y-5);
		}else if(y == 25){
			ctx.moveTo(x-10, y+5);
			ctx.lineTo(x+10, y+5);
		}
		ctx.moveTo(x+4, y);
		ctx.arc(x, y, 4, 0, 2 * Math.PI);
		
		//<beat>
		if(num_beat > 2){
			ctx.fillStyle = "#3f3f3f";
			ctx.fill();
		}
		if(num_beat >= 2){
			if((y <= 120 && y >90)||y < 60){
				ctx.moveTo(x-5, y);
				ctx.lineTo(x-5, y+25);
				if(num_beat >= 8){
					ctx.moveTo(x-5, y+25);
					ctx.arc(x, y+25, 5, Math.PI, 2 * Math.PI);
					if(num_beat >= 16){
						ctx.moveTo(x-5, y+20);
						ctx.arc(x, y+20, 5, Math.PI, 2 * Math.PI);
						if(num_beat >= 32){
							ctx.moveTo(x-5, y+15);
							ctx.arc(x, y+15, 5, Math.PI, 2 * Math.PI);
						}
					}
				}
			}else{
				ctx.moveTo(x+5, y);
				ctx.lineTo(x+5, y-25);
				if(num_beat >= 8){
					ctx.moveTo(x+15, y-25);
					ctx.arc(x+10, y-25, 5, 2 * Math.PI, Math.PI);
					if(num_beat >= 16){
						ctx.moveTo(x+15, y-20);
						ctx.arc(x+10, y-20, 5, 2 * Math.PI, Math.PI);
						if(num_beat >= 32){
							ctx.moveTo(x+15, y-15);
							ctx.arc(x+10, y-15, 5, 2 * Math.PI, Math.PI);
						}
					}
				}
			}
		}
		//<beat>	
		
		ctx.stroke();
		
		
		//<difference>
		ctx.beginPath();
		ctx.moveTo(x-12, y-4);
		ctx.arc(x-12, y, 4, Math.PI*3/2, Math.PI/2);
		ctx.moveTo(x-12, y+5);
		ctx.lineTo(x-12, y-9);	
		ctx.stroke();
		//<difference>
		
	}
	
	function plot_dot(x, y, num_beat){
		if(beat_num == 38){
			if(x < 1150)
				save_int = 1;
			else
				save_int = Math.floor((x - 1150) / 1052) + 2;
			x -= 1055 * (save_int - 1);			
		}else if(Math.floor(beat_num / 10) == 2 || Math.floor(beat_num / 10) == 4){
			if(x < 1230)
				save_int = 1;
			else
				save_int = Math.floor((x - 1230) / 1122) + 2;
			x -= 1125 * (save_int - 1);
		}else if(beat_num == 32 || beat_num == 34){
			if(x < 940)
				save_int = 1;
			else
				save_int = Math.floor((x - 940) / 842) + 2;
			x -= 845 * (save_int - 1);		
		}
		
		var c = document.getElementById("my_" + save_int + "_Canvas");
		c.style.display = "block";
		
		var ctx = c.getContext("2d");
		ctx.beginPath();		
		ctx.fillStyle = "#000000";
		ctx.moveTo(x+10, y);
		ctx.arc(x+10, y, 2, 0, Math.PI * 2, true);
		ctx.fill();
		ctx.stroke();

	}
	
	function plot_rest(x, up_for_true, num_beat){
		if(beat_num == 38){
			if(x < 1150)
				save_int = 1;
			else
				save_int = Math.floor((x - 1150) / 1052) + 2;
			x -= 1055 * (save_int - 1);			
		}else if(Math.floor(beat_num / 10) == 2 || Math.floor(beat_num / 10) == 4){
			if(x < 1230)
				save_int = 1;
			else
				save_int = Math.floor((x - 1230) / 1122) + 2;
			x -= 1125 * (save_int - 1);
		}else if(beat_num == 32 || beat_num == 34){
			if(x < 940)
				save_int = 1;
			else
				save_int = Math.floor((x - 940) / 842) + 2;
			x -= 845 * (save_int - 1);		
		}
		
		var c = document.getElementById("my_" + save_int + "_Canvas");
		c.style.display = "block";
		
		var ctx = c.getContext("2d");
		if(num_beat == 1){
			if(up_for_true){
				ctx.beginPath();
				ctx.fillStyle = "#000000";
				ctx.moveTo(x-5, 50);
				ctx.lineTo(x-5, 55);
				ctx.lineTo(x+5, 55);
				ctx.lineTo(x+5, 50);
				ctx.lineTo(x-5, 50);
				ctx.fill();
				ctx.stroke();
			}else{
				ctx.beginPath();
				ctx.fillStyle = "#000000";
				ctx.moveTo(x-5, 110);
				ctx.lineTo(x-5, 115);
				ctx.lineTo(x+5, 115);
				ctx.lineTo(x+5, 110);
				ctx.lineTo(x-5, 110);
				ctx.fill();
				ctx.stroke();
				
			}
			
		}else if(num_beat == 2){
			if(up_for_true){
				ctx.beginPath();
				ctx.fillStyle = "#000000";
				ctx.moveTo(x-5, 60);
				ctx.lineTo(x-5, 55);
				ctx.lineTo(x+5, 55);
				ctx.lineTo(x+5, 60);
				ctx.lineTo(x-5, 60);
				ctx.fill();
				ctx.stroke();
			}else{
				ctx.beginPath();
				ctx.fillStyle = "#000000";
				ctx.moveTo(x-5, 120);
				ctx.lineTo(x-5, 115);
				ctx.lineTo(x+5, 115);
				ctx.lineTo(x+5, 120);
				ctx.lineTo(x-5, 120);
				ctx.fill();
				ctx.stroke();
			}
			
		}else if(num_beat == 4){
			if(up_for_true){
				ctx.beginPath();
				ctx.moveTo(x-5, 45);
				ctx.lineTo(x+5, 55);
				ctx.lineTo(x-5, 55);
				ctx.lineTo(x+5, 65);
				ctx.moveTo(x, 73);
				ctx.arc(x, 68, 5, Math.PI/2, 7*Math.PI/4);
				ctx.stroke();
			}else{
				ctx.beginPath();
				ctx.moveTo(x-5, 105);
				ctx.lineTo(x+5, 115);
				ctx.lineTo(x-5, 115);
				ctx.lineTo(x+5, 125);
				ctx.moveTo(x, 133);
				ctx.arc(x, 128, 5, Math.PI/2, 7*Math.PI/4);
				ctx.stroke();
			}			
		}else if(num_beat >= 8){
			if(up_for_true){
				ctx.beginPath();
				ctx.fillStyle = "#000000";
				ctx.moveTo(x-5, 55);
				ctx.arc(x-5, 55, 2, 0, Math.PI * 2, true);
				ctx.fill();
				ctx.stroke();	
				
				ctx.beginPath();
				ctx.arc(x, 55, 3, 7.5*Math.PI/4, Math.PI);
				ctx.moveTo(x+3, 55);
				ctx.lineTo(x, 70);
				ctx.stroke();	
				if(num_beat >= 16){
					ctx.beginPath();
					ctx.fillStyle = "#000000";
					ctx.moveTo(x-7.5, 65);
					ctx.arc(x-7.5, 65, 2, 0, Math.PI * 2, true);
					ctx.fill();
					ctx.stroke();
					
					ctx.beginPath();
					ctx.arc(x-2.5, 65, 3, 7.5*Math.PI/4, Math.PI);
					ctx.moveTo(x+0.5, 65);
					ctx.lineTo(x-2.5, 80);
					ctx.stroke();	
					
					if(num_beat >= 32){
						ctx.beginPath();
						ctx.fillStyle = "#000000";
						ctx.moveTo(x-2.5, 45);
						ctx.arc(x-2.5, 45, 2, 0, Math.PI * 2, true);
						ctx.fill();
						ctx.stroke();
						
						ctx.beginPath();
						ctx.arc(x+2.5, 45, 3, 7.5*Math.PI/4, Math.PI);
						ctx.moveTo(x+5.5, 45);
						ctx.lineTo(x+2.5, 60);
						ctx.stroke();							
					}
				}
			}else{
				ctx.beginPath();
				ctx.fillStyle = "#000000";
				ctx.moveTo(x-5, 115);
				ctx.arc(x-5, 115, 2, 0, Math.PI * 2, true);
				ctx.fill();
				ctx.stroke();	

				ctx.beginPath();
				ctx.arc(x, 115, 3, 7.5*Math.PI/4, Math.PI);
				ctx.moveTo(x+3, 115);
				ctx.lineTo(x, 130);
				ctx.stroke();	
				
				if(num_beat >= 16){
					ctx.beginPath();
					ctx.fillStyle = "#000000";
					ctx.moveTo(x-7.5, 125);
					ctx.arc(x-7.5, 125, 2, 0, Math.PI * 2, true);
					ctx.fill();
					ctx.stroke();
					
					ctx.beginPath();
					ctx.arc(x-2.5, 125, 3, 7.5*Math.PI/4, Math.PI);
					ctx.moveTo(x+0.5, 125);
					ctx.lineTo(x-2.5, 140);
					ctx.stroke();	
										
					if(num_beat >= 32){
						ctx.beginPath();
						ctx.fillStyle = "#000000";
						ctx.moveTo(x-2.5, 105);
						ctx.arc(x-2.5, 105, 2, 0, Math.PI * 2, true);
						ctx.fill();
						ctx.stroke();
						
						ctx.beginPath();
						ctx.arc(x+2.5, 105, 3, 7.5*Math.PI/4, Math.PI);
						ctx.moveTo(x+5.5, 105);
						ctx.lineTo(x+2.5, 120);
						ctx.stroke();							
					}
				}
			}
		}
	}	
  function play(id_num){
		if(id_num != 0 && id_num != 999 && id_num != 99){
		   var audio = document.getElementById("piano_"+sound_voice+"_"+id_num);
			if (audio.paused) {
				audio.play();
			}else{
				audio.pause();
				audio.currentTime = 0;
				audio.play();
			}
		}

		if(changed_hand == false){
			left_note_num_save.push(id_num);
			left_note_num_save.push(beat);
			left_note_num_save.push(sound_voice);
			left_note_num_save.push(same_time_with_before);
			left_note_num_save.push(up_or_down);
		}else{
			right_note_num_save.push(id_num);
			right_note_num_save.push(beat);
			right_note_num_save.push(sound_voice);
			right_note_num_save.push(same_time_with_before);
			right_note_num_save.push(up_or_down);
		}
		start_left_pos = 105;
		start_right_pos = 105;
		for(i = 0; i < left_note_num_save.length; i++){
			if(i % 5 == 0){
				if(left_note_num_save[i+3]){	//sync
					if(i!=0)
						start_left_pos -= 22.5/left_note_num_save[i-5+1] *25;
				}
				if(left_note_num_save[i]!=0 && left_note_num_save[i]!=999 && left_note_num_save[i]!=99){
					if(left_note_num_save[i]==2||left_note_num_save[i]==4||left_note_num_save[i]==7||left_note_num_save[i]==9||left_note_num_save[i]==11||left_note_num_save[i]==14
					||left_note_num_save[i]==16||left_note_num_save[i]==19||left_note_num_save[i]==21||left_note_num_save[i]==23||left_note_num_save[i]==26||left_note_num_save[i]==28||left_note_num_save[i]==31
					||left_note_num_save[i]==33||left_note_num_save[i]==35||left_note_num_save[i]==38||left_note_num_save[i]==40||left_note_num_save[i]==43||left_note_num_save[i]==45||left_note_num_save[i]==47){
						plot_note_with_flat(start_left_pos, notes[left_note_num_save[i] - 1], left_note_num_save[i+1]);
					}else
						plot_note(start_left_pos, notes[left_note_num_save[i] - 1], left_note_num_save[i+1]);
				}else{
					if(left_note_num_save[i]==0)
						plot_rest(start_left_pos, left_note_num_save[i+4], left_note_num_save[i+1]);
					else if(left_note_num_save[i]==99){
						if(left_note_num_save[i-5]!=99){
							if(left_note_num_save[i-5] != 999 )
								plot_tie(start_left_pos, notes[left_note_num_save[i-5] - 1], left_note_num_save[i+1], start_left_pos - 22.5/left_note_num_save[i-5+1] *25);
							else
								plot_tie(start_left_pos, notes[left_note_num_save[i-10] - 1], left_note_num_save[i+1], start_left_pos - 22.5/left_note_num_save[i-5+1] *25 - 22.5/left_note_num_save[i-10+1] *25);
						}else{
							left_note_num_save.pop();
							left_note_num_save.pop();
							left_note_num_save.pop();
							left_note_num_save.pop();
							left_note_num_save.pop();
							start_left_pos -= 22.5/left_note_num_save[i+1] *25;
						}
					}
					else if(left_note_num_save[i]==999){
						if(left_note_num_save[i-5] != 0 && left_note_num_save[i-5] != 999){
							left_note_num_save[i+1] = left_note_num_save[i-4] * 2;
							if(left_note_num_save[i-5] != 99)
								plot_dot(start_left_pos - 22.5/left_note_num_save[i-5+1] *25, notes[left_note_num_save[i-5] - 1], left_note_num_save[i+1]);
							else{
								if(left_note_num_save[i-10] != 999)
									plot_dot(start_left_pos - 22.5/left_note_num_save[i-5+1] *25, notes[left_note_num_save[i-10] - 1], left_note_num_save[i+1]);
								else
									plot_dot(start_left_pos - 22.5/left_note_num_save[i-5+1] *25, notes[left_note_num_save[i-15] - 1], left_note_num_save[i+1]);
								}
							}else{
							left_note_num_save.pop();
							left_note_num_save.pop();
							left_note_num_save.pop();
							left_note_num_save.pop();
							left_note_num_save.pop();
							start_left_pos -= 22.5/left_note_num_save[i+1] *25;
						}
					}
				}
				start_left_pos += 22.5/left_note_num_save[i+1] *25;
			}
		}	
		for(i = 0; i < right_note_num_save.length; i++){
			if(i % 5 == 0){
				if(right_note_num_save[i+3]){
					if(i!=0)
						start_right_pos -= 22.5/right_note_num_save[i-5+1] *25;
				}
				if(right_note_num_save[i]!=0 && right_note_num_save[i]!=999 && right_note_num_save[i]!=99){
					if(right_note_num_save[i]==2||right_note_num_save[i]==4||right_note_num_save[i]==7||right_note_num_save[i]==9||right_note_num_save[i]==11||right_note_num_save[i]==14
					||right_note_num_save[i]==16||right_note_num_save[i]==19||right_note_num_save[i]==21||right_note_num_save[i]==23||right_note_num_save[i]==26||right_note_num_save[i]==28||right_note_num_save[i]==31
					||right_note_num_save[i]==33||right_note_num_save[i]==35||right_note_num_save[i]==38||right_note_num_save[i]==40||right_note_num_save[i]==43||right_note_num_save[i]==45||right_note_num_save[i]==47){
						plot_note_with_flat(start_right_pos, notes[right_note_num_save[i] - 1], right_note_num_save[i+1]);
					}else
						plot_note(start_right_pos, notes[right_note_num_save[i] - 1], right_note_num_save[i+1]);	
				}else{
					if(right_note_num_save[i]==0)
						plot_rest(start_right_pos, right_note_num_save[i+4], right_note_num_save[i+1]);
					else if(right_note_num_save[i]==99){
						if(right_note_num_save[i-5]!=99){
							if(right_note_num_save[i-5] != 999)
								plot_tie(start_right_pos, notes[right_note_num_save[i-5] - 1], right_note_num_save[i+1], start_right_pos - 22.5/right_note_num_save[i-5+1] *25);
							else
								plot_tie(start_right_pos, notes[right_note_num_save[i-10] - 1], right_note_num_save[i+1], start_right_pos - 22.5/right_note_num_save[i-5+1] *25 - 22.5/right_note_num_save[i-10+1] *25);
						}else{
							right_note_num_save.pop();
							right_note_num_save.pop();
							right_note_num_save.pop();
							right_note_num_save.pop();
							right_note_num_save.pop();
							start_right_pos -= 22.5/right_note_num_save[i+1] *25;
						}
					}
					else if(right_note_num_save[i]==999){
						if(right_note_num_save[i-5] != 0 && right_note_num_save[i-5] != 999){
							right_note_num_save[i+1] = right_note_num_save[i-4] * 2;
							if(right_note_num_save[i-5] != 99)
								plot_dot(start_right_pos - 22.5/right_note_num_save[i-5+1] *25, notes[right_note_num_save[i-5] - 1], right_note_num_save[i+1]);
							else{
								if(right_note_num_save[i-10] != 999)
									plot_dot(start_right_pos - 22.5/right_note_num_save[i-5+1] *25, notes[right_note_num_save[i-10] - 1], right_note_num_save[i+1]);
								else
									plot_dot(start_right_pos - 22.5/right_note_num_save[i-5+1] *25, notes[right_note_num_save[i-15] - 1], right_note_num_save[i+1]);
							}
						}else{
							right_note_num_save.pop();
							right_note_num_save.pop();
							right_note_num_save.pop();
							right_note_num_save.pop();
							right_note_num_save.pop();
							start_right_pos -= 22.5/right_note_num_save[i+1] *25;
						}
					}
				}
				start_right_pos += 22.5/right_note_num_save[i+1] *25;
			}
		}

  }
  function jusi_play_only(){
		stop_all_play();
		
		time = 100;
		for(i = 0; i < left_note_num_save.length; i++){
			if(i % 5 == 0){
				if(i != 0)
					if(!left_note_num_save[i+3])
						time += speed / left_note_num_save[i-4];
				jusi_play_note(left_note_num_save[i], time, left_note_num_save[i + 2]);
				if(left_note_num_save[i] == 0)
					stop_left_hand_play(time);
			}
		}
		time = 100;
		for(i = 0; i < right_note_num_save.length; i++){
			if(i % 5 == 0){
				if(i != 0)
					if(!right_note_num_save[i+3])
						time += speed / right_note_num_save[i-4];
				jusi_play_note(right_note_num_save[i], time, right_note_num_save[i + 2]);
				if(right_note_num_save[i] == 0)
					stop_right_hand_play(time);
			}
		}

	document.getElementById("resetbutton").checked = false;
	document.getElementById("undobutton").checked = false;	
  }
  
function jusi_play_note(number, time, voice) {
  setTimeout(function(){
	  if(number != 0){
			audio = document.getElementById("piano_"+voice+"_"+number);
			if(audio){
				if (audio.paused) {
					audio.play();
				}else{
					audio.pause();
					audio.currentTime = 0;
					audio.play();
				}
			}
	  }
  }, time);
}
function stop_hand_play(hand_note_num_save_array) {
		for(i = 0; i < hand_note_num_save_array.length; i++){
			if(i % 5 == 0 && hand_note_num_save_array[i]!=0){
				if(hand_note_num_save_array[i] < 10){
					string_id = "piano_"+hand_note_num_save_array[i+2]+"_0"+hand_note_num_save_array[i];
					audio = document.getElementById("piano_"+hand_note_num_save_array[i+2]+"_0"+hand_note_num_save_array[i]);
				}
				else{
					string_id = "piano_"+hand_note_num_save_array[i+2]+"_"+hand_note_num_save_array[i];
					audio = document.getElementById("piano_"+hand_note_num_save_array[i+2]+"_"+hand_note_num_save_array[i]);
				}
				if(audio){
					if (!audio.paused) {
						audio.pause();
						audio.currentTime = 0;
					}
				}				
			}
		}
}
function stop_right_hand_play(time) {
  setTimeout(function(){
		stop_hand_play(right_note_num_save);
	  }, time);
}
function stop_left_hand_play(time) {
  setTimeout(function(){
		stop_hand_play(left_note_num_save);
	  }, time);
}
function stop_all_play() {
	var voice = ["pp", "mf", "ff"];
	for(j = 0; j < 3; j++){
		for(i = 1; i < 50; i++){
			if(i < 10){
				string_id = "piano_"+voice[j]+"_0"+i;
				audio = document.getElementById("piano_"+voice[j]+"_0"+i);
			}
			else{
				string_id = "piano_"+voice[j]+"_"+i;
				audio = document.getElementById("piano_"+voice[j]+"_"+i);
			}
			if(audio){
				if (!audio.paused) {
					audio.pause();
					audio.currentTime = 0;
				}
			}
		}
	}
}


var same_time_with_before = false;
function same_time(){
	if(same_time_with_before == true)
		same_time_with_before = false;
	else
		same_time_with_before = true;
	document.getElementById("resetbutton").checked = false;
	document.getElementById("undobutton").checked = false;
	document.getElementById("playbutton").checked = false;
}

</script>




<link id="stylecall" rel="stylesheet" href="/piano_submit_style.css" />
<form id="myForm_right_hand" action="/piano_save_js_array_to_php.php" method="post"> 
	<input type="hidden" id="str_right_hand" name="str_right_hand" value="" /> 
	<input class="can_click" type="submit" id="btn_right_hand" name="submit" value="Upload the Right Hand Melody" />
</form>
<form id="myForm_left_hand" action="/piano_save_js_array_to_php.php" method="post">
	<input type="hidden" id="str_left_hand" name="str_left_hand" value="" /> 
	<input class="can_click" type="submit" id="btn_left_hand" name="submit" value="Upload the Left Hand Melody" />
</form>
<span id="result_right_hand"></span> 	
<span id="result_left_hand"></span></br>	
<script>
	function disable_btn_L(){
		document.getElementById('btn_left_hand').disabled = true;
		document.getElementById('btn_left_hand').classList.remove("can_click");
		document.getElementById('btn_left_hand').style.backgroundColor = "#68ffc7";
		
		var now = 60;
		var x = setInterval(function() {
		  document.getElementById("btn_left_hand").value = "If you want to upload the Left Hand Melody, please wait for " + (now - 1) + "(s).";
		  now--;
		  if (now < 0) {
			clearInterval(x);
			document.getElementById("btn_left_hand").value = "Upload the Left Hand Melody";
			document.getElementById('btn_left_hand').disabled = false;
			document.getElementById('btn_left_hand').setAttribute("class", "can_click");
			document.getElementById('btn_left_hand').style.backgroundColor = "#00ad90";
		  }
		}, 1000);
	}
	function disable_btn_R(){
		document.getElementById('btn_right_hand').disabled = true;
		document.getElementById('btn_right_hand').classList.remove("can_click");
		document.getElementById('btn_right_hand').style.backgroundColor = "#68ffc7";
		
		var now = 60;
		var x = setInterval(function() {
		  document.getElementById("btn_right_hand").value = "If you want to upload the Right Hand Melody, please wait for "+ (now - 1) + "(s).";
		  now--;
		  if (now < 0) {
			clearInterval(x);
			document.getElementById("btn_right_hand").value = "Upload the Right Hand Melody";
			document.getElementById('btn_right_hand').disabled = false;
			document.getElementById('btn_right_hand').setAttribute("class", "can_click");
			document.getElementById('btn_right_hand').style.backgroundColor = "#00ad90";
		  }
		}, 1000);
	}
	$(document).ready(function(){
		$("#btn_right_hand").click( function() {
			$.post( $("#myForm_right_hand").attr("action"),
				 $('#str_right_hand').val(JSON.stringify(right_note_num_save)),  
				 //$("#myForm_right_hand :input").serializeArray(), 
				 function(info){ $("#result_right_hand").html(info); 
				}
			);
			disable_btn_R();
		});	 
		$("#myForm_right_hand").submit( function() {
			return false;	
		});		
	});
	
	$(document).ready(function(){
		$("#btn_left_hand").click( function() {
			$.post( $("#myForm_left_hand").attr("action"),
				 $('#str_left_hand').val(JSON.stringify(left_note_num_save)),  
				 //$("#myForm_left_hand :input").serializeArray(), 
				 function(info){ $("#result_left_hand").html(info); 
				}
			);
			disable_btn_L();
		});	 
		$("#myForm_left_hand").submit( function() {
			return false;	
		});		
	});
</script>	
	
<script>	
function start_beat_num_drawing_clear_one_hand(x){
	var array_of_canvas = [];
	for(i = 1; i < 100; i++){
		array_of_canvas[i] = "my_"+i+"_Canvas";
	}
	<?php
	for($i = 1; $i < 100; $i++){
		if($i != 1)
			echo"
			var c = document.getElementById(array_of_canvas[$i]);
			var context = c.getContext('2d');
			context.clearRect(0, 0, c.width, c.height);
			c.style.display = 'none';
			context = c.getContext('2d');
			context.beginPath();
			for(i = 0; i < 5; i++){
				context.moveTo(105 + 22.5/(beat_num%10) *25 *Math.floor(beat_num/10)*(i + 1) - 10, 40);
				context.lineTo(105 + 22.5/(beat_num%10) *25 *Math.floor(beat_num/10)*(i + 1) - 10, 80);
				context.moveTo(105 + 22.5/(beat_num%10) *25 *Math.floor(beat_num/10)*(i + 1) - 10, 100);
				context.lineTo(105 + 22.5/(beat_num%10) *25 *Math.floor(beat_num/10)*(i + 1) - 10, 140);
			}
			context.stroke();
			";
	}
	?>
	var c = document.getElementById(array_of_canvas[1]);
	var ctx = c.getContext('2d');
	ctx.clearRect(0, 0, c.width, c.height);
	set_drawing();
	//4-4beat
	ctx.beginPath();
	
	for(i = 0; i < 5; i++){
		ctx.moveTo(105 + 22.5/(beat_num%10) *25 *Math.floor(beat_num/10)*(i + 1) - 10, 40);
		ctx.lineTo(105 + 22.5/(beat_num%10) *25 *Math.floor(beat_num/10)*(i + 1) - 10, 80);
		ctx.moveTo(105 + 22.5/(beat_num%10) *25 *Math.floor(beat_num/10)*(i + 1) - 10, 100);
		ctx.lineTo(105 + 22.5/(beat_num%10) *25 *Math.floor(beat_num/10)*(i + 1) - 10, 140);
	}
	
	if(beat_num > 40 && beat_num < 50){
		ctx.moveTo(84, 40);
		ctx.lineTo(72, 50);
		ctx.lineTo(86, 50);
		ctx.moveTo(84, 40);
		ctx.lineTo(84, 60);

		ctx.moveTo(84, 100);
		ctx.lineTo(72, 110);
		ctx.lineTo(86, 110);
		ctx.moveTo(84, 100);
		ctx.lineTo(84, 120);
	}else if(beat_num > 30 && beat_num < 40){
		ctx.moveTo(74, 46);
		ctx.arc(80, 46, 6, Math.PI, Math.PI/4);
		ctx.lineTo(80, 50);
		ctx.arc(80, 54, 6, 7*Math.PI/4, Math.PI);
			
		ctx.moveTo(74, 106);
		ctx.arc(80, 106, 6, Math.PI, Math.PI/4);
		ctx.lineTo(80, 110);
		ctx.arc(80, 114, 6, 7*Math.PI/4, Math.PI);
	}else if(beat_num > 20 && beat_num < 30){
		ctx.moveTo(74, 46);
		ctx.arc(80, 46, 6, Math.PI, Math.PI/4);
		ctx.lineTo(74, 60);
		ctx.lineTo(86, 60);
		
		ctx.moveTo(74, 106);
		ctx.arc(80, 106, 6, Math.PI, Math.PI/4);
		ctx.lineTo(74, 120);
		ctx.lineTo(86, 120);
	}
		
	if(beat_num % 10 == 8){
		ctx.moveTo(80, 60);	
		ctx.arc(80, 66, 6, 3*Math.PI/2, Math.PI/4);
		ctx.moveTo(86, 70);	
		ctx.arc(80, 66, 6, 3*Math.PI/4, 3*Math.PI/2);
		ctx.moveTo(80, 70);
		ctx.arc(80, 74, 6, 7*Math.PI/4, 5*Math.PI/4);
		
		ctx.moveTo(80, 120);	
		ctx.arc(80, 126, 6, 3*Math.PI/2, Math.PI/4);
		ctx.moveTo(86, 130);	
		ctx.arc(80, 126, 6, 3*Math.PI/4, 3*Math.PI/2);
		ctx.moveTo(80, 130);
		ctx.arc(80, 134, 6, 7*Math.PI/4, 5*Math.PI/4);			
	}else if(beat_num % 10 == 4){
		ctx.moveTo(84, 60);
		ctx.lineTo(72, 70);
		ctx.lineTo(86, 70);
		ctx.moveTo(84, 60);
		ctx.lineTo(84, 80);		
		
		ctx.moveTo(84, 120);
		ctx.lineTo(72, 130);
		ctx.lineTo(86, 130);
		ctx.moveTo(84, 120);
		ctx.lineTo(84, 140);
	}else if(beat_num % 10 == 2){
		ctx.moveTo(74, 66);
		ctx.arc(80, 66, 6, Math.PI, Math.PI/4);
		ctx.lineTo(74, 80);
		ctx.lineTo(86, 80);
		
		ctx.moveTo(74, 126);
		ctx.arc(80, 126, 6, Math.PI, Math.PI/4);
		ctx.lineTo(74, 140);
		ctx.lineTo(86, 140);
	}
	ctx.stroke();
	
	start_left_pos = 105;
	start_right_pos = 105;
	
	if(x == 9){
		for(i = 0; i < left_note_num_save.length; i++){
			if(i % 5 == 0){
				if(left_note_num_save[i+3]){	//sync
					if(i!=0)
						start_left_pos -= 22.5/left_note_num_save[i-5+1] *25;
				}
				if(left_note_num_save[i]!=0 && left_note_num_save[i]!=999 && left_note_num_save[i]!=99){
					if(left_note_num_save[i]==2||left_note_num_save[i]==4||left_note_num_save[i]==7||left_note_num_save[i]==9||left_note_num_save[i]==11||left_note_num_save[i]==14
					||left_note_num_save[i]==16||left_note_num_save[i]==19||left_note_num_save[i]==21||left_note_num_save[i]==23||left_note_num_save[i]==26||left_note_num_save[i]==28||left_note_num_save[i]==31
					||left_note_num_save[i]==33||left_note_num_save[i]==35||left_note_num_save[i]==38||left_note_num_save[i]==40||left_note_num_save[i]==43||left_note_num_save[i]==45||left_note_num_save[i]==47){
						plot_note_with_flat(start_left_pos, notes[left_note_num_save[i] - 1], left_note_num_save[i+1]);
					}else
						plot_note(start_left_pos, notes[left_note_num_save[i] - 1], left_note_num_save[i+1]);
				}else{
					if(left_note_num_save[i]==0)
						plot_rest(start_left_pos, left_note_num_save[i+4], left_note_num_save[i+1]);
					else if(left_note_num_save[i]==99){
						if(left_note_num_save[i-5]!=99){
							if(left_note_num_save[i-5] != 999 )
								plot_tie(start_left_pos, notes[left_note_num_save[i-5] - 1], left_note_num_save[i+1], start_left_pos - 22.5/left_note_num_save[i-5+1] *25);
							else
								plot_tie(start_left_pos, notes[left_note_num_save[i-10] - 1], left_note_num_save[i+1], start_left_pos - 22.5/left_note_num_save[i-5+1] *25 - 22.5/left_note_num_save[i-10+1] *25);
						}
					}
					else if(left_note_num_save[i]==999){
						if(left_note_num_save[i-5] != 0 && left_note_num_save[i-5] != 999){
							left_note_num_save[i+1] = left_note_num_save[i-4] * 2;
							if(left_note_num_save[i-5] != 99)
								plot_dot(start_left_pos - 22.5/left_note_num_save[i-5+1] *25, notes[left_note_num_save[i-5] - 1], left_note_num_save[i+1]);
							else{
								if(left_note_num_save[i-10] != 999)
									plot_dot(start_left_pos - 22.5/left_note_num_save[i-5+1] *25, notes[left_note_num_save[i-10] - 1], left_note_num_save[i+1]);
								else
									plot_dot(start_left_pos - 22.5/left_note_num_save[i-5+1] *25, notes[left_note_num_save[i-15] - 1], left_note_num_save[i+1]);
								}
							}
					}
				}
				start_left_pos += 22.5/left_note_num_save[i+1] *25;
			}
		}	
	}else if(x == 1){
		for(i = 0; i < right_note_num_save.length; i++){
			if(i % 5 == 0){
				if(right_note_num_save[i+3]){
					if(i!=0)
						start_right_pos -= 22.5/right_note_num_save[i-5+1] *25;
				}
				if(right_note_num_save[i]!=0 && right_note_num_save[i]!=999 && right_note_num_save[i]!=99){
					if(right_note_num_save[i]==2||right_note_num_save[i]==4||right_note_num_save[i]==7||right_note_num_save[i]==9||right_note_num_save[i]==11||right_note_num_save[i]==14
					||right_note_num_save[i]==16||right_note_num_save[i]==19||right_note_num_save[i]==21||right_note_num_save[i]==23||right_note_num_save[i]==26||right_note_num_save[i]==28||right_note_num_save[i]==31
					||right_note_num_save[i]==33||right_note_num_save[i]==35||right_note_num_save[i]==38||right_note_num_save[i]==40||right_note_num_save[i]==43||right_note_num_save[i]==45||right_note_num_save[i]==47){
						plot_note_with_flat(start_right_pos, notes[right_note_num_save[i] - 1], right_note_num_save[i+1]);
					}else
						plot_note(start_right_pos, notes[right_note_num_save[i] - 1], right_note_num_save[i+1]);	
				}else{
					if(right_note_num_save[i]==0)
						plot_rest(start_right_pos, right_note_num_save[i+4], right_note_num_save[i+1]);
					else if(right_note_num_save[i]==99){
						if(right_note_num_save[i-5]!=99){
							if(right_note_num_save[i-5] != 999)
								plot_tie(start_right_pos, notes[right_note_num_save[i-5] - 1], right_note_num_save[i+1], start_right_pos - 22.5/right_note_num_save[i-5+1] *25);
							else
								plot_tie(start_right_pos, notes[right_note_num_save[i-10] - 1], right_note_num_save[i+1], start_right_pos - 22.5/right_note_num_save[i-5+1] *25 - 22.5/right_note_num_save[i-10+1] *25);
						}
					}
					else if(right_note_num_save[i]==999){
						if(right_note_num_save[i-5] != 0 && right_note_num_save[i-5] != 999){
							right_note_num_save[i+1] = right_note_num_save[i-4] * 2;
							if(right_note_num_save[i-5] != 99)
								plot_dot(start_right_pos - 22.5/right_note_num_save[i-5+1] *25, notes[right_note_num_save[i-5] - 1], right_note_num_save[i+1]);
							else{
								if(right_note_num_save[i-10] != 999)
									plot_dot(start_right_pos - 22.5/right_note_num_save[i-5+1] *25, notes[right_note_num_save[i-10] - 1], right_note_num_save[i+1]);
								else
									plot_dot(start_right_pos - 22.5/right_note_num_save[i-5+1] *25, notes[right_note_num_save[i-15] - 1], right_note_num_save[i+1]);
							}
						}
					}
				}
				start_right_pos += 22.5/right_note_num_save[i+1] *25;
			}
		}
	}
	
	document.getElementById("playbutton").checked = false;
	document.getElementById("resetbutton").checked = false;
	document.getElementById("undobutton").checked = false;
}
</script>

<link id="stylecall" rel="stylesheet" href="piano_focus_bar_style.css" />
<input type="text" id="key" placeholder="Click HERE and TYPE sth">

<h4>Mode:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h4>
<label class="switch">
  <input id="changebutton" type="checkbox" onclick="change_mode();">
  <span class="slider"></span>
</label>

<link id="stylecall" rel="stylesheet" href="piano_keyboard_style.css" />
<div id="container" class="notebook_con">
    <ul id="keyboard" class="notebook" style="display:none;">
        <li class="symbol">`</li>
        <li class="symbol">1</li>
        <li class="symbol">2</li>
        <li class="symbol">3</li>
        <li class="symbol">4</li>
        <li class="symbol">5</li>
        <li class="symbol">6</li>
        <li class="symbol">7</li>
        <li class="symbol">8</li>
        <li class="symbol">9</li>
        <li class="symbol">0</li>
        <li class="symbol">-</li>
        <li class="symbol">=</li>
        <li class="delete lastitem">backspace</li>
		
        <li class="tab">tab</li>
        <li class="letter">q</li>
        <li class="letter">w</li>
        <li class="letter">e</li>
        <li class="letter">r</li>
        <li class="letter">t</li>
        <li class="letter">y</li>
        <li class="letter">u</li>
        <li class="letter">i</li>
        <li class="letter">o</li>
        <li class="letter">p</li>
        <li class="symbol">[</li>
        <li class="symbol">]</li>
        <li class="symbol lastitem">\</li>
		
        <li class="capslock">caps lock</li>
        <li class="letter">a</li>
        <li class="letter">s</li>
        <li class="letter">d</li>
        <li class="letter">f</li>
        <li class="letter">g</li>
        <li class="letter">h</li>
        <li class="letter">j</li>
        <li class="letter">k</li>
        <li class="letter">l</li>
        <li class="symbol">;</li>
        <li class="symbol">'</li>
        <li class="return lastitem">enter</li>
		
        <li class="left-shift">shift</li>
        <li class="letter">z</li>
        <li class="letter">x</li>
        <li class="letter">c</li>
        <li class="letter">v</li>
        <li class="letter">b</li>
        <li class="letter">n</li>
        <li class="letter">m</li>
        <li class="symbol">,</li>
        <li class="symbol">.</li>
        <li class="symbol">/</li>
        <li class="right-shift lastitem">shift</li>
		
        <li class="symbol">ctrl</li>
        <li class="symbol">fn</li>
        <li class="symbol"></li>
        <li class="symbol">alt</li>
        <li class="space-bar">space</li>
        <li class="symbol">alt</li>
        <li class="symbol"></li>
        <li class="symbol">ctrl</li>
        <li class="arrow_left"><i class="arrow left"></i></li>
        <li class="arrow_up"><i class="arrow up"></i></li>
        <li class="arrow_right"><i class="arrow right"></i></li>
        <li class="arrow_down lastitem"><i class="arrow down"></i></li>&nbsp;
    </ul>

	
	
	<ul id="keyboard" class="music" style="display:none;">
        <li class="symbol white">`</li>
        <li class="symbol black">1</li>
        <li class="symbol black">2</li>
        <li class="symbol"></li>
        <li class="symbol black">4</li>
        <li class="symbol black">5</li>
        <li class="symbol black">6</li>
        <li class="symbol"></li>
        <li class="symbol black">8</li>
        <li class="symbol black">9</li>
        <li class="symbol"></li>
        <li class="symbol black">-</li>
        <li class="symbol black">=</li>
        <li class="delete lastitem black">backspace</li>
		
        <li class="tab"></li>
        <li class="letter white">q</li>
        <li class="letter white">w</li>
        <li class="letter white">e</li>
        <li class="letter white">r</li>
        <li class="letter white">t</li>
        <li class="letter white">y</li>
        <li class="letter white">u</li>
        <li class="letter white">i</li>
        <li class="letter white">o</li>
        <li class="letter white">p</li>
        <li class="symbol white">[</li>
        <li class="symbol white">]</li>
        <li class="symbol lastitem white">\</li>
		
        <li class="capslock"></li>
        <li class="letter black">a</li>
        <li class="letter black">s</li>
        <li class="letter"></li>
        <li class="letter black">f</li>
        <li class="letter black">g</li>
        <li class="letter black">h</li>
        <li class="letter"></li>
        <li class="letter black">k</li>
        <li class="letter black">l</li>
        <li class="symbol"></li>
        <li class="symbol black">'</li>
        <li class="return lastitem black">enter</li>
		
        <li class="left-shift"></li>
        <li class="letter white">z</li>
        <li class="letter white">x</li>
        <li class="letter white">c</li>
        <li class="letter white">v</li>
        <li class="letter white">b</li>
        <li class="letter white">n</li>
        <li class="letter white">m</li>
        <li class="symbol white">,</li>
        <li class="symbol white">.</li>
        <li class="symbol white">/</li>
        <li class="right-shift lastitem"></li>
		
        <li class="symbol white">ctrl</li>
        <li class="symbol"></li>
        <li class="symbol"></li>
        <li class="symbol"></li>
        <li class="space-bar white">space</li>
        <li class="symbol"></li>
        <li class="symbol"></li>
        <li class="symbol"></li>
        <li class="arrow_left white"><i class="arrow left"></i></li>
        <li class="arrow_up black"><i class="arrow up"></i></li>
        <li class="arrow_right white"><i class="arrow right"></i></li>
        <li class="arrow_down white lastitem"><i class="arrow down"></i></li>&nbsp;
    </ul>

	
	<ul id="keyboard" class="music_note">
        <li class="symbol white">C2</li>
        <li class="symbol black">Db2</li>
        <li class="symbol black">Eb2</li>
        <li class="symbol"></li>
        <li class="symbol black">Gb2</li>
        <li class="symbol black">Ab2</li>
        <li class="symbol black">Bb2</li>
        <li class="symbol"></li>
        <li class="symbol black">Db3</li>
        <li class="symbol black">Eb3</li>
        <li class="symbol"></li>
        <li class="symbol black">Gb3</li>
        <li class="symbol black">Ab3</li>
        <li class="delete lastitem black">Bb3</li>
		
        <li class="tab"></li>
        <li class="letter white">D2</li>
        <li class="letter white">E2</li>
        <li class="letter white">F2</li>
        <li class="letter white">G2</li>
        <li class="letter white">A2</li>
        <li class="letter white">B2</li>
        <li class="letter white">C3</li>
        <li class="letter white">D3</li>
        <li class="letter white">E3</li>
        <li class="letter white">F3</li>
        <li class="symbol white">G3</li>
        <li class="symbol white">A3</li>
        <li class="symbol lastitem white">B3</li>
		
        <li class="capslock"></li>
        <li class="letter black">Db4</li>
        <li class="letter black">Eb4</li>
        <li class="letter"></li>
        <li class="letter black">Gb4</li>
        <li class="letter black">Ab4</li>
        <li class="letter black">Bb4</li>
        <li class="letter"></li>
        <li class="letter black">Db5</li>
        <li class="letter black">Eb5</li>
        <li class="symbol"></li>
        <li class="symbol black">Gb5</li>
        <li class="return lastitem black">Ab5</li>
		
        <li class="left-shift"></li>
        <li class="letter white">D4</li>
        <li class="letter white">E4</li>
        <li class="letter white">F4</li>
        <li class="letter white">G4</li>
        <li class="letter white">A5</li>
        <li class="letter white">B5</li>
        <li class="letter white">C5</li>
        <li class="symbol white">D5</li>
        <li class="symbol white">E5</li>
        <li class="symbol white">F5</li>
        <li class="right-shift lastitem"></li>
		
        <li class="symbol white">C4</li>
        <li class="symbol"></li>
        <li class="symbol"></li>
        <li class="symbol"></li>
        <li class="space-bar white">C6</li>
        <li class="symbol"></li>
        <li class="symbol"></li>
        <li class="symbol"></li>
        <li class="arrow_left white">G5</li>
        <li class="arrow_up black">Bb5</li>
        <li class="arrow_right white">A5</li>
        <li class="arrow_down white lastitem">B5</li>&nbsp;
    </ul>
</div>





		
<script>
var key = document.getElementById("key");
key.addEventListener("keydown", function (e) {
	document.getElementById('key').value = "";
	<?php
	$keyboard_code = array(192, 49, 81, 50, 87, 69, 52, 82, 53, 84, 54, 89, 85, 56, 73, 57, 79, 80, 189, 219, 187, 221, 8, 220, 17, 65, 90, 83, 88, 67, 70, 86, 71, 66, 72, 78, 77, 75, 188, 76, 190, 191, 222, 37, 13, 40, 38, 39, 32);
	for($i = 0; $i < 49; $i++){
		$j = $i + 1;
		if($i < 9)
			echo('
				if (e.keyCode === '.$keyboard_code[$i].') {  
					x = document.getElementById("piano_mf_0'.$j.'"); 
					if (x.paused) {
						x.play();
					}else{
						x.pause();
						x.currentTime = 0;
						x.play();
					}
				}
			');
		else
			echo('
				if (e.keyCode === '.$keyboard_code[$i].') {  
					x = document.getElementById("piano_mf_'.$j.'"); 
					if (x.paused) {
						x.play();
					}else{
						x.pause();
						x.currentTime = 0;
						x.play();
					}
				}
			');
	}
	?>
});

</script>

<?php
for($i = 1; $i < 50; $i++){
	if($i < 10)
		echo('
			<audio id="piano_mf_0'.$i.'" controls style="display:none">
			  <source src="/piano/Piano.mf.0'.$i.' (1).mp3" type="audio/mp3">
			</audio>
		');		
	else
		echo('
			<audio id="piano_mf_'.$i.'" controls style="display:none">
			  <source src="/piano/Piano.mf.'.$i.' (1).mp3" type="audio/mp3">
			</audio>
		');
}
for($i = 1; $i < 50; $i++){
	if($i < 10)
		echo('
			<audio id="piano_ff_0'.$i.'" controls style="display:none">
			  <source src="/piano/Piano.ff.0'.$i.' (1).mp3" type="audio/mp3">
			</audio>
		');		
	else
		echo('
			<audio id="piano_ff_'.$i.'" controls style="display:none">
			  <source src="/piano/Piano.ff.'.$i.' (1).mp3" type="audio/mp3">
			</audio>
		');
}
for($i = 1; $i < 50; $i++){
	if($i < 10)
		echo('
			<audio id="piano_pp_0'.$i.'" controls style="display:none">
			  <source src="/piano/Piano.pp.0'.$i.' (1).mp3" type="audio/mp3">
			</audio>
		');		
	else
		echo('
			<audio id="piano_pp_'.$i.'" controls style="display:none">
			  <source src="/piano/Piano.pp.'.$i.' (1).mp3" type="audio/mp3">
			</audio>
		');
}
?>
</div>
</body>
</html>