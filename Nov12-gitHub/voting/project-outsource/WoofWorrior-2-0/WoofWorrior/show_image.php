<?php

error_reporting(0);
session_start();
if(empty($_SESSION['id']))
{
    header("Location: index.php");
}
else{

    /*
    require_once($_SERVER['DOCUMENT_ROOT'].'/WoofWorrior/ControllerClasses/ImageController.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/WoofWorrior/ActionClasses/GetImages.php');
    $Object = new ImageController();
    $Data   = $Object->getAllImages();
    $data = array();
    $Object = new ValidatingPermissions();
    $Object->responseToScript($Data);
    $data = $Object->getData();
*/
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

       <?php
            /*
             if($data[0]['Status'] == 'ok')
             {
                   for($i=1; $i<count($data); $i++)
                   {

                       $id = $data[$i]['Description'];
                       $path = $data[$i]['Path'];
                       echo '<div id = $id> <img src="' . $path . '" class = image/>  <h3>' . $id . '</h3> </div>';
                   }
             }
          */
       ?>


</div>

           <script>
              window.onload = getImagesDatabase();
                // window.onload = lsitImages();

           </script>

</body>
</html>
