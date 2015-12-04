<?php
/**
 * Created by PhpStorm.
 * User: Haziq
 * Date: 10/29/2015
 * Time: 9:38 AM
 */

session_start();
$array = array();

if(!empty($_SESSION['id']))
{
    unset($_SESSION['id']);
    unset($_SESSION['name']);
    array_push($array, [ "Status" => "ok" ]);
    echo json_encode($array);
}
else
{
    array_push($array, [ "Status" => "error", "Message"=>"Some error occurred " ]);
    echo json_encode($array);
}