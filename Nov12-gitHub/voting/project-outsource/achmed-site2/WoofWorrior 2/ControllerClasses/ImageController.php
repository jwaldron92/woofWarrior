<?php
/**
 * Created by PhpStorm.
 * User: Haziq
 * Date: 10/21/2015
 * Time: 12:27 PM
 */

//path to link the connection class
require_once($_SERVER['DOCUMENT_ROOT'].'/WoofWorrior/EntityClasses/Image.php');


class ImageController {

    /**
     * Save the image in the database also determine whether the user directory is available.
     * in case of missing directory recreate it
     * @param $path
     * @param $user
     * @param $description
     * @return array|int
     */
    public function uploadImage($path, $user, $description, $blob)
    {
        $Object = new Image();
        $result = $Object->upload($path, $user, $description, $blob);
        return $result;
    }

    /**
     * get all the uploaded images along with their description and votes count
     * @return array
     */
    public function getAllImages()
    {
        $Object = new Image();
        $result = $Object->getImages();
        return $result;
    }

    /**
     * cast vote on the particular image
     * @param $userID
     * @param $imageID
     * @return array
     */
    public function castVote($imageID, $userID)
    {
        $Object = new Image();
        $result = $Object->voteIncrement($imageID, $userID);
        return $result;
    }



}