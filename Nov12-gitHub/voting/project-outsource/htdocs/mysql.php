<?php

$servername = "localhost";
$username = "root";
$password = "";
$db = 'gallery';

$link = mysqli_connect($servername, $username, $password, $db) or die(mysqli_error($link));


mysqli_query($link, "CREATE TABLE IF NOT EXISTS `description` (`descID` int(10) NOT NULL, `desc` text NOT NULL) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;");
mysqli_query($link, "INSERT INTO `description` (`descID`, `desc`) VALUES(1, 'description 1'),(2, 'description 2'),(3, 'description 3'),(4, 'description 4');");

mysqli_query($link, "CREATE TABLE IF NOT EXISTS `image` ( `imageID` int(10) NOT NULL, `description` int(10) NOT NULL, `name` varchar(10) NOT NULL) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;");
mysqli_query($link, "INSERT INTO `image` (`imageID`, `description`, `name`) VALUES(1, 1, '1.jpg'),(2, 2, '1.jpg'),(3, 1, '3.jpg'),(4, 3, '4.jpg'),(5, 1, '5.jpg'),(6, 2, '6.jpg');");

mysqli_query($link, "CREATE TABLE IF NOT EXISTS `user` ( `userID` int(10) NOT NULL, `userFBID` varchar(50) NOT NULL, `userFBNAME` varchar(30) NOT NULL) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;");
mysqli_query($link, "INSERT INTO `user` (`userID`, `userFBID`, `userFBNAME`) VALUES(1, '129858460704160', 'Ksenia Morris');");

mysqli_query($link, "CREATE TABLE IF NOT EXISTS `votes` ( `voteID` int(50) NOT NULL, `userID` int(10) NOT NULL, `imageID` int(10) NOT NULL) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;");
mysqli_query($link, "INSERT INTO `votes` (`voteID`, `userID`, `imageID`) VALUES(1, 1, 1),(2, 1, 5);");
?>