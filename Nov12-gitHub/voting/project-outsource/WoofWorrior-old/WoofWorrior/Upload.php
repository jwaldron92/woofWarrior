<?php

session_start();
if(empty($_SESSION['id']))
{
    header("Location: Login.php");
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>HTML5 File API</title>
    <link rel="stylesheet" href="style/upload.css" />

</head>
<body>
<div id="main" class="main">
    <h1>Upload Your Images</h1>
    <form  id="form" method="post" enctype="multipart/form-data"  action="ActionClasses/Upload.php">
        <input type="file" name="images" id="images" />
        <!--
        <button type="submit" id="btn">Upload Files!</button>
        -->
    </form>
    <h3 id="error" class="message"></h3>
    <img id="image-list" class="image" />

</div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
<script src="js/Upload.js"></script>
</body>
</html>
