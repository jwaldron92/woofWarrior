<?php
/**
 * Created by PhpStorm.
 * User: Haziq
 * Date: 11/2/2015
 * Time: 12:29 PM
 */

//error_reporting(0);
require_once($_SERVER['DOCUMENT_ROOT'].'/WoofWorrior/ControllerClasses/ImageController.php');

           session_start();

           if(! empty($_SESSION['id']) )
           {
               $Object = new ImageController();
               $data = $Object->getUserVotes($_SESSION['id']);
               echo json_encode($data);
           }
           else
           {
               $array = array();
               array_push($array, [ "Status"=>"error", "Message" => "Session is not recorded"  ]);
               echo json_encode($array);
           }