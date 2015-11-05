<?php



//connect to server and select database; you may need it
$link = mysqli_connect("localhost", "woofwarr_ksenia", "ksenia", "woofwarr_blog");

//if connection fails, stop script execution
if (mysqli_connect_errno()) {
	printf("Connect failed: %s\n", mysqli_connect_error());
	exit();
}

mysqli_query($link, "CREATE TABLE IF NOT EXISTS `forum_posts` (`post_id` int(50) NOT NULL AUTO_INCREMENT, `topic_id` int(50) NOT NULL,  `post_text` text NOT NULL,  `post_create_time` int(10) NOT NULL, `post_owner` varchar(50) NOT NULL, PRIMARY KEY (`post_id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
mysqli_query($link, "CREATE TABLE IF NOT EXISTS `forum_topics` ( `topic_id` int(100) NOT NULL AUTO_INCREMENT,  `topic_title` varchar(100) NOT NULL,  `topic_create_time` int(10) NOT NULL,`topic_owner` varchar(50) NOT NULL,  `topic_image` varchar(100) NOT NULL, PRIMARY KEY(`topic_id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
mysqli_query($link, "CREATE TABLE IF NOT EXISTS `last_activity` (  `activID` int(50) NOT NULL AUTO_INCREMENT,  `userID` int(50) NOT NULL,  `last_active` int(10) NOT NULL,  `first_active` int(10) NOT NULL, PRIMARY KEY(`activID`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
mysqli_query($link, "CREATE TABLE IF NOT EXISTS `user` (  `userID` int(10) NOT NULL AUTO_INCREMENT,  `userFBID` varchar(50) DEFAULT NULL,  `userFBNAME` varchar(30) DEFAULT NULL,  `email` varchar(50) DEFAULT NULL,  `password` varchar(200) DEFAULT NULL,  `active` int(1) NOT NULL DEFAULT '0', PRIMARY KEY(`userID`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
?>
