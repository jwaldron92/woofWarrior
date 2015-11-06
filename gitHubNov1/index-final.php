<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <title>Woof Warrior, the pet technology</title>
    <link rel="shortcut icon" type="image/png" href="/favicon.png"/>
    <meta name="theme-color" content="#ffffff">
    <link rel="stylesheet" type="text/css" href="slick.css"/>
    <link rel="stylesheet" type="text/css" href="slick-theme.css"/>
    <style>
    h3{
         padding:20px;
    }
    html{
        height: 100%;
    }

    div{
        display: block;
    }

    body{
        margin: 0px;
    }

    section{
        position: relative;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
        color: #8A9299;
        margin: 0 auto;
        background:black;
    }


    html, body, div, span, applet, object, iframe, h1, h2, h3, h4, h5, h6, p, blockquote, pre, a, abbr, acronym, address, big, cite, code, del, dfn, em, img, ins, kbd, q, s, samp, small, strike, strong, sub, sup, tt, var, b, u, i, center, dl, dt, dd, ol, ul, li, fieldset, form, label, legend, table, caption, tbody, tfoot, thead, tr, th, td, article, aside, canvas, details, embed, figure, figcaption, footer, header, hgroup, menu, nav, output, ruby, section, summary, time, mark, audio, video {
        margin: 0;
        padding: 0;
        border: 0;
        font: inherit;
        font-size: 100%;
        vertical-align: baseline;
    }

    .header-bar {
        height: 80px;
        border-bottom: none;
        margin-top:0px;
    }


    .header-bar .container {
        position: relative;
        background-image:url("dog-paw.jpeg");
        background-repeat: repeat-x;
        background-size: 20px 30px;
        box-shadow: inset 0px 0px 0px 0px #0FE1FC,0px -40px 48px 27px #0FE1FC;
        height: 100%;
    }

    .logo.woof-logo {
        top: 24px;
        display: block;
        position: absolute;
        left: 30px;
        top: 30px;
        z-index: 400;
        overflow: hidden;
    }

    .content.main-wrapper {
        width: 100%;
        margin: 50px auto;
        position:relative;

    }

    .content {
        position: relative;
        background-color: #ffffff;
        max-width: 1280px;
        margin-top:0px;
    }

    div.prototype-photo{
        position: relative;
        background-image: url("image2.JPG");
        background-size: 334px 252px;
        width: 334px;
        height: 252px;
        background-position: center;
        margin-left: 33%;
        margin-top: 15%;
    }

    div.tshirt{
        position: relative;
        background-image: url("order-now.jpg");
        background-size: 100% 252px;
        width: 252px;;
        height: 252px;
        background-position: center;

    }

    .hero-banner.events {

        background-color:black;
        background-repeat: no-repeat;
        background-size: fit;
        background-position: center top;
        background-color:black;
        height: 800px;
    }

    .home .hero-banner.protect hgroup {
        margin-top: 336px;
    }

    .text-block{
    height:600px;
    width:1000px;
    display:block;
    margin:50px auto;
        top: 50px;
        background:white;
        text-align:center;
        overflow:scroll;
    }


    #main {
        position: relative;
            margin-top:0px;
        width: 100%;
        max-width: 1280px;
        overflow: hidden;
        margin-left: auto;
        margin-right: auto;
        height:3000px;
        background-color: black;
    }


     .slider{
        width:1000px;
        height:600px;
        margin:0px auto;
        top: 50px;
        background:white;
        text-align:center;
      }

    .glow{

    box-shadow: inset -1px 0px 0px 0px #ABABAB,0px 0px 48px 27px #0FE1FC;
    -webkit-box-shadow: inset 0px 0px 0px 0px #ABABAB,0px 0px 48px 27px #0FE1FC;
    -moz-box-shadow: inset -1px 0px 0px 0px #ABABAB,0px 0px 48px 27px #0FE1FC;
    -o-box-shadow: inset -1px 0px 0px 0px #ABABAB,0px 0px 48px 27px #0FE1FC;

    }
  
    .popupWindow{
        z-index: 10;
        display: none;
        position: fixed;
        bottom: 0;
        right: 0;
        width: 200px;
        height:130px;
        background: #ECECEC;
        padding: 7px;
        border-radius: 3px;
        -webkit-box-shadow: -10px -8px 17px -1px rgba(15,225,252,1);
        -moz-box-shadow: -10px -8px 17px -1px rgba(15,225,252,1);
        box-shadow: -10px -8px 17px -1px rgba(15,225,252,1);
    }
    .voteImg{
        width: 70px;
        height: 70px;
    }
    #closeWindow{
        width: 15px;
        height: 15px;
        float: right;
        text-align: right;
        font-size: small;
        cursor: pointer;
    }
    #radio_input{
        margin-top:20px;
    }
    #radio_input input{
        cursor: pointer;
    }
    #submitVote{
        width: 100%;
        background: #0937AF;
        color: white;
        padding: 5px;
        border-radius: 5px;
        margin-top: 5px;
        cursor: pointer;
    }
    
    </style>
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
  <script type="text/javascript" src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
  <script type="text/javascript" src="slick.min.js"></script>
  <script src="//load.sumome.com/" data-sumo-site-id="4b997c9d0279bd80bdccffcb3ab1e10e53749aef42184eac7885c00c1874f14d" async="async"></script>
</head>
  <body>

      <div id="main" class="glow">
        <header id="main-header" class="header-bar content" data-swiftype-index="false"> 
            <div class="container">

            <a id="home-link" href="//woofwarrior.com" class="logo woof-logo" title="Woof" itemprop="url"> The Pet Technology 
            <img id="logo.jpg" src="logo.jpg" style="border: 0; float: left; height:50px; margin-right: 15px" /> 
        </a>

            </div>
        
        </header>
       <div class="content wrapper main-wrapper" role="main"> 

            <section class="hero-banner events" style="height:900px"> 
                <div class="container"> 

                <div class="slider glow">
                    <div   style="width:200px; data-width:20%; height:600px; float:left; display:inline-block; background-color:white;">
                        <h2>We want to hear from you. Can you answer 5 quick questions and share.</h2>
                        <a href="https://docs.google.com/forms/d/1lxQ0gvCw14TQLUnOfWUIQXFy-wp7ZtJl_a1bhO3W8eU/edit#">Woof Warrior Dog Toy Survey </a>
                    </div>


                    <div id="paypal"  style="width:200px; data-width:20%; height:600px; float:left; display:inline-block; background-color:white;">
                            <div class="tshirt" style="margin:auto;">
                            </div>
                            <form target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post" style="margin:auto;">
                                <input type="hidden" name="cmd" value="_s-xclick">
                                <input type="hidden" name="hosted_button_id" value="US9FMCYY75V9N">
                                <table style="margin:auto;">
                                <tr><td><input type="hidden" name="on0" value="Size">Size</td></tr><tr><td><select name="os0">
                                    <option value="Small">Small $29.95 USD</option>
                                    <option value="Medium">Medium $29.95 USD</option>
                                    <option value="Large">Large $29.95 USD</option>
                                    <option value="X-tra Large">X-tra Large $29.95 USD</option>
                                    </select> </td></tr>
                                    <tr><td><input type="hidden" name="on1" value="T-shirt color(blank for green)">T-shirt color(blank for green)</td></tr><tr><td><input type="text" name="os1" maxlength="200"></td></tr>
                                    </table>
                                    <input type="hidden" name="currency_code" value="USD">
                                    <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_cart_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                                    <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
                            </form>
                        </div>
                 
                    <div id="mc_embed_signup"  style="width:250px; data-width:20%; height:600px; float:left; display:inline-block;" > <!-- Begin MailChimp Signup Form -->
                            <link href="//cdn-images.mailchimp.com/embedcode/classic-081711.css" rel="stylesheet" type="text/css">

                            <div id="newsletter"> </div>
                            <table><tbody>
                              <tr>
                                                            <td class="mcnImageContent" style="padding-right: 9px;padding-left: 9px;padding-top: 0;padding-bottom: 0;text-align: center;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;" valign="top">
                                
                                    
                                        <img alt="" src="https://gallery.mailchimp.com/702c0542aeb77193ca18f4022/images/31c7e7b1-32c6-4f02-a5c8-f5efcae7b031.png" style="max-width: 1500px;padding-bottom: 0;display: inline !important;vertical-align: bottom;border: 0;height: auto;outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;" class="mcnImage" align="middle" width="564">
                                    
                                
                            </td>
                          </tr>
                            <tr>

                                                    <td class="mcnTextContent" style="padding-top: 9px;padding-right: 18px;padding-bottom: 9px;padding-left: 18px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;word-break: break-word;color: #202020;font-family: Helvetica;font-size: 16px;line-height: 24px;text-align: left;" valign="top">
                        
                            There are a few days left until Woof Warrior is available on the app store. We are thrilled to have had so many participate with photos of their dogs. If you have any photos of you please post below.<br>
<a href="http://woofwarrior.com/woof/?p=13" target="_blank" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;color: #2BAADF;font-weight: normal;text-decoration: underline;">Read more.</a>
                        </td>
                    </tr>
                </tbody></table>

                            <form action="//woofWarrior.us11.list-manage.com/subscribe/post?u=702c0542aeb77193ca18f4022&amp;id=375dd85035" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                                <div id="mc_embed_signup_scroll">
                                <a href="newsletter"> <h2>Subscribe to our mailing list</h2></a>

                                </div>
                            </form>

                            <script type='text/javascript' src='//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js'></script><script type='text/javascript'>(function($) {window.fnames = new Array(); window.ftypes = new Array();fnames[0]='EMAIL';ftypes[0]='email';fnames[1]='FNAME';ftypes[1]='text';fnames[2]='LNAME';ftypes[2]='text';}(jQuery));var $mcj = jQuery.noConflict(true);</script>
                            <!--End mc_embed_signup-->
                        </div>
                    <div id="igg"  style="width:100%; data-width:20%; height:600px; float:left; display:inline-block;">
                                <iframe src="https://www.indiegogo.com/project/woof-warrior-the-pet-technology/embedded/10128090"  height="600px" width="" frameborder="0" scrolling="no" float="left"></iframe>
                            </div>
    </div>
</div>

</section>
<section style="height:900px; font-size:36px; color:black">
        <div class="slider glow">       
<div id="contest"> 

<?php # Script 11.2 - upload_image.php
//connect to db
include_once('mysql.php');

// Check if the form has been submitted:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Check for an uploaded file:
    if (isset($_FILES['upload'])) {
        
        // Validate the type. Should be JPEG or PNG.
        $allowed = array ('image/pjpeg', 'image/jpeg', 'image/JPG', 'image/X-PNG', 'image/PNG', 'image/png', 'image/x-png');
        if (in_array($_FILES['upload']['type'], $allowed)) {
        
            //get last id of image from db for new image name
            $result = mysqli_query($link, "SELECT `imageID` FROM `image` ORDER BY `imageID` DESC;") or die(mysqli_error($link));
            $id = mysqli_fetch_assoc($result);
            $new_id = $id['imageID']+1;
            // Move the file over, set new name
            if (move_uploaded_file ($_FILES['upload']['tmp_name'], "uploads/{$new_id}.jpg")) {

                //check for description and insert description and image to db
                if(isset($_POST['description'])){
                    $stmt = mysqli_prepare($link, "INSERT INTO `image`(`name`, `descID`) VALUES('".$new_id.".jpg', ?);") or die(mysqli_error($link));
                    mysqli_stmt_bind_param($stmt, 'i', $_POST['description']);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_close($stmt);
                    mysqli_query($link, "INSERT INTO `votes_amount`(`amount`, `imageID`) VALUES('0', ".$new_id.");") or die(mysqli_error($link));
                    mysqli_close($link);
                }

                echo '<p><em>The file has been uploaded!</em></p>';
            } // End of move... IF.
            
        } else { // Invalid type.
            echo '<p class="error">Please upload a JPEG or PNG image.</p>';
        }

    } // End of isset($_FILES['upload']) IF.
    
    // Check for an error:
    if ($_FILES['upload']['error'] > 0) {
        echo '<p class="error">The file could not be uploaded because: <strong>';
    
        // Print a message based upon the error.
        switch ($_FILES['upload']['error']) {
            case 1:
                print 'The file exceeds the upload_max_filesize setting in php.ini.';
                break;
            case 2:
                print 'The file exceeds the MAX_FILE_SIZE setting in the HTML form.';
                break;
            case 3:
                print 'The file was only partially uploaded.';
                break;
            case 4:
                print 'No file was uploaded.';
                break;
            case 6:
                print 'No temporary folder was available.';
                break;
            case 7:
                print 'Unable to write to the disk.';
                break;
            case 8:
                print 'File upload stopped.';
                break;
            default:
                print 'A system error occurred.';
                break;
        } // End of switch.
        
        print '</strong></p>';
    
    } // End of error IF.
    
    // Delete the file if it still exists:
    if (file_exists ($_FILES['upload']['tmp_name']) && is_file($_FILES['upload']['tmp_name']) ) {
        unlink ($_FILES['upload']['tmp_name']);
    }
            
} // End of the submitted conditional.
?>
    
<form enctype="multipart/form-data" action="" method="post">

    <input type="hidden" name="MAX_FILE_SIZE" value="524288" />
    Check out the<a href="http://woofwarrior.com/gallery" target="_blank" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;color: #2BAADF;font-weight: normal;text-decoration: underline;"> gallery</a>and vote for your favorite.
    
    <fieldset><legend>Select a JPEG or PNG image of 512KB or smaller to be uploaded:</legend>
    
    <p><b>File:</b> <input type="file" name="upload" /></p>
    
    </fieldset>
    <div align="center"><input type="submit" name="submit" value="Submit" /></div>

    <select name="description" id="description"> 
 
<?php
$link = mysqli_connect('localhost', 'woofwarr_ksenia', 'ksenia', 'woofwarr_gallery') or die(mysqli_error($link));
 
if (mysqli_connect_errno()) {
     printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
 
$query = "SELECT `desc`, `descID` FROM `description` ORDER BY `descID` LIMIT 100";
 
if ($result = mysqli_query($link, $query)) {
 
    while ($row = mysqli_fetch_assoc($result)) {
        printf ("<option value='(%s)'>%s</option>", $row["descID"], $row["desc"]);
    }
    mysqli_free_result($result);
    print("<option id=loadMore>Load more</option>");
}
 
 
 
?>
</select>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script type=text/javascript>
 
$(document).ready(function(){
    $('#description').change(function(){
        var lastOption = $('#description option:last-child');
        var preLast = lastOption.prev();
        var lastValue = preLast.val();
        console.log(lastValue);
        if($('#description').children(":selected").attr("id") == 'loadMore'){
             
            $.ajax({
                type:'post',
                url:'2.php',
                data:{lastId:lastValue},
                success:function(data){
                    var data = JSON.parse(data);
                    console.log(data);
                    $('#description option:last-child').remove();
                    for (var i = 0; i < data.length; i++){
                        $('#description').append($("<option></option>").attr("value",data[i]['descID']).text(data[i]['desc'])); 
                    }
                    $('#description').append('<option id=loadMore>Load more</option>');
                     
                }
            })
        }
    })
})
</script>

</form>
<div style="height:50%">
We are stoked to see the photos of your dogs this Halloween! Woof Warrior will donate .10 cents for every photo submitted to the shelter sponsor, Max. <A href="http://woofwarrior.com/woof/?p=21">Read more about the contest here</A>
</div>
</div>
</div>
</section>


                       

       
                 
                 <section class="blog">


                                  <div class="slider glow">
                                    <div>
                                    <iframe width="1000" height="600" src="http://woofwarrior.com/woof/?p=38" frameborder="0" overflow="scroll" allowfullscreen></iframe></div>
                    

              </div>
               </section>
       </div>
     </div>
    <div class="popupWindow" id="popupWindow">
    <div id="closeWindow">&#10006;</div>
        <form name="voteForm" id="voteForm">
            <div id="radio_input">
            <?php
            $dir="uploads";

        //get top two images for voting from mysql
        $result = mysqli_query($link, "SELECT * FROM `image`INNER JOIN `votes_amount` ON `image`.`imageID`=`votes_amount`.`imageID` ORDER BY `votes_amount`.`amount` DESC LIMIT 2") or die(mysqli_error($link));
        $images = array();
        while($row = mysqli_fetch_assoc($result)){
          $images[] = $row;
        }

                for($i=0;$i<count($images);$i++){
                    echo '<input type="radio" name="votePic" value="'.$images[$i]['imageID'].'"/><img src="'.$dir.'/'.$images[$i]['name'].'" class="voteImg"/>';
                }
            ?>
            </div>
            <input type=button id="submitVote" value="VOTE" disabled/>
        </form>
    </div>

<script type="text/javascript">

setTimeout(function(){var a=document.createElement("script");
var b=document.getElementsByTagName("script")[0];
a.src=document.location.protocol+"//script.crazyegg.com/pages/scripts/0039/5066.js?"+Math.floor(new Date().getTime()/3600000);
a.async=true;a.type="text/javascript";b.parentNode.insertBefore(a,b)}, 1);

(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-67541153-1', 'auto');
  ga('send', 'pageview');




    $(document).ready(function(){
      $('.slider').slick({
      slidesToShow: 1,
 slidesToScroll: 1,
  dots: true,
  infinite: true,
  speed: 500,
  fade: true,
  cssEase: 'linear',
  autoplay:true,
  autoplaySpeed: 1500

});

    $("#popupWindow").animate({
            width: 'toggle'
        }, 'slow');
 
    $("#closeWindow").click(function(){
        $("#popupWindow").animate({
            width: 'toggle'
        }, 'slow');
    }); 
})

    document.getElementById('submitVote').onclick=function(){
        var httpRequest;
        httpRequest = new XMLHttpRequest();
 
        if (!httpRequest) {
            console.log('Cannot create an XMLHTTP instance');
            return false;
        }else{
            httpRequest.onreadystatechange = alertContents;
            var formElement = document.getElementById('voteForm');
            var formData = new FormData(formElement);
            httpRequest.open("POST", "vote.php");
            formData.append("action", "anonymous_voting");
            //console.log(formData);
            httpRequest.send(formData);
        }
        function alertContents() {
            if (httpRequest.readyState === XMLHttpRequest.DONE) {
                if (httpRequest.status === 200) {
                    console.log(httpRequest.responseText);
                    var data = JSON.parse(httpRequest.responseText);
                    var html = '';
                    //changed the uploads directory to index
                    for(i=0;i<data.length;i++){
                        html += '<input type="radio" name="votePic" value="'+data[i]['imageID']+'"/><img src="/uploads/'+data[i]['name']+'" class="voteImg"/>';
                    }
                    document.getElementById('radio_input').innerHTML = html;
                }else{
                    console.log('There was a problem with the request.');
                }
            }
        }
    }

  </script>

  </body>


</html>