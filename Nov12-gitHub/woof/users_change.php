<?php
include_once('mysql.php');
mysqli_select_db($link, $usersdb);
session_start();

if(isset($_POST['action']) && $_POST['action'] == 'change_email'){
	$stmt = mysqli_prepare($link, "SELECT  `email` FROM `user` WHERE `email`=?");
	mysqli_stmt_bind_param($stmt, 's', $_POST['email']);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_bind_result($stmt, $email);
	while (mysqli_stmt_fetch($stmt)) {
	    $email = $email;
	}
	if(empty($email)){
		$stmt = mysqli_prepare($link, "UPDATE  `user` SET `email`=? WHERE `userID`=".$_SESSION['userID'].";");
		mysqli_stmt_bind_param($stmt, 's', $_POST['email']);
		mysqli_stmt_execute($stmt);
		echo json_encode('email changed');
	}else{
		echo json_encode('user with this email already exists');
	}
}


if(isset($_POST['action']) && $_POST['action'] == 'change_password'){
	if($_POST['new_password'] == $_POST['repeat_new_password']){
		$res = mysqli_query($link, "SELECT `password` FROM `user` WHERE `userID`=".$_SESSION['userID']." ;") or die(mysqli_error($link));
		$password = mysqli_fetch_assoc($res);

		if(strcmp(crypt($_POST['current_password'], $password['password']), $password['password']) === 0){
			$salt = '$2y$11$' . substr(md5(uniqid(rand(), true)), 0, 22);
		    $password =  crypt($_POST['new_password'], $salt);

			mysqli_query($link, "UPDATE  `user` SET `password`='".$password."' WHERE `userID`=".$_SESSION['userID'].";");
			
			echo json_encode('password changed');
		}else{
			echo json_encode('incorrect password');
		}
	}else{
		echo json_encode('passwords dont match');
	}
}


?>