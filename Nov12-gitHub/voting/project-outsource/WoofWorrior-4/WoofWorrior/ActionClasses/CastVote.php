<?php
/**
 * Created by PhpStorm.
 * User: Haziq
 * Date: 10/27/2015
 * Time: 1:48 PM
 */

require_once($_SERVER['DOCUMENT_ROOT'] . '/WoofWorrior/ControllerClasses/ImageController.php');

session_start();

$status  = array();

if(isset($_POST['image']) && !empty($_SESSION['id']) )
{
    $imageID = $_POST['image'];
    //echo 'ID: ' . $imageID . '<br/>';
    //calling the reference class
    $Object = new ImageController();
    $result = $Object->castVote($imageID, $_SESSION['id']);
    echo json_encode($result) ;
}
else{

      array_push($status, ["Status"=>"error", "Message"=>"Input was empty or not in correct format"]);
      echo json_encode($status);
}