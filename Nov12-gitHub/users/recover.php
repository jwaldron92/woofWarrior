<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
include_once('mysql.php');

if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash'])){
	$user = array();
	$stmt = mysqli_prepare($link, "SELECT `forgot_password`.`email`, `forgot_password`.`hash`, `forgot_password`.`expired` FROM `forgot_password` INNER JOIN `user` ON `forgot_password`.`email`=`user`.`email` WHERE `forgot_password`.`email`=? AND `forgot_password`.`hash`=?;") or die(mysqli_error($link)); 
	mysqli_stmt_bind_param($stmt, "ss", $_GET['email'], $_GET['hash']);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_bind_result($stmt, $email, $hash, $expired);
	while (mysqli_stmt_fetch($stmt)) {
	    $user['email'] = $email;
	    $user['hash'] = $hash;
	    $user['expired'] = $expired;
	}
	if(!empty($user)){
		if($user['expired'] < time()){
			echo '<div class="statusmsg">link is expired</div>';
		}else{
			echo "<form action=recover.php?email=".$_GET['email']."&hash=".$_GET['hash']." method=post ><input type=password name=password placeholder='New password' /><input type=submit value=Submit /></form>";
		}
	}else{
		echo '<div class="statusmsg">The url is either invalid or you already changed your password.</div>';
	}
}

if(isset($_POST['password'])){
	$user = array();
	$stmt = mysqli_prepare($link, "SELECT `forgot_password`.`email`, `forgot_password`.`hash`, `forgot_password`.`expired` FROM `forgot_password` INNER JOIN `user` ON `forgot_password`.`email`=`user`.`email` WHERE `forgot_password`.`email`=? AND `forgot_password`.`hash`=?;") or die(mysqli_error($link)); 
	mysqli_stmt_bind_param($stmt, "ss", $_GET['email'], $_GET['hash']);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_bind_result($stmt, $email, $hash, $expired);
	while (mysqli_stmt_fetch($stmt)) {
	    $user['email'] = $email;
	    $user['hash'] = $hash;
	    $user['expired'] = $expired;
	}

	if(!empty($user)){
		if($user['expired'] < time()){
			echo '<div class="statusmsg">link is expired</div>';
		}else{
			$salt = '$2y$11$' . substr(md5(uniqid(rand(), true)), 0, 22);
			$password =  crypt($_POST['password'], $salt);

			mysqli_query($link, "UPDATE `user` SET `password`='".$password."';") or die(mysqli_error($link));
			
			$stmt = mysqli_prepare($link, "DELETE FROM `forgot_password` WHERE `email`=? AND `hash`=?;") or die(mysqli_error($link));
		    mysqli_stmt_bind_param($stmt, "ss", $_GET['email'], $_GET['hash']);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
			mysqli_close($link);

			echo '<div class="statusmsg">Your password has been changed, you can now login</div>';
		}
	}else{
		echo '<div class="statusmsg">The url is either invalid or you already changed your password.</div>';
	}
}


?>