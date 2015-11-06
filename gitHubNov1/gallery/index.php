<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Images</title>
	<script type="text/javascript" charset="utf-8" src="js/function.js"></script>
	<script type="text/javascript" charset="utf-8" src="js/vote.js"></script>
    <script>
// This is called with the results from from FB.getLoginStatus().
function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
      // Logged into your app and Facebook.
      testAPI();
    } else if (response.status === 'not_authorized') {
      // The person is logged into Facebook, but not your app.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into this app.';
    } else {
      // The person is not logged into Facebook, so we're not sure if
      // they are logged into this app or not.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into Facebook.';
    }
}

  // This function is called when someone finishes with the Login
  // Button.  See the onlogin handler attached to it in the sample
  // code below.
function checkLoginState() {
    FB.getLoginStatus(function(response) {
        statusChangeCallback(response);
    });
}

window.fbAsyncInit = function() {
    FB.init({
        appId      : '936089563130570',
        cookie     : true,  // enable cookies to allow the server to access 
                        // the session
        xfbml      : true,  // parse social plugins on this page
        version    : 'v2.2' // use version 2.2
    });

  // Now that we've initialized the JavaScript SDK, we call 
  // FB.getLoginStatus().  This function gets the state of the
  // person visiting this page and can return one of three states to
  // the callback you provide.  They can be:
  //
  // 1. Logged into your app ('connected')
  // 2. Logged into Facebook, but not your app ('not_authorized')
  // 3. Not logged into Facebook and can't tell if they are logged into
  //    your app or not.
  //
  // These three cases are handled in the callback function.

    FB.getLoginStatus(function(response) {
        statusChangeCallback(response);
    });
};

  // Load the SDK asynchronously
(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

  // Here we run a very simple test of the Graph API after login is
  // successful.  See statusChangeCallback() for when this call is made.
function testAPI() {
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me', function(response) {
        console.log('Successful login for: ' + response.name);

      //ajax call to set session and add user in database if not exists
        var httpRequest;
        httpRequest = new XMLHttpRequest();

        if (!httpRequest) {
            console.log('Cannot create an XMLHTTP instance');
            return false;
        }else{
            httpRequest.onreadystatechange = alertContents;
            httpRequest.open('POST', 'login.php', true);
            var data = "name="+encodeURIComponent(response.name)+"&id="+encodeURIComponent(response.id);
            httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            httpRequest.send(data);
        }

        function alertContents() {
            if (httpRequest.readyState === XMLHttpRequest.DONE) {
                if (httpRequest.status === 200) {
                    //console.log(httpRequest.responseText);
                } else {
                    console.log('There was a problem with the request.');
                }
            }
        }

        document.getElementById('status').innerHTML = 'Thanks for logging in, ' + response.name + '!';
    });
}

</script>

<!--
  Below we include the Login Button social plugin. This button uses
  the JavaScript SDK to present a graphical Login button that triggers
  the FB.login() function when clicked.
-->





</head>
<body>
<body>

      <div id="main" class="glow">
        <header id="main-header" class="header-bar content" data-swiftype-index="false"> 
            <div class="container">

            <a id="home-link" href="//woofwarrior.com" class="logo woof-logo" title="Woof" itemprop="url"> The Pet Technology 
            <img id="logo.jpg" src="logo.jpg" style="border: 0; float: left; height:50px; margin-right: 15px" /> 
            </a>

            </div>
        
        </header>
        
        <div>
        <div style="width:100%">
        <img id="title.png" src="title.png" style="border: 0; float: left; height:50px; margin-left: 45%" /> 
        
        </div>
        <div id="status">
		</div>
        <fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
</fb:login-button>

 <a id="sign-up" href="signup.html"  title="Sign Up" itemprop="url"> Sign Up for voting </a>
  <a id="login" href="login.html"  title="login" itemprop="url"> Log In </a>

        </div>
        

<p>Click on an image to view it in a separate window.</p>
<ul>
<?php # Script 11.6 - images.php
// This script lists the images in the uploads directory.
// This version now shows each image's file size and uploaded date and time.

// Set the default timezone:
date_default_timezone_set ('America/New_York');

$dir = '../uploads'; // Define the directory to view.

include('mysql.php');


// Display each image caption as a link to the JavaScript function:

//get all votes and images, sort by votes amount
$result = mysqli_query($link, "SELECT * FROM `votes_amount`, `image`, `description` WHERE `votes_amount`.`imageID`=`image`.`imageID` AND `description`.`descID`=`image`.`descID` ORDER BY `votes_amount`.`amount` DESC;") or die(mysqli_error($link));
$images = array();
while($row = mysqli_fetch_assoc($result)){
	$images[] = $row;
}

for($i=0;$i<count($images);$i++){
	//check if file exists in the folder
	if(is_file($dir.'/'.$images[$i]['name'])){

		// Get the image's size in pixels:
		$image_size = getimagesize ($dir."/".$images[$i]['name']);
		
		// Calculate the image's size in kilobytes:
		$file_size = round ( (filesize ($dir."/".$images[$i]['name'])) / 1024) . "kb";
		
		// Determine the image's upload date and time:
		$image_date = date("F d, Y H:i:s", filemtime($dir."/".$images[$i]['name']));
		
		// Make the image's name URL-safe:
		$image_name = urlencode($images[$i]['name']);

		//print the information
		echo 
		"<li class='image-query'><span id='".$images[$i]['imageID']."'>".$images[$i]['amount']."</span><a href=\"javascript:vote('".$images[$i]['name']."')\"><img width=50 heigth=50 src='up-arrow.png' /></a>
		
		<a href=\"javascript:create_window('$image_name',$image_size[0],$image_size[1])\">
		<img width=50 heigth=50 src='".$dir."/".$images[$i]['name']."' /></a> ".$images[$i]['desc']."</li>\n";
	}
}
mysqli_close($link);

?>
</ul>
        </div>
</body>
<style>

html{
    height: 100%;
}

div {
    display: block;
}

body{
	margin: 0px;
}

section{
	 position: relative;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
    color: #8A9299;
    margin: 0 auto;
    background:white;
}


html, body, div, span, applet, object, iframe, h1, h2, h3, h4, h5, h6, p, blockquote, pre, a, abbr, acronym, address, big, cite, code, del, dfn, em, img, ins, kbd, q, s, samp, small, strike, strong, sub, sup, tt, var, b, u, i, center, dl, dt, dd, ol, ul, li, fieldset, form, label, legend, table, caption, tbody, tfoot, thead, tr, th, td, article, aside, canvas, details, embed, figure, figcaption, footer, header, hgroup, menu, nav, output, ruby, section, summary, time, mark, audio, video {
    margin: 0;
    padding: 0;
    border: 0;
    font: inherit;
    font-size: 100%;
    vertical-align: baseline;
}

.header-bar {
    height: 80px;
    border-bottom: none;
    margin-top:0px;
}
.image-query{
	background:#ffffe3;
    border: 2px groove blue;
	list-style:none;

}


.header-bar .container {
    position: relative;
    background-image:url("dog-paw.jpeg");
    background-repeat: repeat-x;
    background-size: 20px 30px;
	box-shadow: inset 0px 0px 0px 0px #0FE1FC,0px -40px 48px 27px #0FE1FC;
    height: 100%;
}

.logo.woof-logo {
    top: 24px;
    display: block;
    position: absolute;
    left: 30px;
    top: 30px;
    z-index: 400;
    overflow: hidden;
}



.content.main-wrapper {
    width: 100%;
    margin: 50px auto;
    position:relative;

}

.content {
    position: relative;
    background-color: #ffffff;
    max-width: 1280px;
    margin-top:0px;
}

div.prototype-photo{
	position: relative;
	background-image: url("image2.JPG");
	background-size: 334px 252px;
	width: 334px;
	height: 252px;
	background-position: center;
	margin-left: 33%;
	margin-top: 15%;
}

div.tshirt{
	position: relative;
	background-image: url("order-now.jpg");
	background-size: 100% 252px;
	width: 252px;;
	height: 252px;
	background-position: center;

}

.hero-banner.events {

    background-color:black;
    background-repeat: no-repeat;
    background-size: fit;
    background-position: center top;
    background-color:black;
    height: 800px;
}

.home .hero-banner.protect hgroup {
    margin-top: 336px;
}

.text-block{
height:600px;
width:1000px;
display:block;
margin:50px auto;
  	top: 50px;
  	background:white;
  	text-align:center;
  	overflow:scroll;
}


#main {
    position: relative;
        margin-top:0px;
    width: 100%;
    max-width: 1280px;
    overflow: hidden;
    margin-left: auto;
    margin-right: auto;
    height:3000px;
    background-color: black;
}


 .slider{
  	width:1000px;
  	height:600px;
  	margin:0px auto;
  	top: 50px;
  	background:white;
  	text-align:center;
  }

  .glow{

box-shadow: inset -1px 0px 0px 0px #ABABAB,0px 0px 48px 27px #0FE1FC;
-webkit-box-shadow: inset 0px 0px 0px 0px #ABABAB,0px 0px 48px 27px #0FE1FC;
-moz-box-shadow: inset -1px 0px 0px 0px #ABABAB,0px 0px 48px 27px #0FE1FC;
-o-box-shadow: inset -1px 0px 0px 0px #ABABAB,0px 0px 48px 27px #0FE1FC;

  }
</style>
</html>