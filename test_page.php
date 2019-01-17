<?php include 'get_ip_address_and_insert_in_database.php';?>
<HTML>
<head>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width">
	<link id="stylecall" rel="stylesheet" href="/academic_style.css" />
	<link id="stylecall" rel="stylesheet" href="/test_page_style.css" />
	<link rel="icon" 
	  type="image/png" 
	  href="/img/d01.png">
</head>
<body>
	<div id="head">
	<a href="/">
		<div id="logo">
			<img src="/img/dai01.png" alt="dai01" style="width:300px;height:240px;">
		</div>
	</a>
	</div>
	
	
	
	
	
	
	

<script language="JavaScript">
	function changeColor(newcolor) {
		document.getElementById("myrect").
		style.backgroundColor=newcolor;
	return false; }
</script>

<div id="myrect" style="position:absolute; background-color:red; width:200px; height:100px"
	onmouseover="changeColor('blue');"
	onmouseout="changeColor('red');">
	<p>Layer content...</p>
</div></br></br></br></br></br></br></br></br></br>






<script language="JavaScript">
	/* One event handler is used for multiple objects */
	function handle_event(obj) {
	obj.style.background="red"; // Change the bg colour of obj
	}
</script>

<h2>Click on any object</h2>
<p style="background:lightgrey;"
	onclick="handle_event(this)">
	I'm a paragraph! </p>
<div style="background:lightgrey;"
	onclick="handle_event(this)">
	I'm a div! </div>
<span style="background:lightgrey;"
	onclick="handle_event(this)">
	I'm a span! </span></br></br></br></br></br></br>

	
	

	
	
	
<script type="text/javascript">
function AlertFilesize(){
    if(window.ActiveXObject){
        var fso = new ActiveXObject("Scripting.FileSystemObject");
        var filepath = document.getElementById('fileInput').value;
        var thefile = fso.getFile(filepath);
        var sizeinbytes = thefile.size;
    }else{
        var sizeinbytes = document.getElementById('fileInput').files[0].size;
    }

    var fSExt = new Array('Bytes', 'KB', 'MB', 'GB');
    fSize = sizeinbytes; i=0;while(fSize>900){fSize/=1024;i++;}

    var save_size_java = ((Math.round(fSize*100)/100)+' '+fSExt[i]);
}
</script>

<input id="fileInput" type="file" onchange="AlertFilesize();" /></br></br></br></br></br>
	
	

<div class="loader"></div>	</br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br>





<ul class="list">
  <li id="pancakes">Pancakes</li>
  <li id="donuts">Donuts</li>
  <li id="cupcakes">Cupcakes</li>
  <li id="icecream">Icecream</li>
  <li id="cookies">Cookies</li>
  <li id="chocolate">Chocolate</li>
</ul>
<script>
// get favorites from local storage or empty array
var favorites = JSON.parse(localStorage.getItem('favorites')) || [];
// add class 'fav' to each favorite
favorites.forEach(function(favorite) {
  document.getElementById(favorite).className = 'fav';
});
// register click event listener
document.querySelector('.list').addEventListener('click', function(e) {
  var id = e.target.id,
      item = e.target,
      index = favorites.indexOf(id);
  // return if target doesn't have an id (shouldn't happen)
  if (!id) return;
  // item is not favorite
  if (index == -1) {
    favorites.push(id);
    item.className = 'fav';
  // item is already favorite
  } else {
    favorites.splice(index, 1);
    item.className = '';
  }
  // store array in local storage
  localStorage.setItem('favorites', JSON.stringify(favorites));
});

// local storage stores strings so we use JSON to stringify for storage and parse to get out of storage
</script>	

</br></br></br></br></br></br></br></br></br></br></br></br></br></br>
</body>

</HTML>