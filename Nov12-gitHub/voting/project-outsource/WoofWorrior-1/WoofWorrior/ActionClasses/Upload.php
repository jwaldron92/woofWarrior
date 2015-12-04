<?php

session_start();
$status = array();
$allowed = array ('image/pjpeg', 'image/jpeg', 'image/JPG', 'image/X-PNG', 'image/PNG', 'image/png', 'image/x-png');
require_once($_SERVER['DOCUMENT_ROOT'].'/WoofWorrior/ControllerClasses/ImageController.php');


if(in_array($_FILES['images']['type'], $allowed))
{
    //calculate size
    $size = $_FILES['images']['size'];
    $size = ($size/1024) / 1024;
    if($size <= 10)
    {
        $tmp = $_FILES['images']['tmp_name'];
        $dir = $_SERVER['DOCUMENT_ROOT'] . '/WoofWorrior/Gallery';
        $dir = $dir . '/' . $_SESSION['name'];
        $dir = $dir . '/' . $_FILES['images']['name'];
        //move the file to the user directory
        if(move_uploaded_file($tmp, $dir))
        {
            chmod ($dir  , 0755 );
            $Object = new ImageController();
            $result = $Object->uploadImage($dir,$_SESSION['id'], 'Testing');
            echo json_encode($result);
        }
        else
        {
            array_push($status, [ "Status"=>"error", "Message"=> "Uploading error occurred during transfer"  ]);
            echo json_encode($status);
        }

    }
    else
    {
        array_push($status, [ "Status"=>"error", "Message"=> "Maximum file size allowed is 10MB"  ]);
        echo json_encode($status);
    }
}
else
{
    array_push($status, [ "Status"=>"error", "Message"=> "Upload file should be image format"  ]);
    echo json_encode($status);
}


if ($_FILES['images']['error'] > 0) {

    // Print a message based upon the error.
    switch ($_FILES['images']['error']) {
        case 1:
            array_push($status, [ "Status"=>"error", "Message"=>" The file is too large to upload "  ]);
            echo json_encode($status);
            break;
        case 2:
            array_push($status, [ "Status"=>"error", "Message"=>" The file is too large to upload "  ]);
            echo json_encode($status);
            break;
        case 3:
            array_push($status, [ "Status"=>"error", "Message"=>" The file was only partially uploaded. "  ]);
            echo json_encode($status);
            break;
        case 4:
            array_push($status, [ "Status"=>"error", "Message"=>"No File was Uploaded "  ]);
            echo json_encode($status);
            break;
        case 6:
            array_push($status, [ "Status"=>"error", "Message"=>"No temporary folder was available "  ]);
            echo json_encode($status);
            break;
        case 7:
            array_push($status, [ "Status"=>"error", "Message"=>"Unable to write the disk "  ]);
            echo json_encode($status);
            break;
        case 8:
            array_push($status, [ "Status"=>"error", "Message"=>"File upload stopped "  ]);
            echo json_encode($status);
            break;
        default:
            array_push($status, [ "Status"=>"error", "Message"=>"System error occurred "  ]);
            echo json_encode($status);
            break;
    } // End of switch.



} // End of error IF.

// Delete the file if it still exists:
if (file_exists ($_FILES['images']['tmp_name']) && is_file($_FILES['images']['tmp_name']) ) {
    unlink ($_FILES['images']['tmp_name']);
}


