<?php
include_once('mysql.php');

if(isset($_POST['id']) && isset($_POST['name'])){
	
	$result = mysqli_query($link, "SELECT * FROM `user` WHERE `userFBID`=".$_POST['id']." AND `userFBNAME`='".$_POST['name']."';") or die(mysqli_error($link));
	$row = mysqli_num_rows($result);
	if($row == '0'){
		mysqli_query($link, "INSERT INTO `user`(`userFBID`, `userFBNAME`, `active`) VALUES(".$_POST['id'].", '".$_POST['name']."', '1');") or die(mysqli_error($link));
	}

	$result = mysqli_query($link, "SELECT `userID` FROM `user` WHERE `userFBID` = '".$_POST['id']."' AND `userFBNAME` = '".$_POST['name']."';") or die(mysqli_error($link));
	$id = mysqli_fetch_assoc($result);

	session_start();
	$_SESSION['id'] = $id['userID'];

	mysqli_close($link);


}

if(isset($_POST['email']) && isset($_POST['password'])){

	$stmt = mysqli_stmt_init($link);
	mysqli_stmt_prepare($stmt, "SELECT `email`, `password`, `active` FROM `user` WHERE `email`=?;") or die(mysqli_error($link));
	mysqli_stmt_bind_param($stmt, 's', $_POST['email']);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);
	mysqli_stmt_close($stmt);

	$user = mysqli_fetch_assoc($result);

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
			$message = 'Please click this link to activate your account: http://localhost/gallery/htdocs/verify.php?email='.$_POST['email'].'&hash='.$hash.' ';
			$headers = "From: woof_warrior@email.com\r\n";
			mail($to, $subject, $message, $headers);

			echo json_encode('verify email. Please click this link to activate your account: http://localhost/gallery/htdocs/verify.php?email='.$_POST['email'].'&hash='.$hash);
		}else{
			if(password_verify($_POST['password'], $user['password'])){
				echo json_encode('logged in');

				$result = mysqli_query($link, "SELECT `userID` FROM `user` WHERE `email` = '".$_POST['email']."';") or die(mysqli_error($link));
				$id = mysqli_fetch_assoc($result);

				session_start();
				$_SESSION['id'] = $id['userID'];
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
	session_start();
	if(isset($_SESSION['id'])){
		echo json_encode('logged in');
	}else{
		echo json_encode('not logged in');
	}
}


?>