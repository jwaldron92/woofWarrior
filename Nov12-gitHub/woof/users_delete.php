<?php
include_once('mysql.php');

if(isset($_POST['action']) && $_POST['action'] == 'deletePost'){
	$stmt = mysqli_prepare($link, "SELECT `post_image` FROM `forum_posts` WHERE `post_id`=?;");
    mysqli_stmt_bind_param($stmt, 'i', $_POST['id']);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $post_image);
    while (mysqli_stmt_fetch($stmt)) {
        $user['post_image'] = $post_image;
    }
    if($user['post_image'] != 'no_img.png'){
    	unlink('post_image/'.$user['post_image']);
    }

	$stmt = mysqli_prepare($link, "DELETE FROM `forum_posts` WHERE `post_id`=?;");
	mysqli_stmt_bind_param($stmt, 'i', $_POST['id']);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);

	$stmt = mysqli_prepare($link, "DELETE FROM `comments` WHERE `post_id`=?;");
	mysqli_stmt_bind_param($stmt, 'i', $_POST['id']);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);

	mysqli_close($link);
}


?>