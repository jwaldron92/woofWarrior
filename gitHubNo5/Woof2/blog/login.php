<?php
session_start();
session_set_cookie_params(60*60*24*7);
include_once('mysql.php');



if(isset($_POST['id']) && isset($_POST['name'])){
	$result = mysqli_query($link, "SELECT * FROM `user` WHERE `email`='".$_POST['email']."' ;") or die(mysqli_error($link));
	$user = mysqli_fetch_assoc($result);
print_r($user);
	if($user['userFBID'] == NULL && $user['email'] == NULL){
		mysqli_query($link, "INSERT INTO `user`(`userFBID`, `userFBNAME`, `email`, `active`) VALUES(".$_POST['id'].", '".$_POST['name']."', '".$_POST['email']."', '1');") or die(mysqli_error($link));
	}elseif($user['userFBID'] == NULL && $user['email'] != NULL){
		mysqli_query($link, "UPDATE `user` SET `userFBID`=".$_POST['id'].", `userFBNAME`='".$_POST['name']."';") or die(mysqli_error($link));
	}

	$result = mysqli_query($link, "SELECT `userID` FROM `user` WHERE `userFBID` = '".$_POST['id']."' AND `userFBNAME` = '".$_POST['name']."';") or die(mysqli_error($link));
	$id = mysqli_fetch_assoc($result);

	
	$_SESSION['userID'] = $id['userID'];

	if($_POST['id'] == '100007029704087'){
		$_SESSION['username'] =  'Woof Warrior';
	}else{
		$_SESSION['username'] =  $_POST['name'];
	}

	mysqli_close($link);


}

if(isset($_POST['email']) && isset($_POST['password'])){

	$user = array();

	$stmt = mysqli_prepare($link, "SELECT `email`, `password`, `active` FROM `user` WHERE `email`=?;");
    mysqli_stmt_bind_param($stmt, 's', $_POST['email']);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $email, $password, $active);
    while (mysqli_stmt_fetch($stmt)) {
        $user['email'] = $email;
        $user['password'] = $password;
        $user['active'] = $active;
    }

	if(!empty($user)){
		if($user['active'] == '0'){
			
			$hash = hash('md5', $_POST["email"]);
			$stmt = mysqli_prepare($link, "UPDATE `verify_email` SET `email`=?, `hash`='".$hash."';") or die(mysqli_error($link));
			mysqli_stmt_bind_param($stmt, 's', $_POST['email']);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);

			mysqli_close($link);

			$to = $_POST['email'];
			$subject = 'Email varification';
			$message = 'Please click this link to activate your account: http://woofwarrior.com/blog/verify.php?email='.$_POST['email'].'&hash='.$hash.' ';
			$headers = "From: woof_warrior@woof_warrior.com\r\n";
			mail($to, $subject, $message, $headers);

			//echo json_encode('verify email. Please click this link to activate your account: http://localhost/gallery/htdocs/verify.php?email='.$_POST['email'].'&hash='.$hash);
			echo json_encode('verify email');
		}else{
			//if(hash_equals($user['password'], crypt($_POST['password'], $user['password']))){
			if(crypt($_POST['password'], $user['password'] == $user['password'])){
				echo json_encode('logged in');

				$result = mysqli_query($link, "SELECT `userID`, `username` FROM `user` WHERE `email` = '".$_POST['email']."';") or die(mysqli_error($link));
				$info = mysqli_fetch_assoc($result);

				$_SESSION['userID'] = $info['userID'];
				$_SESSION['username'] = $info['username'];
				mysqli_close($link);
			}else{
				echo json_encode('incorrect_password');
			}
		}
	}else{
		echo json_encode('user with this email doesnt exist');
	}
}


if(isset($_POST['action']) && $_POST['action'] == 'checkLogin'){
	if(isset($_SESSION['userID'])){
		echo json_encode('logged in');
	}else{
		echo json_encode('not logged in');
	}
}

if(isset($_POST['action']) && $_POST['action'] == 'logout'){
	session_unset();
	session_destroy();
	echo json_encode('logged out');
}

?>
