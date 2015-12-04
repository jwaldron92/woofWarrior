<?php
session_start();
include('mysql.php');


//check if user logged in
if(isset($_SESSION['id']) && isset($_SESSION['name'])){
	$result = mysqli_query($link, "SELECT `userID` FROM `user` WHERE `userFBID`=".$_SESSION['id']." AND `userFBNAME`='".$_SESSION['name']."';") or die(mysqli_error($link));
	$user_id = mysqli_fetch_assoc($result);

	//get image id
	$result = mysqli_query($link, "SELECT `imageID` FROM `image` WHERE `name`='".$_POST['name']."';") or die(mysqli_error($link));
	$image_id = mysqli_fetch_assoc($result);

	//check if user already voted for certain image
	$result = mysqli_query($link, "SELECT * FROM `votes` WHERE `userID`=".$user_id['userID']." AND `imageID`=".$image_id['imageID'].";") or die(mysqli_error($link));
	$row = mysqli_num_rows($result);
	if($row == '0'){
		mysqli_query($link, "INSERT INTO `votes`(`userID`, `imageID`) VALUES (".$user_id['userID'].", ".$image_id['imageID'].");") or die(mysqli_error($link));
	}else{
		//already upvoted
		echo 'upvoted before';
	}
}else{
	//user not logged, cant vote
	echo 'not logged';
}


?>