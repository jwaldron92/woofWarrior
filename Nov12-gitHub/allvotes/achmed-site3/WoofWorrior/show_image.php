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
    <script src="js/Logout.js" type="text/javascript"></script>

</head>
<body>

<div id= "logout" style="width: 300px; height: 200px; float:right">
<button style="float:right" onclick="logout()"><img src="images/logout.png"></button>
</div> <br> <br/>

<div id="main" class="main" onload="getImagesDatabase()">


</div>

           <script>
               setTimeout(function () {
                   window.onload = getImagesDatabase();
                   window.onload = getUserVotesList();
                   window.onload = clearDB();
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
