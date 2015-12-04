<?php
include_once('mysql.php');

if (!isset($_GET['post_id']) || empty($_GET['post_id'])) {
	header("Location: postslist.php");
	exit;
}

$stmt = mysqli_prepare($link, "SELECT `post_id` FROM `forum_posts` WHERE `post_id`=?;") or die(mysqli_error($link));
mysqli_stmt_bind_param($stmt, 'i', $_GET['post_id']);
mysqli_stmt_execute($stmt);
mysqli_stmt_store_result($stmt);
$rows = mysqli_stmt_num_rows($stmt);
mysqli_stmt_close($stmt);

if($rows == '0'){
	echo "<p><em>You have selected an invalid post.<br/> Please <a href=\"postslist.php\">try again</a>.</em></p>";
	exit;
}else{
	$res = mysqli_query($link, "SELECT * FROM `forum_posts` WHERE `post_id`=".$_GET['post_id'].";") or die(mysqli_error($link));
	$post = mysqli_fetch_assoc($res);
	
}


?>

<!DOCTYPE html>
<html>
<head>
	<title>Post</title>
</head>
<body>
	<div class=postBlock>	
		 	<div><h2><?php echo $post['post_title']; ?></h2></div>
            <div><img src="<?php echo 'post_image/'.$post['post_image']; ?>" alt="post image" width=200 heigth=200 /></div>
		 	<div><?php $date = date('j/m', $post['post_create_time']); echo $date; ?></div>
		 	<div><?php echo nl2br($post['post_text']); ?></div>
	</div>

    <div id=commentinput>
        <textarea required=required id=comment></textarea><br/>
        <input type=button id=postComment value="Post comment">
    </div>
    <div id=commentsBock></div>

<script type="text/javascript"> var postID=<?php echo $_GET['post_id'];?></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<script type="text/javascript" src=js/comment.js></script>
</body>
</html>