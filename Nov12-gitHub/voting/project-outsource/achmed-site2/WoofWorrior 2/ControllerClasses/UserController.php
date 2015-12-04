<?php
/**
 * Created by PhpStorm.
 * User: Haziq
 * Date: 10/22/2015
 * Time: 10:46 AM
 */

require_once($_SERVER['DOCUMENT_ROOT'].'/WoofWorrior/EntityClasses/User.php');

class UserController {

    /**
     * Login user or create a new user
     * @param $username
     * @return array
     */
    public function loginUser($username)
    {
        $Object = new User();
        $result = $Object->login($username);
        return $result;
    }

}