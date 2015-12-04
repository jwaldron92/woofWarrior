<?php
include_once('mysql.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/config.php');

session_start();

if(!isset($_SESSION['username'])){
	header("Location: ".$users_dir."login.html");
	exit;
}
//check for required fields from the form
if ((!$_POST['post_title']) || (!$_POST['post_text'])) {

		header("Location: addpost.html");
	
	exit;
}

if(!empty($_FILES['post_image']['name'])){
	$display_block='';
	$target_dir = "post_image/";
	$target_file = $target_dir . basename($_FILES["post_image"]["name"]);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	$check = getimagesize($_FILES["post_image"]["tmp_name"]);
	if($check !== false) {
	    //echo "File is an image - " . $check["mime"] . ".";
	    $uploadOk = 1;
	}else{
	    echo "File is not an image.";
	    $uploadOk = 0;
	}

	if(file_exists($target_file)) {
	    echo "Sorry, file already exists.";
	    $uploadOk = 0;
	}

	if ($_FILES["post_image"]["size"] > 500000) {
	    echo "Sorry, your file is too large.";
	    $uploadOk = 0;
	}

	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"&& $imageFileType != "gif" ) {
	    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
	    $uploadOk = 0;
	}

	if ($uploadOk == 0) {
	    echo "Sorry, your file was not uploaded.";
	}else{
	    if(move_uploaded_file($_FILES["post_image"]["tmp_name"], $target_file)) {
	        echo "The file ". basename( $_FILES["post_image"]["name"]). " has been uploaded.";
	       	//create safe values for input into the database

			$display_block = add_post($_FILES["post_image"]["name"]);

	    }else{
		    echo "Sorry, there was an error uploading your file.";
		}
	}
}else{
	$display_block = add_post('no_img.png');
}

//close connection to MySQL
mysqli_close($link);

function add_post($file_name){
	global $link;

	if($_SESSION['username']=='Woof Warrior'){
		$owner = 'Woof Warrior';
	}else{
		$owner = $_SESSION['userID'];
	}

	$clean_post_title = mysqli_real_escape_string($link, $_POST['post_title']);
	$clean_post_text = mysqli_real_escape_string($link, $_POST['post_text']);
	$clean_image_name = mysqli_real_escape_string($link, $file_name);
	//create and issue the first query
	$add_post_sql = "INSERT INTO forum_posts (post_text, post_create_time, post_owner, post_title, post_image) VALUES ('".$clean_post_text."', ".time().", '".$owner."', '".$clean_post_title ."', '".$clean_image_name."')";

	$add_post_res = mysqli_query($link, $add_post_sql) or die(mysqli_error($link));

	$display_block = "<h1>New Topic Added</h1><p>The <strong>".$_POST["post_title"]."</strong> post has been created.</p>";
	return $display_block;
}


?>
<!DOCTYPE html>
	<html>
	<head>
	<title>New post Added</title>
	</head>
	<body>
	<?php echo $display_block; ?>


	</body>
	</html>