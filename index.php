<?php
session_start();
$counter_name = "counter.txt";

// Check if a text file exists. If not create one and initialize it to zero.
if (!file_exists($counter_name)) {
  $f = fopen($counter_name, "w");
  fwrite($f,"0");
  fclose($f);
}

// Read the current value of our counter file
$f = fopen($counter_name,"r");
$counterVal = intval(fread($f, filesize($counter_name)));
fclose($f);

// Has visitor been counted in this session?
// If not, increase counter value by one
if(!isset($_SESSION['hasVisited'])){
  //echo "hi";
  $_SESSION['hasVisited']="yes";
  $counterVal++;
  $counterVal = (string) $counterVal;
  $f = fopen($counter_name, "w");
  fwrite($f, $counterVal);
  fclose($f); 
}
//echo $_SESSION['hasVisited'];
?>

<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<title>Complem8</title>
    
  
<style>
  @media screen and (orientation:portrait) {
/* Portrait styles */
    .awesome{display:none;
    }
}
/* Landscape */
@media screen and (orientation:landscape) {
img{
  display:none;
  }
  center{display:none;
  }
}
  .awesome{
    text-align:center;
    width:100%;
    font-size:96px;
    margin-top:10%;
  }
  img {
    transition:transform 5s ease-out, -webkit-transform 5s ease-out;
    -webkit-transition:-webkit-transform 5s ease-out, transform 5s ease-out;
  }
  body {
    background:#FF0000;
    margin:10px;
    color:#00FFFF;
    font-family:abc;
    transition: background 5s ease-in-out, color 5s ease-in-out;
  }
  html *{
    -webkit-touch-callout: none; /* iOS Safari */
    -webkit-user-select: none; /* Safari */
       -moz-user-select: none; /* Firefox */
        -ms-user-select: none; /* Internet Explorer/Edge */
            user-select: none;
  }
  @font-face {
    font-family: abc;
    src: url(BLKCHCRY.TTF);
  }
  .footer{
    position:fixed;
    bottom:0;
    left:0;
    text-align:center;
    display:none;
    width:100%;
  }
</style> 
<script>
  //colors = ["#FF0000","#FF8000","#FFFF00","#80FF00","#00FF00","#00FF80","#00FFFF","#0080FF","#0000FF","#8000FF","#FF00FF","#FF0080"];
  colors = ["#FF0000","#00FF80","#FF00FF","#80FF00","#0000FF","#FF8000","#00FFFF","#FF0080","#00FF00","#8000FF","#FFFF00","#0080FF"];
  textcolors = ["#00FFFF","#FF0080","#00FF00","#8000FF","#FFFF00","#0080FF","#FF0000","#00FF80","#FF00FF","#80FF00","#0000FF","#FF8000"];
  array = ["error"];
  var xhrRequest = function (url, type, callback) {
  var xhr = new XMLHttpRequest();
  xhr.onload = function () {
    array = this.responseText.split("\n");
    array.splice(-1,1);
  };
  xhr.open(type, url);
  xhr.send();
};
  xhrRequest("complements.txt","GET",null);
  function displayText(string){
    document.getElementById("hi").innerHTML = string;
  }
  function motionEvent(event){
    var x = event.acceleration.x;
    var y = event.acceleration.y;
    var z = event.acceleration.z;
    if(x*x+y*y+z*z > 50*50 && !spinning){
      spin();
    }
  }
  if (window.DeviceMotionEvent) {
  window.addEventListener('devicemotion', motionEvent, false);
  }
  degrees = 0;
  position = 0;
  spinning = false;
  function getRandomColor () {
  var hex = Math.floor(Math.random() * 0xFFFFFF);
  return "#" + ("000000" + hex.toString(16)).substr(-6);
  }
  function spin(){
    if(!spinning){
    spinning = true;
    position++;
    if(position >= colors.length){
      position = 0;
    }
    document.body.style.background = colors[position];
    document.body.style.color = textcolors[position];
    degrees+= 7200;
    document.getElementsByTagName("img")[1].style.transform = "rotate("+degrees+"deg)";
    document.getElementsByTagName("img")[1].style['-webkit-transform'] = "rotate("+degrees+"deg)";
    rand = array[Math.floor(Math.random() * array.length)];
    setTimeout(function(){displayText(rand);spinning = false;}, 5000);
    }
  }
</script>
<meta name="apple-mobile-web-app-title" content="Complem8">
<meta name="apple-mobile-web-app-capable" content="yes">
<link href="icon152.png"
          sizes="152x152"
          rel="apple-touch-icon-precomposed">

    <!-- iPad retina icon (iOS < 7) -->
    <link href="icon144.png"
          sizes="144x144"
          rel="apple-touch-icon-precomposed">

    <!-- iPad non-retina icon -->
    <link href="icon76.png"
          sizes="76x76"
          rel="apple-touch-icon-precomposed">

    <!-- iPad non-retina icon (iOS < 7) -->
    <link href="icon72.png"
          sizes="72x72"
          rel="apple-touch-icon-precomposed">

    <!-- iPhone 6 Plus icon -->
    <link href="icon120.png"
          sizes="120x120"
          rel="apple-touch-icon-precomposed">

    <!-- iPhone retina icon (iOS < 7) -->
    <link href="icon114.png"
          sizes="114x114"
          rel="apple-touch-icon-precomposed">

    <!-- iPhone non-retina icon (iOS < 7) -->
    <link href="icon57.png"
          sizes="57x57" rel="apple-touch-icon-precomposed">
    <!-- Android manifest -->
    <link rel="manifest" href="manifest.json">
</head>
<body>
<div style="position:absolute;top:10px;left:10px;right:10px;width:auto;z-index:5;">
<img src="8ball2.png"  style="width:100%"> 
</div>
<!--<div style="position:absolute;top:10px;left:10px;right:10px;width:auto;">-->
<img src="8ball.png" onclick="spin()" style="position:relative;z-index:10;width:100%">
<!--</div>-->

  <center><h1 id="hi"></h1></center>
  <h1 class="awesome">You are awesome!</h1>
  <div class="footer">
  <?php echo "You are visitor number $counterVal to this site";?>
</div>
</body>
</html>
