<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Images</title>
	<script type="text/javascript" charset="utf-8" src="js/function.js"></script>
	<script type="text/javascript" charset="utf-8" src="js/vote.js"></script>
</head>
<body>
<p>Click on an image to view it in a separate window.</p>
<ul>
<?php # Script 11.6 - images.php
// This script lists the images in the uploads directory.
// This version now shows each image's file size and uploaded date and time.

// Set the default timezone:
date_default_timezone_set ('America/New_York');

$dir = '../uploads'; // Define the directory to view.

include('mysql.php');


// Display each image caption as a link to the JavaScript function:

//get all votes and images, sort by votes amount
$result = mysqli_query($link, "SELECT * FROM `votes_amount`, `image`, `description` WHERE `votes_amount`.`imageID`=`image`.`imageID` AND `description`.`descID`=`image`.`descID` ORDER BY `votes_amount`.`amount` DESC;") or die(mysqli_error($link));
$images = array();
while($row = mysqli_fetch_assoc($result)){
	$images[] = $row;
}

for($i=0;$i<count($images);$i++){
	//check if file exists in the folder
	if(is_file($dir.'/'.$images[$i]['name'])){

		// Get the image's size in pixels:
		$image_size = getimagesize ($dir."/".$images[$i]['name']);
		
		// Calculate the image's size in kilobytes:
		$file_size = round ( (filesize ($dir."/".$images[$i]['name'])) / 1024) . "kb";
		
		// Determine the image's upload date and time:
		$image_date = date("F d, Y H:i:s", filemtime($dir."/".$images[$i]['name']));
		
		// Make the image's name URL-safe:
		$image_name = urlencode($images[$i]['name']);

		//print the information
		echo "<li><a href=\"javascript:vote('".$images[$i]['name']."')\">&uArr;</a><span id='".$images[$i]['imageID']."'>".$images[$i]['amount']."</span><a href=\"javascript:create_window('$image_name',$image_size[0],$image_size[1])\"><img width=50 heigth=50 src='".$dir."/".$images[$i]['name']."' /></a> ".$images[$i]['desc']."</li>\n";
	}
}
mysqli_close($link);

?>
</ul>
</body>
</html>