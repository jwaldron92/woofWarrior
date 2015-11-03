<?php
include 'ch21_include.php';
doDB();

//check for required fields from the form
if ((!$_POST['topic_owner']) || (!$_POST['topic_title']) || (!$_POST['post_text'])) {
	header("Location: addtopic.html");
	exit;
}


$target_dir = "topic_image/";
$target_file = $target_dir . basename($_FILES["topic_image"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
$check = getimagesize($_FILES["topic_image"]["tmp_name"]);
if($check !== false) {
    //echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
} else {
    echo "File is not an image.";
    $uploadOk = 0;
}

if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}

if ($_FILES["topic_image"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}

if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
} else {
    if (move_uploaded_file($_FILES["topic_image"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["topic_image"]["name"]). " has been uploaded.";
		//create safe values for input into the database
		$clean_topic_owner = mysqli_real_escape_string($mysqli, $_POST['topic_owner']);
		$clean_topic_title = mysqli_real_escape_string($mysqli, $_POST['topic_title']);
		$clean_post_text = mysqli_real_escape_string($mysqli, $_POST['post_text']);
		$clean_image_name = mysqli_real_escape_string($mysqli, $_FILES["topic_image"]["name"]);
		//create and issue the first query
		$add_topic_sql = "INSERT INTO forum_topics (topic_title, topic_create_time, topic_owner, topic_image) VALUES ('".$clean_topic_title ."', '".time()."', '".$clean_topic_owner."', '".$clean_image_name."')";

		$add_topic_res = mysqli_query($mysqli, $add_topic_sql) or die(mysqli_error($mysqli));

		//get the id of the last query
		$topic_id = mysqli_insert_id($mysqli);

		//create and issue the second query
		$add_post_sql = "INSERT INTO forum_posts (topic_id, post_text, post_create_time, post_owner) VALUES ('".$topic_id."', '".$clean_post_text."',  now(), '".$clean_topic_owner."')";

		$add_post_res = mysqli_query($mysqli, $add_post_sql) or die(mysqli_error($mysqli));

    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

//close connection to MySQL
mysqli_close($mysqli);

//create nice message for user
$display_block = "<p>The <strong>".$_POST["topic_title"]."</strong> topic has been created.</p>";
?>
<!DOCTYPE html>
<html>
<head>
<title>New Topic Added</title>
</head>
<body>
<h1>New Topic Added</h1>
<?php echo $display_block; ?>
</body>
</html>
