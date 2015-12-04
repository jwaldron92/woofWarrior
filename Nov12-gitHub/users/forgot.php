<?php
include_once('mysql.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/config.php');


if(isset($_POST['email'])){
	$user = array();

	$stmt = mysqli_prepare($link, "SELECT  `email` FROM `user` WHERE `email`=?");
    mysqli_stmt_bind_param($stmt, 's', $_POST['email']);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $email);
    while (mysqli_stmt_fetch($stmt)) {
        $user['email'] = $email;
    }

    if(empty($user)){
    	echo json_encode('user with this email doesn\' exist');
    }else{
    	$expired = time() + (24 * 60 * 60);
    	$hash = hash('md5', $_POST["email"]);
		$stmt = mysqli_prepare($link, "INSERT INTO `forgot_password`(`email`, `hash`, `expired`) VALUES(?,'".$hash."', ".$expired.")") or die(mysqli_error($link));
		mysqli_stmt_bind_param($stmt, 's', $_POST['email']);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);

		mysqli_close($link);

		$to = $_POST['email'];
		$subject = 'Passoword change';
		$message = 'Please click this link to change your password: '.$users_dir.'recover.php?email='.$_POST['email'].'&hash='.$hash.' ';
		$headers = "From: woof_warrior@woof_warrior.com\r\n";
		mail($to, $subject, $message, $headers);

		echo json_encode('email has been sent to '.$_POST['email']);
    }
}

