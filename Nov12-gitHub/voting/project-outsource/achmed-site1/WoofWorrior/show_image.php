<?php

error_reporting(0);
session_start();
if(empty($_SESSION['id']))
{
    header("Location: index.php");
}
else{

    $user = $_SESSION['id'];
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>HTML5 File API</title>
    <link rel="stylesheet" href="style/image.css" />
    <script src="js/jquery-1.11.3.min.js"></script>
    <script src="js/ViewImages.js"></script>

</head>
<body>

<div id="main" class="main" onload="getImagesDatabase()">

    <!--
    <div id="">

        <img src="Gallery/haziqahmed92gmailcom/Woofwoff (1).png" class="image" />
        <h3 class="text">
            This is the testing
        </h3>

    </div>
   -->
</div>

           <script>
               setTimeout(function () {
                   window.onload = getImagesDatabase();
               },300);
               //window.onload = restrictVotes();
               var user = "<?php  echo $user; ?>";
               setUser(user);

               $(document).ready(function()
               {
                   restrictVotes();
               },400);

           </script>

</body>
</html>
