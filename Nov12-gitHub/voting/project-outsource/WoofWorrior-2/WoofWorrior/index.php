
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">



    <link href="style/login.css" rel='stylesheet' type='text/css' />
    <script src="js/jquery-1.11.3.min.js"></script>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="application/x-javascript">
        addEventListener("load",
            function() {
                setTimeout(hideURLbar, 0);
            }, false);
        function hideURLbar(){
            window.scrollTo(0,1);
        }
    </script>
    <!--webfonts-->
    <link href='http://fonts.googleapis.com/css?family=Oxygen:400,300,700|Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>
    <!--//webfonts-->
    <script>
        function myFunction()
        {
            //alert("Thanks for login");

            var $email = $('form input[name="Username'); //change form to id or containment selector
            var re = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
            if ($email.val() == '' || !re.test($email.val()))
            {
                var message = 'Please enter correct email address'+ '\n';
                alert(message);

            }
            else
            {

                $(document).ready(function(){

                    //Ajax call
                    $.ajax(
                        {
                            type: "POST",
                            url: 'ActionClasses/User.php',
                            data: $("#login").serialize(),
                            dataType:'json',
                            success: function(data)
                            {
                                var result = JSON.stringify(data);
                                result = JSON.parse(result);
                                console.log(result);
                                if(result[0]['Status'] == "ok")
                                {
                                    window.location = "Upload.php";
                                }
                                else
                                {
                                    console.log(result);
                                }
                            },
                            error: function(data) {
                                var result = JSON.stringify(data);
                                result = JSON.parse(result);
                                console.log(result);


                            }

                        });
                });
            }

        }
    </script>
</head>

<body>
<div class="main">

    <div class="user">
        <img src="images/user.png" alt="">
    </div>
    <div class="login">
        <div class="inset">
            <!-----start-main---->
            <div id="dd" style="display: none;"></div>

            <form id="login" method="POST"  name="login"  >
                <div>
                    <span><label>Username</label></span>
                    <span><input type="text" class="textbox" id="Username" name="Username"/></span>
                </div>
                <div class="sign">
                    <div class="submit">
                        <input type="button" class="submit" value="LOGIN"  onclick="myFunction()"  />
                    </div>
						<span class="forget-pass">
							<a href="#">Forgot Password?</a>
						</span>
                    <div class="clear"> </div>
                </div>
            </form>
        </div>
    </div>
    <!-----//end-main        onclick="myFunction()" action="ActionClasses/Loginn.php"  ---->
</div>
<!-----start-copyright---->

<!-----//end-copyright---->

</body>
</html>
