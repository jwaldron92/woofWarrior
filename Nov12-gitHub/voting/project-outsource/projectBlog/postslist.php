<?php
include 'mysql.php';


//gather the posts
$get_posts_sql = "SELECT * FROM forum_posts ORDER BY post_create_time DESC LIMIT 50";
$get_posts_res = mysqli_query($link, $get_posts_sql) or die(mysqli_error($link));

if (mysqli_num_rows($get_posts_res) < 1) {
	//there are no posts, so say so
	$display_block = "<p><em>No posts exist.</em></p>";
} else {
	//create the display string
    $display_block = <<<END_OF_TEXT

END_OF_TEXT;

	while ($post_info = mysqli_fetch_array($get_posts_res)) {
		$post_id = $post_info['post_id'];
		$post_title = stripslashes($post_info['post_title']);
		$post_create_time = $post_info['post_create_time'];
		$post_owner = stripslashes($post_info['post_owner']);
		$post_image = stripslashes($post_info['post_image']);


		$date = date('j/m', $post_create_time);
		//get number of posts
		$get_num_posts_sql = "SELECT COUNT(post_id) AS post_count FROM forum_posts WHERE post_id = '".$post_id."' ";
		$get_num_posts_res = mysqli_query($link, $get_num_posts_sql) or die(mysqli_error($link));

		while ($posts_info = mysqli_fetch_array($get_num_posts_res)) {
			$num_posts = $posts_info['post_count'];
		}


		//add to display
		$display_block .= <<<END_OF_TEXT


		

END_OF_TEXT;
	}
	//free results
	mysqli_free_result($get_posts_res);
	mysqli_free_result($get_num_posts_res);

	//close connection to MySQL
	mysqli_close($link);


}
?>
<!DOCTYPE html>
<html>
<head>
<title>posts in My Forum</title>
<style type="text/css">
	body{
		height: 1000px;
	}
	.post_block{
		display: inline-block;
		margin: 5px;
	}
	.new_post div{
		//display: inline-block;
	}
	.post_image{
		width: 200px;
		height:200px;
	}
</style>
</head>
<body>
<header>woof warriror</header
<body>
<div>welcome<?php session_start(); if(isset($_SESSION['username'])){print (', '.$_SESSION['username']);} ?></div>
<div class="new_post">
	<div>woof blog</div>
	<div><a href="addpost.html">add a post</a></div>
	<div id=allPosts></div>
</div>

<div><?php echo $display_block; ?></div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script type="text/javascript" src=online.js></script>
<script type="text/javascript" src=js/getPOsts.js></script>
</body>

</html>
