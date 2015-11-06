<?php
session_start();
include_once('mysql.php');

if(isset($_SESSION['username'])){

?>


<html>
<head></head>
<body>
<div><?php echo 'Welcome, '.$_SESSION['username'];?></div>
<div>
	<ul>
	<li>
		<script type=text/javascript src=js/fbLogin.js></script>

	<fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
	</fb:login-button>

	<div id="status">
	</div>

	<div id="loginDiv"></div>

	<script type="text/javascript" src="js/emailLogin.js"></script>

	</li>
	<li><a href='addpost.html'>Add new post</a></li>
	<li><a href='postslist.php'>All posts</a></li>
	<ul>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script type="text/javascript" src=online.js></script>

</body>
</html>

<?php
}else{
	header("Location: login.html");
}
?>