<?php

$servername = "localhost";
$username = "root";
$password = "";
$db = 'gallery';

$link = mysqli_connect($servername, $username, $password, $db) or die(mysqli_error($link));

mysqli_query($link, "CREATE TABLE IF NOT EXISTS `description` (`descID` int(10) NOT NULL AUTO_INCREMENT, `desc` text NOT NULL, PRIMARY KEY (`descID`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
mysqli_query($link, "INSERT INTO `description` (`descID`, `desc`) VALUES(1, 'description 1'),(2, 'description 2'),(3, 'description 3'),(4, 'description 4');");

mysqli_query($link, "CREATE TABLE IF NOT EXISTS `image` ( `imageID` int(10) NOT NULL AUTO_INCREMENT, `descID` int(10) NOT NULL, `name` varchar(10) NOT NULL, PRIMARY KEY (`imageID`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
mysqli_query($link, "INSERT INTO `image` (`imageID`, `descID`, `name`) VALUES(1, 1, '1.jpg'),(2, 3, '2.jpg'),(3, 4, '3.jpg'),(4, 4, '4.jpg'),(5, 1, '5.jpg');");

mysqli_query($link, "CREATE TABLE IF NOT EXISTS `user` ( `userID` int(10) NOT NULL AUTO_INCREMENT, `userFBID` varchar(50) NOT NULL, `userFBNAME` varchar(30) NOT NULL, PRIMARY KEY (`userID`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
mysqli_query($link, "INSERT INTO `user` (`userID`, `userFBID`, `userFBNAME`) VALUES(1, '129858460704160', 'Ksenia Morris');");

mysqli_query($link, "CREATE TABLE IF NOT EXISTS `votes` ( `voteID` int(50) NOT NULL AUTO_INCREMENT, `userID` int(10) NOT NULL, `imageID` int(10) NOT NULL, PRIMARY KEY (`voteID`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
mysqli_query($link, "INSERT INTO `votes` (`voteID`, `userID`, `imageID`) VALUES(6, 1, 2),(7, 1, 4);");

mysqli_query($link, "CREATE TABLE IF NOT EXISTS `votes_amount` (`amountID` int(10) NOT NULL AUTO_INCREMENT, `amount` int(10) NOT NULL, `imageID` int(10) NOT NULL, PRIMARY KEY (`amountID`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
mysqli_query($link, "INSERT INTO `votes_amount` (`amountID`, `amount`, `imageID`) VALUES(1, 0, 1),(2, 1, 2),(3, 0, 3),(4, 1, 4),(5, 0, 5);");


?>