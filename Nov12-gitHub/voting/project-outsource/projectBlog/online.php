<?php
include_once'mysql.php';

session_start();
if(isset($_SESSION['userID'])){
	$result = mysqli_query($link, "SELECT `userID` FROM `last_activity` WHERE `userID` = ".$_SESSION['userID']." ;") or die(mysqli_error($link));
	$row = mysqli_num_rows($result);
    mysqli_free_result($result);
    if($row > '0'){
    	mysqli_query($link, "UPDATE `last_activity` SET `last_active` = ".time()." WHERE `userID` = ".$_SESSION['userID']." ;") or die(mysqli_error($link));
    }else{
    	mysqli_query($link, "INSERT INTO `last_activity`(`userID`, `last_active`, `first_active`) VALUES (".$_SESSION['userID'].", ".time().", ".time().");") or die(mysqli_error($link));
    }
    $mins = time() - (60*10);
    /*mysqli_query($link, "UPDATE `last_activity` SET `active`=0 WHERE `last_active` < (".$mins.")") or die(mysqli_error($link));*/
    /*$result = mysqli_query($link,"SELECT `userID`, UNIX_TIMESTAMP(`first_active`) AS `first_active` FROM `last_activity` ORDER BY `first_active` ASC") or die(mysqli_error($link));
    $online_users = array();
    while($row = mysqli_fetch_assoc($result)){
        $online_users[]=$row;
    }
    mysqli_free_result($result);*/

    echo json_encode('logged');
}else{
    echo json_encode('not logged');
}


?>

