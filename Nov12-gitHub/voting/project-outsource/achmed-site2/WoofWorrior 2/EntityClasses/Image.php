<?php
/**
 * Created by PhpStorm.
 * User: Haziq
 * Date: 10/20/2015
 * Time: 1:29 PM
 */

//upload, get image description, increment vote
//path to link the connection class
require_once($_SERVER['DOCUMENT_ROOT'].'/WoofWorrior/Connection/Connection.php');


class Image
{

   private $db;
   private $result;
   private $query;
   private $status;
   private $error;
   private $data;
   private $connection;

   public function __construct()
   {
       $this->data = array();
       $this->status = array();
       $this->db = new DBConnection();
       $this->result = $this->db->DBConnect();
       $this->connection = $this->result;
   }

    /**
     * Check the existence of the image in the database if the image is recorded then throw back error to the user otherwise
     * record the image in the database
     * @param $path
     * @param $user
     * @param $description
     * @return int|array
     */
   public function upload($path, $user, $description, $blob)
   {
       // check database connection
       if($this->result)
       {
           //check the image existence
           if($this->imageExists($path, $user))
           {
               $blob =  mysqli_real_escape_string($this->connection, $blob);
              // var_dump($blob);
               $this->query = "INSERT INTO image(UserID, Description, Location, Image) VALUES ($user, '$description', '$path', '$blob')";
               $this->result = $this->db->Select($this->query);
               if($this->result)
               {
                   return array_push($this->status, [ "Status"=>"ok"]);
               }
               else
               {
                   $this->error = $this->result;
                   return array_push($this->status, [ "Status"=>"error", "Message"=>$this->error  ]);
               }
           }
           else
           {
               return array_push($this->status, [ "Status"=>"error", "Message"=>"Image already exists with the same name.. Kindly change name of the file"]);
           }
       }
       // error occurred since there was an error thrown by the database connection
       else
       {
           $this->error = $this->result;
           return array_push($this->status, [ "Status"=>"error", "Message"=>$this->error  ]);
       }
   }


    /**
     * The role of this function is to check the record of particular image in the database if the record is found then prompt the user to
     * change the name of the image. The function will return false if the image already exists.
     * @author Haziq
     * @param $path
     * @param $user
     * @return bool|array
     */
   private function imageExists($path, $user)
   {
       $this->query = "SELECT * FROM image WHERE UserID = $user and Location LIKE '%$path%'";
       $this->result = $this->db->Select($this->query);
       if($this->result)
       {
           $count = mysqli_num_rows($this->result);
           if($count > 0)
           {

               return false;
           }
           else
           {
               return true;
           }
       }
       else
       {
           $this->error = $this->result;
           return array_push($this->status, [ "Status"=>"error", "Message"=>$this->error  ]);
       }

   }

    /**
     * Get all the records of images along with their path, description and votes count
     * @return array
     */
   public function getImages()
   {
       $temp  =array(); //for safekeeping the ids and description
       // prepare query
       $this->query = "SELECT * FROM image";
       $this->result = $this->db->Select($this->query);
       if($this->result && (mysqli_num_rows($this->result) > 0)) //check query result and number of affected rows
       {
           //now records the image ids in the separate array
           while( ($row = mysqli_fetch_assoc($this->result)) !=false )
           {
               $imageID     = $row['ImageID'];
               $description = $row['Description'];
               $location    = $row['Location'];
               $image       = base64_encode($row['Image']);
               array_push($temp, [ "ID"=>$imageID, "Description"=>$description, "Path"=>$location, 'Image'=>$image  ]);
           }
           if($this->getAllImageVotes($this->getImageIds($temp), $temp))
           {
               return $this->data;
           }
           else
           {
               return $this->status;
           }
       }
       else // error occurred during query processing or no image file is recorded
       {
            array_push($this->status, ["Status"=>"error", "Message"=>"No image recorded"]);
            return $this->status;
       }
   }

    /**
     * Separate each id of the image and store in the single string
     * @param $imageId
     * @return string
     */
   private function getImageIds($imageId)
   {
       $string= "";
       for($i=0; $i< count($imageId); $i++)
       {
           $string .= $imageId[$i]['ID'] . ',';
       }
       // remove the last comma from the string
       $string = substr($string, 0, strlen($string)-1);
       return $string;
   }

    /**
     * Get the votes count from the images id's
     * @param $imageIds
     * @return bool
     */
   private function getAllImageVotes($imageIds, $temp)
   {
      //prepare query
      $this->query = "SELECT * FROM voteimage WHERE ImageID IN ($imageIds)";
      $this->result = $this->db->Select($this->query);
      if($this->result)
      {
        //query successful
        //get votes count against image id
        array_push($this->data, [ "Status" => "ok"    ]);
        $indexer = 0;
        if(mysqli_num_rows($this->result) > 0)
        {
            for($i=0; $i< count($temp); $i++)
            {
                $row         = mysqli_fetch_assoc($this->result);
                $vote        = 0;
                $imageID     = $temp[$indexer]['ID'];
                $description = $temp[$indexer]['Description'];
                $location    = $temp[$indexer]['Path'];
                $image       = $temp[$indexer]['Image'];
                if (array_key_exists("Vote", $row)) {
                   // echo 'Key found' .$indexer . '<br/>';
                    $vote = $row['Vote'];
                }
                array_push($this->data, ["ID" => $imageID, "Description" => $description, "Path" => $location, "Vote" => $vote, "Image"=>$image]);
                //echo print_r($this->data) . '<br/>';
                $indexer += 1;
            }
        }
        else
        {
            for($i=0; $i< count($temp); $i++)
            {
                $imageID     = $temp[$i]['ID'];
                $description = $temp[$i]['Description'];
                $location    = $temp[$i]['Path'];
                $image       = $temp[$i]['Image'];
                $vote        = 0;
                array_push($this->data, ["ID" => $imageID, "Description" => $description, "Path" => $location, "Vote" => $vote, "Image"=>$image]);
            }
        }
      }
      else
      {
        //throw back error
        array_push($this->status, ["Status"=>"error", "Message"=>$this->result]);
        return false;
      }
      return true;
   }


    /**
     * Increment the vote of a particular image
     * @param $imageID
     * @param $userID
     * @return array
     */
   public function voteIncrement($imageID, $userID)
   {
      //First create the row in Votes table..
      //after that search for the image reference in ImageVotes table if the row exists then increment the Vote row..
      //otherwise create a new row in ImageVotes table and set Vote count to 1
      if($this->add_Row_Votes_Table($imageID, $userID))
      {
         //new row has been successfully created now search for the row existence in the ImageVotes table
         if($this->exists_or_create($imageID))
         {
              array_push($this->status, ["Status" => "ok" ]);
              return $this->status;
         }
          else
          {
              return $this->status;
          }
      }
      else
      {
          return $this->status;
      }

   }

    /**
     * add a new row in Votes Table for tracking the user votes in a particular image
     * @param $imageID
     * @param $userID
     * @return bool
     */
   private function add_Row_Votes_Table($imageID, $userID)
   {
       // create row in the Votes Table
       //prepare query
       $this->query = "INSERT INTO vote (UserID, ImageID) VALUES ($userID, $imageID)";
       $this->result = $this->db->Select($this->query);
       if($this->result)
       {
           //query success
           return true;
       }
       //error occurred set error message
       array_push($this->status, ["Status" => "error", "Message" => $this->result]);
       return false;
   }

    /**
     * checks the row existence in the voteImage row
     * basically check whether the vote for the image has been casted or not
     * if the image has been casted any vote then we have to update the current count of vote other wise
     * it is obvious that the vote for that image is not and this is the first vote for that particular image
     * so we have to add a new record for that
     * @param $imageID
     * @return bool
     */
   private function exists_or_create($imageID)
   {
       //prepare query
       $this->query = "SELECT * FROM voteimage WHERE ImageID = $imageID";
       $this->result = $this->db->Select($this->query);
       if($this->result)
       {

           //check for row existence
           if(mysqli_num_rows($this->result) > 0)
           {
               //update the vote.. first of all get the Vote count of it
               $row = mysqli_fetch_assoc($this->result);
               $id  = $row['ID'];     //fetch the primary ID
               $vote = $row['Vote'];  //fetch the vote count
               $vote += 1;            //increment the vote count
               //prepare query
               $this->query = "UPDATE voteimage SET Vote= $vote  WHERE ID = $id";
           }
           else
           {
               //create a new row
               $vote = 1; //set vote to 1 as it is firstly casted
               $this->query = "INSERT INTO voteimage( ImageID, Vote) VALUES ( $imageID , $vote)";
           }
           //process query and result
           $this->result = $this->db->Select($this->query);
           if($this->result)
           {
               return true;
           }
       }
       //error occurred set error message
       array_push($this->status, ["Status" => "error", "Message" => $this->result]);
       return false;
   }

}