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

		//get number of votes and update
		$result = mysqli_query($link, "SELECT `amount` FROM `votes_amount` WHERE `imageID`=".$image_id['imageID'].";") or die(mysqli_error($link));
		$amount = mysqli_fetch_assoc($result);
		$new_amount = $amount['amount']+1;
		mysqli_query($link, "UPDATE `votes_amount` SET `amount`=".$new_amount." WHERE `imageID`=".$image_id['imageID'].";") or die(mysqli_error($link));
		mysqli_close($link);

		$data = array('new_amount'=>$new_amount, 'imageID'=>$image_id['imageID']);
		echo json_encode($data);

	}else{
		//already upvoted
		echo json_encode('upvoted before');
	}
}else{
	//user not logged, cant vote
	echo json_encode('not logged');
}


?>