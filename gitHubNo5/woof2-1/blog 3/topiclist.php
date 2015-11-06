<?php
include 'ch21_include.php';


//gather the topics
$get_topics_sql = "SELECT topic_id, topic_title, topic_image, topic_create_time, topic_owner FROM forum_topics ORDER BY topic_create_time DESC";
$get_topics_res = mysqli_query($link, $get_topics_sql) or die(mysqli_error($link));

if (mysqli_num_rows($get_topics_res) < 1) {
	//there are no topics, so say so
	$display_block = "<p><em>No topics exist.</em></p>";
} else {
	//create the display string
    $display_block = <<<END_OF_TEXT

END_OF_TEXT;

	while ($topic_info = mysqli_fetch_array($get_topics_res)) {
		$topic_id = $topic_info['topic_id'];
		$topic_title = stripslashes($topic_info['topic_title']);
		$topic_create_time = $topic_info['topic_create_time'];
		$topic_owner = stripslashes($topic_info['topic_owner']);
		$topic_image = stripslashes($topic_info['topic_image']);


		$date = date('j/m', $topic_create_time);
		//get number of posts
		$get_num_posts_sql = "SELECT COUNT(post_id) AS post_count FROM forum_posts WHERE topic_id = '".$topic_id."'";
		$get_num_posts_res = mysqli_query($link, $get_num_posts_sql) or die(mysqli_error($link));

		while ($posts_info = mysqli_fetch_array($get_num_posts_res)) {
			$num_posts = $posts_info['post_count'];
		}


		//add to display
		$display_block .= <<<END_OF_TEXT


		<div class=topic_block>
			<a href="showtopic.php?topic_id=$topic_id">
				<div>$date</div>
				<div><img src='topic_image/$topic_image' class=topic_image /></div>
				<div>$topic_title</div>
			</a>
		</div>

END_OF_TEXT;
	}
	//free results
	mysqli_free_result($get_topics_res);
	mysqli_free_result($get_num_posts_res);

	//close connection to MySQL
	mysqli_close($link);


}
?>
<!DOCTYPE html>
<html>
<head>
<title>Topics in My Forum</title>
<style type="text/css">
	.topic_block{
		display: inline-block;
		margin: 5px;
	}
	.new_topic div{
		display: inline-block;
	}
	.topic_image{
		width: 200px;
		height:200px;
	}
</style>
</head>
<body>
<header>woof warriror</header
<body>
<div>welcome<?php session_start(); if(isset($_SESSION['username'])){print (', '.$_SESSION['username']);} ?></div>
<div class="new_topic">
	<div>woof blog</div>
	<div><a href="addtopic.html">add a topic</a></div>
</div>

<div><?php echo $display_block; ?></div>

</body>

</html>
