<?php
include_once('mysql.php');

if(isset($_POST['lastPost'])){
	$res = mysqli_query($link, "SELECT * FROM `forum_posts` WHERE `post_id`<".$_POST['lastPost']." ORDER BY `post_create_time` DESC LIMIT 50;") or die(mysqli_error($link));
}elseif(isset($_POST['action']) && $_POST['action'] == 'getFirst') {
	$res = mysqli_query($link, "SELECT * FROM `forum_posts` ORDER BY `post_create_time` DESC LIMIT 50;") or die(mysqli_error($link));
}

	$posts = array();
	while($row = mysqli_fetch_assoc($res)){
		$posts[] = $row;
	}
	if(!empty($posts)){
		for($i=0;$i<count($posts);$i++){
			$posts[$i]['post_create_time'] = date('j/m',$posts[$i]['post_create_time'].'');
		}
	}
	echo json_encode($posts);


?>