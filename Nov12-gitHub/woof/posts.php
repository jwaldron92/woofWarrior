<?php
include_once('mysql.php');

if(isset($_POST['lastPost']) && $_POST['from'] == 'admin'){
	$res_admin = mysqli_query($link, "SELECT * FROM `forum_posts` WHERE `post_id`<".$_POST['lastPost']." AND `post_owner`='Woof Warrior' ORDER BY `post_create_time` DESC LIMIT 50;") or die(mysqli_error($link));
	$admin = get_post($res_admin);
	$posts = array('admin'=>$admin);
	echo json_encode($posts);

}elseif(isset($_POST['lastPost']) && $_POST['from'] == 'user'){
	$res_other = mysqli_query($link, "SELECT * FROM `forum_posts` WHERE `post_id`<".$_POST['lastPost']." AND `post_owner`<>'Woof Warrior' ORDER BY `post_create_time` DESC LIMIT 50;") or die(mysqli_error($link));
	$other = get_post($res_other);
	$posts = array('other'=>$other);
	echo json_encode($posts);
}elseif(isset($_POST['action']) && $_POST['action'] == 'getFirst') {
	$res_admin = mysqli_query($link, "SELECT * FROM `forum_posts` WHERE `post_owner`='Woof Warrior' ORDER BY `post_create_time` DESC LIMIT 50;") or die(mysqli_error($link));
	$res_other = mysqli_query($link, "SELECT * FROM `forum_posts` WHERE `post_owner`<>'Woof Warrior' ORDER BY `post_create_time` DESC LIMIT 50 ;") or die(mysqli_error($link));
	$admin = get_post($res_admin);
$other = get_post($res_other);
	

$posts = array('admin'=>$admin, 'other'=>$other);
echo json_encode($posts);
}

function get_post($res){
	$array = array();
	while($row = mysqli_fetch_assoc($res)){
		$array[] = $row;
	}

	if(!empty($array)){
		for($i=0;$i<count($array);$i++){
			$array[$i]['post_create_time'] = date('j/m',$array[$i]['post_create_time'].'');
		}
	}
	return $array;
}


?>