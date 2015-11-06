<?php
include_once('mysql.php');
if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash'])){
	$stmt = mysqli_prepare($link, "SELECT * FROM `user`, `verify_email` WHERE `verify_email`.`email`=? AND `verify_email`.`hash`=? AND `user`.`active`='0'") or die(mysqli_error($link)); 
	mysqli_stmt_bind_param($stmt, "ss", $_GET['email'], $_GET['hash']);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_store_result($stmt);
	$match  = mysqli_stmt_num_rows($stmt);
	mysqli_stmt_close($stmt);
	if($match > 0){
    	$stmt = mysqli_prepare($link, "UPDATE `user` SET `active`='1' WHERE `email`=? AND `active`='0'") or die(mysqli_error($link));
    	mysqli_stmt_bind_param($stmt, "s", $_GET['email']);
		mysqli_stmt_execute($stmt);
		Mysqli_stmt_close($stmt);

		$stmt = mysqli_prepare($link, "DELETE FROM `verify_email` WHERE `email`=? AND `hash`=?;") or die(mysqli_error($link));
    	mysqli_stmt_bind_param($stmt, "ss", $_GET['email'], $_GET['hash']);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
		echo '<div class="statusmsg">Your account has been activated, you can now login</div>';
	}else{
    	echo '<div class="statusmsg">The url is either invalid or you already have activated your account.</div>';
	}
}

?>