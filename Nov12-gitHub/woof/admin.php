<?php
session_start();
include_once('mysql.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/config.php');

if(isset($_SESSION['username']) && $_SESSION['username'] == 'Woof Warrior'){
	
?>


<html>
<head></head>
<body>
<div><?php echo $_SESSION['username'];?></div>
<div>
	<ul>
		<li><a href='addpost.html'>Add new post</a></li>
		<li><a href='postslist.php'>All posts</a></li>
	<ul>
</div>

<div id="myPosts">
	<ul>
	<?php 
mysqli_select_db($link, $blogdb);
$res = mysqli_query($link, "SELECT * FROM `forum_posts` WHERE `post_owner`='Woof Warrior';") or die(mysqli_error($link));
while($row = mysqli_fetch_assoc($res)){
	$posts[] = $row;
}

if(!empty($posts)){
	for($i=0;$i<count($posts);$i++){
		echo "<li><a href='showpost.php?post_id=".$posts[$i]['post_id']."'>".$posts[$i]['post_title']."</a> <a class=deletePost id=".$posts[$i]['post_id'].">Delete</a></li>";
	}
}
	?>
	</ul>
</div>

<div>
	<div id=loginForms>
		<fb:login-button scope="public_profile,email" onlogin="checkLoginState();"></fb:login-button>

		<div id="loginDiv"></div>
	</div>

	<div id="status"></div>

</div>

<script src="js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src=js/usersDelete.js></script>


<script type="text/javascript"> 

users_dir = 'http://'+window.location.hostname+'/users/';
users_pic_dir = 'http://'+window.location.hostname+'/users/profile_pic/';

	document.getElementsByTagName('body')[0].onload=function(){
		createScript(users_dir+'js/fbLogin.js');
		createScript(users_dir+'js/emailLogin.js');
	}

	function createScript(src){
	    var JSLink = src;
	    var JSElement = document.createElement('script');
	    JSElement.src = JSLink;
	    document.getElementsByTagName('body')[0].appendChild(JSElement);
	}

</script>

</body>
</html>

<?php
}else{
	header("Location: ".$users_dir."login.html");
}
?>