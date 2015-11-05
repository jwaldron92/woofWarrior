<?php
session_start();
include('mysql.php');

//check if user logged in and not anonymous voting
if(isset($_SESSION['id']) && !isset($_POST['action']) && !isset($_POST['votePic'])){
	$result = mysqli_query($link, "SELECT `userID` FROM `user` WHERE `userID`=".$_SESSION['id'].";") or die(mysqli_error($link));
	$user_id = mysqli_fetch_assoc($result);

	//get image id
	$result = mysqli_query($link, "SELECT `imageID` FROM `image` WHERE `name`='".$_POST['name']."';") or die(mysqli_error($link));
	$image_id = mysqli_fetch_assoc($result);

	//check if user already voted for certain image
	$result = mysqli_query($link, "SELECT * FROM `votes` WHERE `userID`=".$user_id['userID']." AND `imageID`=".$image_id['imageID'].";") or die(mysqli_error($link));
	$row = mysqli_num_rows($result);
	if($row == '0'){
		mysqli_query($link, "INSERT INTO `votes`(`userID`, `imageID`) VALUES (".$user_id['userID'].", ".$image_id['imageID'].");") or die(mysqli_error($link));

		$data = update_vote($image_id['imageID']);
		echo json_encode($data);

	}else{
		//already upvoted
		echo json_encode('upvoted before');
	}
}elseif(isset($_POST['votePic']) && !empty($_POST['votePic'])){
	//anonymous vote from main page
	
	$data = update_vote($_POST['votePic']);
	echo json_encode($data);
	
}else{
	//user not logged, cant vote
	echo json_encode('not logged');
}

function update_vote($image_id){
	//get number of votes and update
	global $link;
	$data = array();
	$stmt = mysqli_prepare($link, "SELECT `amount` FROM `votes_amount` WHERE `imageID`=?;");
    mysqli_stmt_bind_param($stmt, 'i', $image_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $num);
    while (mysqli_stmt_fetch($stmt)) {
        $amount['amount'] = $num;
    }
    mysqli_stmt_close($stmt);

    $new_amount = $amount['amount']+1;

	$stmt = mysqli_prepare($link, "UPDATE `votes_amount` SET `amount`=".$new_amount." WHERE `imageID`=?;") or die(mysqli_error($link));
	mysqli_stmt_bind_param($stmt, 'i', $image_id);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);

	//return ajax data
	if(isset($_SESSION['id']) && !isset($_POST['action']) && !isset($_POST['votePic'])){
		$data = array('new_amount'=>$new_amount, 'imageID'=>$image_id);
	}elseif(isset($_POST['action']) && $_POST['action'] == 'anonymous_voting'){
		//get another two images
		$result = mysqli_query($link, "SELECT * FROM `image` ORDER BY RAND() LIMIT 2;") or die(mysqli_error($link));
		//$data = array();
		while($row = mysqli_fetch_assoc($result)){
			$data[]=$row;
		}
	}

	mysqli_close($link);
	
	return $data;
}

?>