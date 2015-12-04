<?php
include_once('mysql.php');

if(isset($_POST['email']) && isset($_POST['password'])){
	$stmt = mysqli_stmt_init($link);
	mysqli_stmt_prepare($stmt, "SELECT `email` FROM `user` WHERE `email`=?;") or die(mysqli_error($link));
	mysqli_stmt_bind_param($stmt, 's', $_POST['email']);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);
	mysqli_stmt_close($stmt);
	$email = mysqli_fetch_assoc($result);

	if(empty($email)){
		$stmt = mysqli_prepare($link, "INSERT INTO `user`(`email`, `password`) VALUES(?,?)") or die(mysqli_error($link));
		mysqli_stmt_bind_param($stmt, 'ss', $_POST['email'], password_hash($_POST['password'], PASSWORD_DEFAULT));
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);

		//to verify email
		$hash = hash('md5', $_POST["email"]);
		$stmt = mysqli_prepare($link, "INSERT INTO `verify_email`(`email`, `hash`) VALUES(?,'".$hash."')") or die(mysqli_error($link));
		mysqli_stmt_bind_param($stmt, 's', $_POST['email']);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);

		mysqli_close($link);

		$to = $_POST['email'];
		$subject = 'Email varification';
		$message = 'Please click this link to activate your account: http://localhost/gallery/htdocs/verify.php?email='.$_POST['email'].'&hash='.$hash.' ';
		$headers = "From: woof_warrior@email.com\r\n";
		mail($to, $subject, $message, $headers);

		echo json_encode('signed up, verify email. Please click this link to activate your account: http://localhost/gallery/htdocs/verify.php?email='.$_POST['email'].'&hash='.$hash);
	}else{
		echo json_encode('user with this email aleady exists');
	}
}


?>