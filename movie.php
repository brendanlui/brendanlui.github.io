<?php include 'get_ip_address_and_insert_in_database.php';?>
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
<link id="stylecall" rel="stylesheet" href="/movie_yes_style.css" />
<body onload="start_the_website()">
<script>
	function start_the_website(){
		sortListDirTime();
		var list, item, date, save;
		list = document.getElementById("list_id");
		item = list.getElementsByClassName("item");
		date = list.getElementsByClassName("date");
		
		//today
		var today = new Date();
		var dd = today.getDate();
		var mm = today.getMonth()+1; //January is 0!
		var yyyy = today.getFullYear();
		if(dd<10) {
			dd = '0'+dd;
		} 
		if(mm<10) {
			mm = '0'+mm;
		} 
		today = yyyy + mm + dd;
		
		//yesterday
		var yesterday = new Date();
		yesterday.setDate(yesterday.getDate() - 1);
		var ddy = yesterday.getDate();
		var mmy = yesterday.getMonth()+1; //January is 0!
		var yyyyy = yesterday.getFullYear();
		if(ddy<10) {
			ddy = '0'+ddy;
		} 
		if(mmy<10) {
			mmy = '0'+mmy;
		} 
		yesterday = yyyyy + mmy + ddy;

		for (i = 0; i < item.length; i++) {
			if (date[i].innerHTML.localeCompare(today) == 0 || date[i].innerHTML.localeCompare(yesterday) == 0){
				document.getElementsByClassName("detail")[i].innerHTML += '<div class="new"><img src="/img/new_icon_transparent2_white.png" class="new_img_yes"></img></div>';
			}
		}
	}
</script>




<body>	
	<div id="head">
	<a href="/">
		<div id="logo">
			<img src="/img/dadiu.png" alt="dai01" class="logo_dadiu">
		</div>		
	</div>
	</a>
	
	<div class="wrapper">
		<input type="text" id="myInput" onkeyup="FilterFunction()" onKeyDown="if(event.keyCode==13) FilterFunction();" placeholder="Search by name">
		<input type="text" id="myInput2" onkeyup="FilterFunction()" onKeyDown="if(event.keyCode==13) FilterFunction();" placeholder="yyyymmdd">
		
		<script>
		function FilterFunction() {
			//#myInput
			var input_search, filter, div_all, item_array, here;
			input_search = document.getElementById('myInput');
			var input_array = input_search.value.trim().split(" ");
			
			div_all = document.getElementById("list_id");
			item_array = div_all.getElementsByClassName("item");

			var save = new Array(item_array.length);
			for(i = 0; i < item_array.length; i++){
				save[i] = new Array(input_array.length);
				item_array[i].style.display = 'block';
			}
			var save1 = new Array(item_array.length); //1 for "block"
			var save2 = new Array(item_array.length); //1 for "block"
			var save_both = new Array(item_array.length); //1 for "block"
			for(i = 0; i < item_array.length; i++){
				save_both[i] = 1;
				save1[i] = 1;
				save2[i] = 1;
			}
			
			for(j = 0; j < input_array.length; j++){			
						filter = input_array[j].toUpperCase();
						div_all = document.getElementById("list_id");
						item_array = div_all.getElementsByClassName("item");
						for (i = 0; i < item_array.length; i++) {
							here = item_array[i].getElementsByClassName("filter_item");
							if (here[0].innerHTML.toUpperCase().indexOf(filter) > -1) {
								save[i][j] = 1;
							} else {
								save[i][j] = 0;
							}
						}
			}
			
			for (i = 0; i < item_array.length; i++) {
				for(j = 0; j < input_array.length; j++){	
					if(save[i][j] == 0){
						save1[i] = 0;
						break;
					}
				}
			}
			
			//#myInput2
			var input_search2, filter2, div_all2, item_array2, here2;
			input_search2 = document.getElementById('myInput2');
			
			filter2 = input_search2.value;
			div_all2 = document.getElementById("list_id");
			item_array2 = div_all2.getElementsByClassName("item");
			for (i = 0; i < item_array2.length; i++) {
				here2 = item_array2[i].getElementsByClassName("date");
				if (here2[0].innerHTML.indexOf(filter2) > -1) {
					save2[i] = 1;
				} else {
					save2[i] = 0;
				}
			}			

			//judge #myInput and #myInput2 => both 1 then "block"
			for (i = 0; i < item_array.length; i++) {
				if(save2[i] == 1 && save1[i] == 1 ){
					//save_both[i] = 1; //maybe useful for other filter later
					item_array2[i].style.display = "block";
				}else{
					//save_both[i] = 0; //maybe useful for other filter later
					item_array2[i].style.display = "none";
				}
			}
		}
		</script>
		
	
	
	<button class="sort" style="clear:both;" type="submit" value="Sort_by_name" onclick="sortListDirName();"> Name</button>
	<button class="sort" style="clear:both;" type="submit" value="Sort_by_time" onclick="sortListDirTime();"> Date</button>
	<button class="sort" style="clear:both;" type="submit" value="Sort_by_size" onclick="sortListDirSize();"> Size</button>
	<button class="sort" style="clear:both;" type="submit" value="Sort_by_duration" onclick="sortListDirDuration();"> Duration</button>
	<button class="sort" style="clear:both;" type="submit" value="Sort_by_view" onclick="sortListDirView();"> View</button>
	<button class="sort" style="clear:both;" type="submit" value="Sort_by_company" onclick="sortListDirCompany();"> Company</button>
	<button class="sort" style="clear:both;" type="submit" value="favourite" onclick="favourite();"> Favourite</button>
	<!--generate the data existed
	<button class="sort" style="clear:both;" type="submit" value="favourite" onclick="print();"> print</button>
<div id="HEREHERE"></div>
<script>		
function print()		{
		var list, item, hour, date, promo, price, video, photo, range;
		
		list = document.getElementById("list_id");

		item = list.getElementsByClassName("item");
		video = new Array(item.length);
		photo = new Array(item.length);
		
		range = list.getElementsByClassName("img_container");
		range2 = list.getElementsByClassName("img_container");
	
		hour = list.getElementsByClassName("hour");
		size = list.getElementsByClassName("size");
		date = list.getElementsByClassName("date");
		promo = list.getElementsByClassName("promo");
		price = list.getElementsByClassName("price");
		name = list.getElementsByClassName("filter_item");

		for (i = 0; i < item.length; i++) {
			save = range[i].innerHTML.split("&")[0];
			save = save.split("video/")[1];
			video[i] = save;
		}
		for (i = 0; i < item.length; i++) {
		
			save2 = range2[i].innerHTML.split('src="/video/')[1];
			save2 = save2.split('"')[0];
			photo[i] = save2;
		
		}
		
		for (i = 0; i < item.length; i++) {
			document.getElementById("HEREHERE").innerHTML +="('"+  video[i] +"', '"+photo[i]+"', '"+hour[i].innerHTML+"', '"+size[i].innerHTML+"', '"+date[i].innerHTML+"', '"+promo[i].innerHTML+"', '"+price[i].innerHTML+"')," + "</br>";
		}
}
</script>
-->

<script>
		var clicked_view = 0;
		var clicked_time = 0;
		var clicked_size = 0;
		var clicked_hour = 0;
		var clicked_company = 0;
		var clicked_favourite = 0;
		
		function sortListDirView() {
		    var list, item, viewcount, save;
		    list = document.getElementById("list_id");

			item = list.getElementsByClassName("item");
			viewcount = list.getElementsByClassName("viewcount");
			
			var save_item = new Array(item.length);
			var save_viewcount_m = new Array(item.length);
			for(i = 0; i < item.length; i++){
				save_item[i] = item[i];
			}
			
			save = new Array(item.length);
			for (i = 0; i < item.length; i++) {
				
				save[i] = viewcount[i].innerHTML.split("View: ")[1];	///////////////
				save_viewcount_m[i] = save[i];
			}
			if (clicked_view == 0){
				save.sort(function(a, b){return b-a});
				clicked_view = 1;
			}
			else{
				save.sort(function(a, b){return a-b});
				clicked_view = 0;
			}
			
			list.innerHTML = '';
			
			for(i = 0; i < save_item.length; i++){
				for(j = 0; j < save_item.length; j++){
					if(save_viewcount_m[j] == save[i])
						list.appendChild(save_item[j]); 
				}						
			} 
			
		}
		
		function sortListDirTime() {
		    var list, item, date, save;
		    list = document.getElementById("list_id");

			item = list.getElementsByClassName("item");
			date = list.getElementsByClassName("date");
			
			var save_item = new Array(item.length);
			var save_date_m = new Array(item.length);
			for(i = 0; i < item.length; i++){
				save_item[i] = item[i];
			}
			
			save = new Array(item.length);
			for (i = 0; i < item.length; i++) {
				save[i] = date[i].innerHTML;
				save_date_m[i] = save[i];
			}
			if (clicked_time == 0){
				save.sort(function(a, b){return b-a});
				clicked_time = 1;
			}
			else{
				save.sort(function(a, b){return a-b});
				clicked_time = 0;
			}
			
			list.innerHTML = '';
			
			for(i = 0; i < save_item.length; i++){
				for(j = 0; j < save_item.length; j++){
					if(save_date_m[j] == save[i])
						list.appendChild(save_item[j]); 
				}						
			} 
			
		}
		
		function sortListDirName() {
		    var list, item, name, save;
		    list = document.getElementById("list_id");

			item = list.getElementsByClassName("item");
			name = list.getElementsByClassName("filter_item");
			
			var save_item = new Array(item.length);
			var save_name_m = new Array(item.length);
			for(i = 0; i < item.length; i++){
				save_item[i] = item[i];
			}
			
			save = new Array(item.length);
			for (i = 0; i < item.length; i++) {
				save[i] = name[i].innerHTML;
				save_name_m[i] = save[i];
			}
			
			save.sort();
			
			list.innerHTML = '';
			
			for(i = 0; i < save_item.length; i++){
				for(j = 0; j < save_item.length; j++){
					if(save_name_m[j] == save[i])
						list.appendChild(save_item[j]); 
				}						
			} 
			
			//alert(save_item.length); //check how many items here
		}
		function sortListDirCompany() {
		    var list, item, company, save;
		    list = document.getElementById("list_id");

			item = list.getElementsByClassName("item");
			company = list.getElementsByClassName("filter_item");
			
			var save_item = new Array(item.length);
			var save_company_m = new Array(item.length);
			for(i = 0; i < item.length; i++){
				save_item[i] = item[i];
			}
			
			save = new Array(item.length);
			for (i = 0; i < item.length; i++) {
				save[i] = company[i].innerHTML.split('_').pop().replace(/[^a-zA-Z0-9 ]/g, "").replace(/[0-9]/g, '').toUpperCase();
				save_company_m[i] = save[i];
			}
			
			save.sort();
			
			list.innerHTML = '';
			
			for(i = 0; i < save_item.length; i++){
				for(j = 0; j < save_item.length; j++){
					if(save_company_m[j] == save[i])
						list.appendChild(save_item[j]); 
				}						
			} 
			
			//alert(save_item.length); //check how many items here
		}
		function sortListDirSize() {
		    var list, item, size, save;
		    list = document.getElementById("list_id");

			item = list.getElementsByClassName("item");
			size = list.getElementsByClassName("size");
			
			var save_item = new Array(item.length);
			var save_size_m = new Array(item.length);
			for(i = 0; i < item.length; i++){
				save_item[i] = item[i];
			}
			
			save = new Array(item.length);
			for (i = 0; i < (item.length); i++) {
				if (size[i].innerHTML.indexOf('GB') > -1){
					save[i] = size[i].innerHTML.toLowerCase().replace(/\D/g, '')*1000000;
				}
				else if(size[i].innerHTML.indexOf('MB') > -1){
					save[i] = size[i].innerHTML.toLowerCase().replace(/\D/g, '')*1000;
				}
				else{
					save[i] = size[i].innerHTML.toLowerCase().replace(/\D/g, '');
				}
				save_size_m[i] = save[i];
			}
			
			if (clicked_size == 1){
				save.sort(function(a, b){return b-a});
				clicked_size = 0;
			}
			else{
				save.sort(function(a, b){return a-b});
				clicked_size = 1;
			}
			
			list.innerHTML = '';
			
			for(i = 0; i < save_item.length; i++){
				for(j = 0; j < save_item.length; j++){
					if(save_size_m[j] == save[i])
						list.appendChild(save_item[j]); 
				}						
			} 
		}
		
		
		function sortListDirDuration() {
		    var list, item, hour, save;
		    list = document.getElementById("list_id");

			item = list.getElementsByClassName("item");
			hour = list.getElementsByClassName("hour");
			
			var save_item = new Array(item.length);
			var save_hour_m = new Array(item.length);
			for(i = 0; i < item.length; i++){
				save_item[i] = item[i];
			}
			
			save = new Array(item.length);
			for (i = 0; i < (item.length); i++) {
				save[i] = hour[i].innerHTML.toLowerCase().replace(/[^\/\d]/g,'');
				save_hour_m[i] = save[i];
			}
			if (clicked_hour == 1){
				save.sort(function(a, b){return b-a});
				clicked_hour = 0;
			}
			else{
				save.sort(function(a, b){return a-b});
				clicked_hour = 1;
			}
			
			list.innerHTML = '';
			
			for(i = 0; i < save_item.length; i++){
				for(j = 0; j < save_item.length; j++){
					if(save_hour_m[j] == save[i])
						list.appendChild(save_item[j]); 
				}						
			} 			
	
		}
		
		function favourite(){
			var list, item, save;
			list = document.getElementById("list_id");
			item = list.getElementsByClassName("item");
			
			if(clicked_favourite == 0){
				for (i = 0; i < item.length; i++) {
					 save = item[i].getElementsByClassName("fav");
					 if (save.length <= 0) {
						 item[i].style.display = "none";
					}
				}
				clicked_favourite = 1;
			}else{
				for (i = 0; i < item.length; i++) {
					 item[i].style.display = "block";
				}
				clicked_favourite = 0;
			}
		}
</script>



<?php
//echo data
include 'config_database_value.php';
$con=mysqli_connect($servername, $username, $password, $dbname);
mysqli_set_charset($con, "utf8"); //view the chinese word in sql with Nvarchar

// Check connection
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$result = mysqli_query($con,"SELECT * FROM database_movie_yes");

echo '
<ul class="list">
		<div class="list_of_source" id="list_id">	';

while($row = mysqli_fetch_array($result))
{
$array_video = explode('/', $row['video']);
$file_name = $array_video[0];
$photo_base = $row['photo'];
$photo_base = explode(".", $photo_base);
array_pop($photo_base);
$photo_base = implode('.', $photo_base);
echo '				
					<div class="item" category="" style="display:block;">
							<table class="item_table"><tbody>
							<tr>
								<td>
									<div class="img_container">
										<a href="/movie_yes_next.php?url=/video/'.$row['video'].'&title='.$photo_base.'&id='.$row['id'].'">
											<img src="/video/'.$file_name.'/'.$row['photo'].'" class="small_video_img" style="height: 222px; width: 400px"></img>
										</a>
									</div>
									<div class="filter_border">
										<a href="/movie_yes_next.php?url=/video/'.$row['video'].'&title='.$photo_base.'&id='.$row['id'].'" class="filter_item">
											'.$photo_base.'
										</a>
									</div>
									<div class="detail">
										<div class="hour">'.$row['duration'].'</div>&nbsp;
										<div class="size">'.$row['size'].'</div></br>
										<div class="viewcount">View: '.$row['viewcount'].'</div>
										<div class="date">'.$row['date'].'</div>&nbsp;
										<div class="promo">'.$row['state'].'</div>&nbsp
										<div class="price">'.$row['fee'].'</div>
										
									</div>
								</td>
							</tr>
							</tbody></table><li id="thisisavid'.$row['id'].'"></li>
					</div>';
}

echo '		</div>
</ul>';

mysqli_close($con);
?>



<script>
// get favorites from local storage or empty array
var favorites_yes = JSON.parse(localStorage.getItem('favorites_yes')) || [];
// add class 'fav' to each favorite
favorites_yes.forEach(function(favorite_yes) {
  document.getElementById(favorite_yes).className = 'fav';
});
// register click event listener
document.querySelector('.list').addEventListener('click', function(e) {
  var id = e.target.id,
      item = e.target,
      index = favorites_yes.indexOf(id);
  // return if target doesn't have an id (shouldn't happen)
  if (!id) return;
  // item is not favorite
  if (index == -1) {
    favorites_yes.push(id);
    item.className = 'fav';
  // item is already favorite
  } else {
    favorites_yes.splice(index, 1);
    item.className = '';
  }
  // store array in local storage
  localStorage.setItem('favorites_yes', JSON.stringify(favorites_yes));
});

// local storage stores strings so we use JSON to stringify for storage and parse to get out of storage
</script>


	
</body>

</html>