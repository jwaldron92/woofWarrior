<?php
include_once('mysql.php');
session_start();


if(!empty($_FILES['file']['name'])){
	$display_block='';
	$target_dir = "profile_pic/";
	$target_file = $target_dir . basename($_FILES["file"]["name"]['0']);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	$check = getimagesize($_FILES["file"]["tmp_name"]['0']);
	if($check !== false) {
	    //echo "File is an image - " . $check["mime"] . ".";
	    $uploadOk = 1;
	}else{
	    $data =  "File is not an image.";
	    $uploadOk = 0;
	}

	if(file_exists($target_file)) {
	    $data ="Sorry, file already exists.";
	    $uploadOk = 0;
	}

	if ($_FILES["file"]["size"]['0'] > 500000) {
	    $data ="Sorry, your file is too large.";
	    $uploadOk = 0;
	}

	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"&& $imageFileType != "gif" ) {
	    $data ="Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
	    $uploadOk = 0;
	}

	if ($uploadOk == 0) {
	    $data ="Sorry, your file was not uploaded.";
	}else{
	    if(move_uploaded_file($_FILES["file"]["tmp_name"]['0'], $target_file)) {
	        $data = "The file has been uploaded.";

	       

	        $res = mysqli_query($link, "SELECT `pic_name` FROM `profile_pic` WHERE `user_id`=".$_SESSION['userID'].";") or die(mysqli_error($link));
			$pic = mysqli_fetch_assoc($res);
			if(!empty($pic)){
				unlink('profile_pic/'.$pic['pic_name']);
				$add_post_sql = "UPDATE `profile_pic` SET `pic_name`='".$_FILES["file"]["name"]['0']."' WHERE `user_id`=".$_SESSION['userID'].";";
			}else{
				$add_post_sql = "INSERT INTO `profile_pic` (`user_id`, `pic_name`) VALUES (".$_SESSION['userID'].", '".$_FILES["file"]["name"]['0']."')";	
			}

			$add_post_res = mysqli_query($link, $add_post_sql) or die(mysqli_error($link));

			$data = array('pic' => $_FILES["file"]["name"]['0']);
	    }else{
		    $data ="Sorry, there was an error uploading your file.";
		}
	}
}
echo json_encode($data);

?>