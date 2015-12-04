<?php
session_start();

include_once('mysql.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/config.php');


if(isset($_SESSION['username']) && isset($_SESSION['userID'])){

?>


<html>
<head></head>
<body>
<div><?php echo 'Welcome, '.$_SESSION['username'];?></div>
<div>

<?php 

	mysqli_select_db($link, $usersdb);
	$res = mysqli_query($link, "SELECT `username` FROM `user` WHERE `userID`=".$_SESSION['userID'].";") or die(mysqli_error($link));
	$username = mysqli_fetch_assoc($res);
	if($username['username'] !='' && $username['username'] == $_SESSION['username']){

?>
	<div id="email">
	Change email
	<div id="statusEmail"></div>
	<?php 
	$res = mysqli_query($link, "SELECT `email` FROM `user` WHERE `userID`=".$_SESSION['userID'].";") or die(mysqli_error($link));
	$email = mysqli_fetch_assoc($res);
		echo "<input type=email name=current_email id=current_email disabled value=".$email['email']." /><br/>";
	?>
	<input type=email  name=new_email id=new_email placeholder='new email' /><br/>
	<input type=button id=changeEmail value='Change email' />
	</div>

	<div id="password">
		Change password
		<div id=statuspassword></div>

		<input type=password  name=current_password id=current_password placeholder='current password' /><br/>
		<input type=password  name=new_password id=new_password placeholder='new password' /><br/>
		<input type=password  name=repeat_new_password id=repeat_new_password placeholder='repeat password' /><br/>
		<input type=button id=changePassword value='Change password' />
	</div>
<?php 
}
?>
	<div id="profilePic">

	<?php 
$res = mysqli_query($link, "SELECT `pic_name` FROM `profile_pic` WHERE `user_id`=".$_SESSION['userID'].";") or die(mysqli_error($link));
$pic = mysqli_fetch_assoc($res);
if(!empty($pic)){
	echo "<img src='".$users_pic_dir.'/'.$pic['pic_name']."' width=100 heigth=100 />";
}
	?>
	</div>

	<div>Change profile pic<br/>
		<form name="image_form" method="post" enctype="multipart/form-data">
		<input type="file" id="file" name="file" /><br/>
		<input type=button id=submitChangePic value="Change"/>
		</form>
	</div>

	<div><a href='addpost.html'>Add new post</a></div>

	<div><a href='postslist.php'>All posts</a></div>

	<div id="myPosts">
	<ul>
	<?php 
mysqli_select_db($link, $blogdb);
$res = mysqli_query($link, "SELECT * FROM `forum_posts` WHERE `post_owner`=".$_SESSION['userID'].";") or die(mysqli_error($link));
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
</div>
<script src="js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src=js/usersDelete.js></script>
<script type="text/javascript" src=js/usersChange.js></script>

<script type="text/javascript"> 

users_dir = 'http://'+window.location.hostname+'/users/';
users_pic_dir = 'http://'+window.location.hostname+'/users/profile_pic/';

	document.getElementsByTagName('body')[0].onload=function(){
		createScript(users_dir+'js/fbLogin.js');
		createScript(users_dir+'js/emailLogin.js');
		createScript(users_dir+'js/profilePic.js');
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