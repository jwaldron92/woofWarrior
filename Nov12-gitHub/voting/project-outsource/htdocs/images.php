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


$files = scandir($dir); // Read all the images into an array.

// Display each image caption as a link to the JavaScript function:
foreach ($files as $image) {

	if (substr($image, 0, 1) != '.') { // Ignore anything starting with a period.
	
		// Get the image's size in pixels:
		$image_size = getimagesize ("$dir/$image");
		
		// Calculate the image's size in kilobytes:
		$file_size = round ( (filesize ("$dir/$image")) / 1024) . "kb";
		
		// Determine the image's upload date and time:
		$image_date = date("F d, Y H:i:s", filemtime("$dir/$image"));
		
		// Make the image's name URL-safe:
		$image_name = urlencode($image);

		//image id in db
		$result = mysqli_query($link, "SELECT `imageID`, `description` FROM `image` WHERE `name`='".$image."';") or die(mysqli_error($link));
		$image_info = mysqli_fetch_assoc($result);

		$result = mysqli_query($link, "SELECT `desc` FROM `description` WHERE `descID`=".$image_info['description'].";") or die(mysqli_error($link));
		$description = mysqli_fetch_assoc($result);
		
		$votes = array();
		$result = mysqli_query($link, "SELECT `name`, `voteID` FROM `image`, `votes` WHERE `image`.`imageID`=`votes`.`imageID` AND `votes`.`imageID`=".$image_info['imageID'].";") or die(mysqli_error($link));
		while($row = mysqli_fetch_assoc($result)){
			$votes[] = $row;
		}

		$vote = count($votes);
		
		// Print the information:
		echo "<li><a href=\"javascript:vote('".$image."')\">&uArr;</a><span>".$vote."</span><a href=\"javascript:create_window('$image_name',$image_size[0],$image_size[1])\"><img width=50 heigth=50 src='".$dir."/".$image."' /></a> ".$description['desc']."</li>\n";
	
	} // End of the IF.
    
} // End of the foreach loop.

?>
</ul>
</body>
</html>