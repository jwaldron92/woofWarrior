<?php

error_reporting(0);
session_start();
if(empty($_SESSION['id']))
{
    header("Location: Login.php");
}
else{

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

<div id="main" class="main" >

    <!--
    <div id="">

        <img src="Gallery/haziqahmed92gmailcom/Woofwoff (1).png" class="image" />
        <h3 class="text">
            This is the testing
        </h3>

    </div>
   -->

       <?php

             if($data[0]['Status'] == 'ok')
             {
                   for($i=1; $i<count($data); $i++)
                   {

                       $id = $data[$i]['Description'];
                       $path = $data[$i]['Path'];
                       echo '<div id = $id> <img src="' . $path . '" class = image/>  <h3>' . $id . '</h3> </div>';
                   }
             }

       ?>


</div>

           <script>
            //   window.onload = getImagesDatabase();

           </script>

</body>
</html>
