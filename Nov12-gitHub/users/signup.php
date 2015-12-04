<?php

include_once($_SERVER['DOCUMENT_ROOT'].'/config.php');

include_once('mysql.php');


if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])){

	$user = array();

	$stmt = mysqli_prepare($link, "SELECT  `username` FROM `user` WHERE `username`=?");
    mysqli_stmt_bind_param($stmt, 's', $_POST['username']);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $email);
    while (mysqli_stmt_fetch($stmt)) {
        $user['email'] = $email;
    }

	if(empty($user)){
		$stmt = mysqli_prepare($link, "SELECT  `password`, `email` FROM `user` WHERE `email`=?");
	    mysqli_stmt_bind_param($stmt, 's', $_POST['email']);
	    mysqli_stmt_execute($stmt);
	    mysqli_stmt_bind_result($stmt, $email, $password);
	    while (mysqli_stmt_fetch($stmt)) {
	        $user['email'] = $email;
	        $user['password'] = $password;
	    }
	    
	    if (defined("CRYPT_BLOWFISH") && CRYPT_BLOWFISH) {
		        $salt = '$2y$11$' . substr(md5(uniqid(rand(), true)), 0, 22);
		        $password =  crypt($_POST['password'], $salt);
		 }
	    if(empty($user['email'])){
			$stmt = mysqli_prepare($link, "INSERT INTO `user` (`username`,`email`, `password`, `active`) VALUES(?, ?,?,'0');") or die(mysqli_error($link));

			mysqli_stmt_bind_param($stmt, 'sss', $_POST['username'], $_POST['email'], $password);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
			email();
		}elseif($user['password'] == NULL){
			$stmt = mysqli_prepare($link, "UPDATE `user` SET (`email`=?, `password`=?, `active`='0');") or die(mysqli_error($link));
			
			mysqli_stmt_bind_param($stmt, 'ss', $_POST['email'], $password);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
			email();
			
		}else{
			echo json_encode('user with this email aleady exists');
		}
	}else{
		echo json_encode('user with this username aleady exists');
	}

}
function email(){
	global $link, $stmt, $users_dir;


 	//to verify email
	$hash = hash('md5', $_POST["email"]);
	$stmt = mysqli_prepare($link, "INSERT INTO `verify_email`(`email`, `hash`) VALUES(?,'".$hash."')") or die(mysqli_error($link));
	mysqli_stmt_bind_param($stmt, 's', $_POST['email']);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);

	mysqli_close($link);

	$to = $_POST['email'];
	$subject = 'Email verification‏';
	$message = 'Please click this link to activate your account: '.$users_dir.'/verify.php?email='.$_POST['email'].'&hash='.$hash.' ';
	$headers = "From: woof_warrior@woof_warrior.com\r\n";
	mail($to, $subject, $message, $headers);

	//echo json_encode('signed up, verify email. Please click this link to activate your account: http://woofwarrior.com//gallery/htdocs/verify.php?email='.$_POST['email'].'&hash='.$hash);
	echo json_encode('please verify your email');
}

?>