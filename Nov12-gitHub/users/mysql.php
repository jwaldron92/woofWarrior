<?php


$server ="localhost";
$user = 'woofwarr_ksenia';
$password = 'ksenia';
$db = 'woofwarr_users';

//connect to server and select database; you may need it
$link = mysqli_connect($server, $user, $password, $db);

if (mysqli_connect_errno()) {
	printf("Connect failed: %s\n", mysqli_connect_error());
	exit();
}


mysqli_query($link, "CREATE TABLE IF NOT EXISTS `profile_pic` (  `pic_id` int(50) NOT NULL AUTO_INCREMENT,  `user_id` int(50) NOT NULL,  `pic_name` varchar(50) NOT NULL, PRIMARY KEY(`pic_id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
mysqli_query($link, "CREATE TABLE IF NOT EXISTS `user` (  `userID` int(10) NOT NULL AUTO_INCREMENT, `username` varchar(30) DEFAULT NULL, `userFBID` varchar(50) DEFAULT NULL,  `userFBNAME` varchar(30) DEFAULT NULL,  `email` varchar(50) DEFAULT NULL,  `password` varchar(200) DEFAULT NULL,  `active` int(1) NOT NULL DEFAULT '0', PRIMARY KEY(`userID`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
mysqli_query($link, "CREATE TABLE IF NOT EXISTS `verify_email` (  `verify_id` int(50) NOT NULL AUTO_INCREMENT,  `email` varchar(50) NOT NULL,  `hash` varchar(100) NOT NULL, PRIMARY KEY(`verify_id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
mysqli_query($link, "CREATE TABLE IF NOT EXISTS `forgot_password` (  `forgot_id` int(50) NOT NULL AUTO_INCREMENT,  `email` varchar(100) NOT NULL,  `hash` varchar(100) NOT NULL, `expired` int(10),PRIMARY KEY(`forgot_id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;");


?>
