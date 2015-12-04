<?php

if(isset($_POST['id']) && isset($_POST['name'])){
	session_start();
	$_SESSION['id'] = $_POST['id'];
	$_SESSION['name'] = $_POST['name'];

	include('mysql.php');
	$result = mysqli_query($link, "SELECT * FROM `user` WHERE `userFBID`=".$_SESSION['id']." AND `userFBNAME`='".$_SESSION['name']."';") or die(mysqli_error($link));
	$row = mysqli_num_rows($result);
	if($row == '0'){
		mysqli_query($link, "INSERT INTO `user`(`userFBID`, `userFBNAME`) VALUES(".$_SESSION['id'].", '".$_SESSION['name']."');") or die(mysqli_error($link));
	}
	mysqli_close($link);
}

?>