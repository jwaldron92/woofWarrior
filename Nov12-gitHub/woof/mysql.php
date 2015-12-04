<?php


$server ="localhost";
$user = 'woofwarr_ksenia';
$password = 'ksenia';
$blogdb = 'woofwarr_blog';
$usersdb = 'woofwarr_users';

//connect to server and select database; you may need it
$link = mysqli_connect($server, $user, $password);

if (mysqli_connect_errno()) {
	printf("Connect failed: %s\n", mysqli_connect_error());
	exit();
}

mysqli_select_db($link, $blogdb);

mysqli_query($link, "CREATE TABLE IF NOT EXISTS `forum_posts` (`post_id` int(50) NOT NULL AUTO_INCREMENT, `post_text` text NOT NULL,`post_create_time` int(10) NOT NULL,`post_owner` varchar(50) NOT NULL,`post_title` varchar(50) NOT NULL,`post_image` varchar(50) NOT NULL, PRIMARY KEY (`post_id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
mysqli_query($link, "CREATE TABLE IF NOT EXISTS `comments` ( `comment_id` int(100) NOT NULL AUTO_INCREMENT,  `post_id` int(50) NOT NULL,  `user_id` int(50) NOT NULL,  `comment` text NOT NULL,  `comment_date` int(10) NOT NULL, PRIMARY KEY(`comment_id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;");

?>
