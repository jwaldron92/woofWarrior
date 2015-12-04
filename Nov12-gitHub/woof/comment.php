<?php
include_once('mysql.php');
session_start();


if(isset($_POST['newComment'])){
	$stmt = mysqli_prepare($link, "INSERT INTO `comments` (`post_id`, `user_id`, `comment`, `comment_date`) VALUES(?, ".$_SESSION['userID'].", ?, ".time().");") or die(mysqli_error($link));
	mysqli_stmt_bind_param($stmt, 'is', $_POST['postID'], $_POST['newComment']);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	mysqli_close($link);

	$data = array('user'=>$_SESSION['username'], 'date'=>date('h:i j/m',time()));
	echo json_encode($data);
}

if(isset($_POST['action']) && $_POST['action'] == 'getFirstComments'){
	$stmt = mysqli_prepare($link, "SELECT `comment`, `comment_date`, `user_id` FROM `comments` WHERE `post_id`=? ORDER BY `comment_date` DESC ;");
    mysqli_stmt_bind_param($stmt, 'i', $_POST['postID']);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $comment, $comment_date, $user_id);

    $comments = array();
    while (mysqli_stmt_fetch($stmt)) {
        $comments['comment'][] = $comment;
        $comments['date'][] = date('h:i j/m',$comment_date);
        $comments['user'][] = $user_id;
    }

    mysqli_select_db($link, $usersdb);
    $users = array();
    for($i=0;$i<count($comments['user']);$i++){
        $res = mysqli_query($link, "SELECT `username`, `userFBNAME` FROM `user` WHERE `userID`=".$comments['user'][$i].";") or die(mysqli_error($link));
        $users[] = mysqli_fetch_assoc($res);
    }
    for($i=0;$i<count($comments['user']);$i++){
        if($users[$i]['username'] == NULL){
            $comments['user'][$i] = $users[$i]['userFBNAME'];
        }else{
            $comments['user'][$i] = $users[$i]['username'];
        }
    }

    echo json_encode($comments);
}

?>