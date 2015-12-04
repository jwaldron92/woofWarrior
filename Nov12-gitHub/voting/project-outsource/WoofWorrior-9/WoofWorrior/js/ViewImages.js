/**
 * Created by Haziq on 10/22/2015.
 */

var images;
var user;
var array_id = new Array();


function setUser(userID)
{
    user = userID;
}

function getArray()
{
    return array_id;
}

/**
 *
 */
function getImagesDatabase()
{
    $.ajax(
        {
            type: "POST",
            url : "ActionClasses/GetImages.php",
            dataType:"json",
            success: function(data)
            {
                console.log(data);
                if(data[0]['Status'] == 'ok')
                {
                    images = data;
                    console.log('Success');
                    console.log(data);
                    appendElements(data);
                }
                else
                {
                    showError(data[0]['Message']);
                }
            },
            error:  function(data)
            {
                console.log(data);
            }
        });
}


function getUserVotesList()
{
    $.ajax({

           url: 'ActionClasses/UserVotes.php',
           type: 'POST',
           dataType: 'json',
           success: function(data)
                    {
                        if(data[0]['Status'] == 'ok')
                        {

                            for(var i=1; i< data.length; i++)
                            {
                                writeDB(data[i]['ImageID']);
                            }
                        }
                        else
                        {
                            showError(data[0]['Message']);
                        }
                    },
           error:   function(data)
                    {

                    }
    });
}


function showError(message)
{
    console.log(message);
}

function appendElements(data)
{
    for(var i=1; i<data.length; i++)
    {
        var imageID = data[i]['ID'];
        var vote    = data[i]['Vote'];
        var id      = data[i]['Description'];
        var pth     = data[i]['Alt'];
        var blob    = data[i]['Image'];
        //console.log(blob);
        //console.log(pth);
        var divElement     = "<div id = d"+id + '" class="container">';
        //var imageElement   = "<image id = 'i" + imageID +  "'  src = "+ pth + '" class = "image" />';
        var file = 'data:image/png;base64,'+blob;
        var imageElement   = "<image id = 'i" + imageID +  "' class=image  src="+file+ "   />'";
        var headingElement = '<h3 class="text">' + id + '<h3/> ';

        var voteElement    = '<h3 class="vote" id="v' + imageID + '"> Vote: ' + vote + '<h3/> ' ;
        var anchorElement  = '<button class="button" id="a'+imageID +'"  >' + 'Click to cast vote </button><div/><br/>';
        var elements = divElement + imageElement + headingElement + voteElement + anchorElement;
        $("#main").append(elements);
        array_id[i] = 'a'+imageID;
        console.log(array_id[i]);
        $("#"+array_id[i]).on('click', function (event)
        {
            castVote(this.id.substring(1), user);
            //alert(this.id + 'is clicked');
            event.preventDefault();
        });
    }
    restrictVotes();
}

/**
 * Pass the Image credentials to the php script and increment the vote attribute
 * on success
 * also responsible for assigning a cookie in a browser
 * The cookie will remember each image that the user has been voted in order to eliminate the double vote
 * by the same person
 * Also once the vote has been casted the link to cast the vote would be disabled by the javascript
 *
 */
function castVote(imageID, userID)
{
     if(!isNaN(imageID) || !(isNaN(userID)))
     {
         console.log('Button click on vote at ImageID: ' + imageID);
         //Ajax operation to pass the argument to the script
         $.ajax(
             {
                url: 'ActionClasses/CastVote.php',
                type: 'POST',
                data: 'image= '+imageID,
                dataType: 'JSON',
                beforeSend: function(data)
                           {
                               console.log("code going");
                           },
                success:  function(data)
                           {
                               if(data[0]['Status'] == 'ok')
                               {
                                   //vote cast successfully

                                   console.log('casted vote successfull');
                                  var vote =  $("#v"+ imageID).text();
                                  vote     = parseInt( vote.substring(6) ) + 1;
                                  $("#v"+ imageID).text('');
                                  $("#v"+ imageID).text('Vote: '+vote);
                                  writeDB(imageID);
                               }
                               else
                               {
                                   showError(data[0]['Message']);
                               }
                           },
                error:     function(data)
                           {
                              showError(data);
                           }
             });
     }
     else
     {
        showError('Argument Error: argument provided should consist of real numbers only');
     }
}

/**
 * create a HTML 5 web database api  containing the user vote cast function is to save the current log if the user
 * @param imageID
 */
function writeDB(imageID)
{
   //create the database
   var db = openDatabase("records", '1.0', "record", (2*1024*1024));
   //write the value to the table if the table is not created then create first
   db.transaction(function(tx){

       //query to add the value to the database
       var query = 'CREATE TABLE IF NOT EXISTS Logs ( Image)';
       tx.executeSql(query);
       query = "INSERT INTO Logs (Image) VALUES (" + imageID + ")";
       tx.executeSql(query);
       $("#a"+imageID).hide();
   });
}

/**
 *  read the database and disable the vote feature of those images which has been already been casted by the user
 *  in order to eliminate duplicate votes
 */
function restrictVotes()
{
    var db = openDatabase("records", '1.0', "record", (2*1024*1024));
    //gets the value of the table
    db.transaction(function(tx)
    {
       //creates the table if its now existed
        var query = 'CREATE TABLE IF NOT EXISTS Logs ( Image)';
        tx.executeSql(query);
        tx.executeSql("SELECT * FROM Logs", [], function(tx, result)
        {
           //gets the total effected rows length
           var length = result.rows.length;
            console.log('DB records length: ' + length);
           for(var i=0; i< length; i++)
           {
             // get the ImageID of each effected row
             var id = result.rows.item(i).Image;
             console.log("Voted: "+ id);
             $("#a"+id).hide();
           }
        }, null);

    });
}

/**
 * Clear all the contents of database once the page loads and load the new data from the ajax response
 * basically for multiple user trying to login in same browser window.
 */
function clearDB()
{
    var db = openDatabase("records", '1.0', "record", (2*1024*1024));
    db.transaction(function(tx){
       var query = "CREATE TABLE IF NOT EXISTS Logs (Image)";
       tx.executeSql(query);
       query     =  "DELETE FROM Logs";
       tx.executeSql(query);
    });
}