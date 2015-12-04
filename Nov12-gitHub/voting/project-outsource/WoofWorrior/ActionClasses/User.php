<?php
/**
 * Created by PhpStorm.
 * User: Haziq
 * Date: 10/22/2015
 * Time: 10:22 AM
 */

require_once($_SERVER['DOCUMENT_ROOT']. '/WoofWorrior/ControllerClasses/UserController.php');

if(isset($_POST['Username']))
{

    $name = $_POST['Username'];
    $string = str_replace(' ', '-', $name); // Replaces all spaces with hyphens.
    $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
    $string =  preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
    $Object = new UserController();
    $result = $Object->loginUser($string);
    echo json_encode($result);
}

