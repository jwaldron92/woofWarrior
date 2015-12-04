<?php
include_once('mysql.php');
if(isset($_POST['email']) && isset($_POST['password'])){

	$user = array();

	$stmt = mysqli_prepare($link, "SELECT `email`, `password` FROM `user` WHERE `email`=?;");
    mysqli_stmt_bind_param($stmt, 's', $_POST['email']);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $email, $password);
    while (mysqli_stmt_fetch($stmt)) {
        $user['email'] = $email;
        $user['password'] = $password;
    }

	if(empty($user)){
		$stmt = mysqli_prepare($link, "INSERT INTO `user` (`email`, `password`, `active`) VALUES(?,?,'0');") or die(mysqli_error($link));
		email();
	}elseif($user['password'] == NULL){
		$stmt = mysqli_prepare($link, "UPDATE `user` SET (`email`=?, `password`=?, `active`='0');") or die(mysqli_error($link));
		email();
	}else{
		echo json_encode('user with this email aleady exists');
	}

}
function email(){
	global $link, $stmt;


    if (defined("CRYPT_BLOWFISH") && CRYPT_BLOWFISH) {
        $salt = '$2y$11$' . substr(md5(uniqid(rand(), true)), 0, 22);
        $password =  crypt($_POST['password'], $salt);
    }

	mysqli_stmt_bind_param($stmt, 'ss', $_POST['email'], $password);
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
	$message = 'Please click this link to activate your account: http://woofwarrior.com//gallery/verify.php?email='.$_POST['email'].'&hash='.$hash.' ';
	$headers = "From: activation@woofwarrior.com\r\n";
	mail($to, $subject, $message, $headers);

	//echo json_encode('signed up, verify email. Please click this link to activate your account: http://woofwarrior.com//gallery/htdocs/verify.php?email='.$_POST['email'].'&hash='.$hash);
	echo json_encode('verify email');
}

?>