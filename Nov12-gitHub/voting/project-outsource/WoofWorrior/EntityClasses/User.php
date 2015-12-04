<?php
/**
 * Created by PhpStorm.
 * User: Haziq
 * Date: 10/20/2015
 * Time: 12:37 PM
 *
 */

//path to link the connection class
require_once($_SERVER['DOCUMENT_ROOT'].'/WoofWorrior/Connection/Connection.php');
session_start();


class User {

    private $DB;          // Connection class object
    private $status;     // records the status in an array if status => ok then operation was successful else there was an error
    private $query;     // records the current query to be supplied to the database
    private $result;   //  records the result of the database query
    private $error;   //   contains error
    private $connection;
    //constructor function...
    //instantiate the connection class object in the constructor and also attach the database to the application
    public function __construct()
    {
        $this->status = array();
        $this->DB = new DBConnection();
        $this->result = $this->DB->DBConnect();
        $this->connection = $this->result;
    }

    /**
     * Function will check the user record in the database if it finds the record then it will send the user information
     * other wise if it fails to find the user then the new profile of user would be created.
     * @param $username
     * @return array
     * @author Haziq
     * Date: 10/21/2015
     * Time: 1:03 AM
     */
    public function userExists($username)
    {
        //check the successful database connection
        if($this->result)
        {
            $this->query = "SELECT * FROM user WHERE UserName = '$username'";
            $this->result = $this->DB->Select($this->query);
            if($this->result) // get the result of the query
            {
                //get the total count of affected rows if count is > 0  then user exist
                $count = mysqli_num_rows($this->result);
                if($count > 0)
                {
                    $path = $_SERVER['DOCUMENT_ROOT']."/WoofWorrior/Gallery/".$username;
                    if(! is_dir($path)){
                        if(mkdir($path))
                        {
                            array_push($this->status, [ "Status"=>"ok"]);
                        }
                        else
                        {
                            array_push($this->status, [ "Status"=>"error", "Message"=>"Unable to create the directory"  ]);
                        }
                    }
                }
                else
                {
                    // user does not exist so we have to create it profile and folder in the separate folder in the app directory
                    $path = $_SERVER['DOCUMENT_ROOT']."/WoofWorrior/Gallery/".$username;
                    if(mkdir($path))
                    {
                        return $this->createUser($username);
                    }
                    else
                    {
                        //Unable to create the directory throw error
                         array_push($this->status, [ "Status"=>"error", "Message"=>"Unable to create the directory"  ]);
                    }
                }
            }
            else            // error occurred since there was an error thrown by the database during processing query
            {
                $this->error = $this->result;
                 array_push($this->status, [ "Status"=>"error", "Message"=>$this->error  ]);
            }

        }
        else
        {
            $this->error = $this->result; //store the error
            array_push($this->status, [ "Status"=>"error", "Message"=>$this->error  ]);
        }

        return $this->status;
    }


    /**
     * The role is to create a user in a database.
     * @param $userName
     * @author Haziq
     * @return array
     */
    private function createUser($userName)
    {
      //create the query for insertion
      $this->query = "INSERT INTO user (UserName) VALUES ('$userName')";
      $this->result = $this->DB->Select($this->query);
      if($this->result) // get the result of the query
      {
         $this->query = "SELECT * FROM user WHERE UserName = '$userName'";
         $this->result = $this->DB->Select($this->query);
         $user = mysqli_fetch_assoc($this->result);
         //print_r($user);
         array_push($this->status, [ "Status"=>"ok", "ID"=>$user['UserID'], "Name"=> $user['UserName'] ]);
         $_SESSION['id'] =  $user['UserID'];
         $_SESSION['name'] = $user['UserName'];
         session_write_close();
      }
      else            // error occurred since there was an error thrown by the database during processing query
      {
        $this->error = $this->result;
        array_push($this->status, [ "Status"=>"error", "Message"=>$this->error  ]);
      }
      return $this->status;
    }

}