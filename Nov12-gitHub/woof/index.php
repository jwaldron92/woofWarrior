
<?php
include 'mysql.php';


//gather the posts
$get_posts_sql = "SELECT * FROM forum_posts ORDER BY post_create_time DESC LIMIT 50";
$get_posts_res = mysqli_query($link, $get_posts_sql) or die(mysqli_error($link));

if (mysqli_num_rows($get_posts_res) < 1) {
	//there are no posts, so say so
	$display_block = "<p><em>No posts exist.</em></p>";
} else {
	//create the display string
    $display_block = <<<END_OF_TEXT

END_OF_TEXT;

	while ($post_info = mysqli_fetch_array($get_posts_res)) {
		$post_id = $post_info['post_id'];
		$post_title = stripslashes($post_info['post_title']);
		$post_create_time = $post_info['post_create_time'];
		$post_owner = stripslashes($post_info['post_owner']);
		$post_image = stripslashes($post_info['post_image']);


		$date = date('j/m', $post_create_time);
		//get number of posts
		$get_num_posts_sql = "SELECT COUNT(post_id) AS post_count FROM forum_posts WHERE post_id = '".$post_id."' ";
		$get_num_posts_res = mysqli_query($link, $get_num_posts_sql) or die(mysqli_error($link));

		while ($posts_info = mysqli_fetch_array($get_num_posts_res)) {
			$num_posts = $posts_info['post_count'];
		}


		//add to display
		$display_block .= <<<END_OF_TEXT


		

END_OF_TEXT;
	}
	//free results
	mysqli_free_result($get_posts_res);
	mysqli_free_result($get_num_posts_res);

	//close connection to MySQL
	mysqli_close($link);


}
?>
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <title>Woof Warrior, the pet technology</title>
    <link rel="shortcut icon" type="image/png" href="/favicon.png"/>
    <meta name="theme-color" content="#ffffff">
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
		background-image:url("dog-paw.jpeg");
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
	
	body{
		height: 1000px;
	}
	.adminBlock{
		display: inline-block;
		margin: 10px;
		float:left;

    box-shadow: inset -1px 0px 0px 0px #ABABAB,0px 0px 48px 27px #0FE1FC;
    -webkit-box-shadow: inset 0px 0px 0px 0px #ABABAB,0px 0px 48px 27px #0FE1FC;
    -moz-box-shadow: inset -1px 0px 0px 0px #ABABAB,0px 0px 48px 27px #0FE1FC;
    -o-box-shadow: inset -1px 0px 0px 0px #ABABAB,0px 0px 48px 27px #0FE1FC;

        margin:50px;
        top: 10px;
        background:white;
        text-align:center;

    
	}
	.new_post div{
		//display: inline-block;
	}
	.post_image{
		width: 200px;
		height:200px;
	}
	#adminPosts, #allPosts{
		overflow-y: scroll;
		height: 900px;
	}
	

	 #main {
        position: relative;
            margin-top:0px;
        width: 100%;
        max-width: 1280px;
        overflow: hidden;
        margin-left: auto;
        margin-right: auto;
        height:3825px;
        background-color: black;
    }




    .glow{

    box-shadow: inset -1px 0px 0px 0px #ABABAB,0px 0px 48px 27px #0FE1FC;
    -webkit-box-shadow: inset 0px 0px 0px 0px #ABABAB,0px 0px 48px 27px #0FE1FC;
    -moz-box-shadow: inset -1px 0px 0px 0px #ABABAB,0px 0px 48px 27px #0FE1FC;
    -o-box-shadow: inset -1px 0px 0px 0px #ABABAB,0px 0px 48px 27px #0FE1FC;
	       width:1000px;
        height:600px;
        margin:0px auto;
        top: 50px;
        background:white;
        text-align:center;

    }
</style>
    </head>
    <body>
     <div id="main" class="glow">
    
 <header id="main-header" class="header-bar content" data-swiftype-index="false"> 
            <div class="">

            <a id="home-link" href="//woofwarrior.com" class="logo woof-logo" title="Woof" itemprop="url"> The Pet Technology 
            <img id="logo.jpg" src="logo.jpg" style="border: 0; float: left; height:50px; margin-right: 15px" /> 
        </a>

            </div>
        
        </header>
       <div class="content wrapper main-wrapper" role="main"> 

            <section class="hero-banner events" style="float:left; height:900px; width:25%"> 	
            <div>welcome<?php session_start(); if(isset($_SESSION['username'])){print (', '.$_SESSION['username']);} ?></div>

			<div><?php echo $display_block; ?></div>
            <div>Want to Join?</a></div>  
            <div><a href="view.php">Log in</a></div>  
            <div><a href="view.php">Sign up</a></div>  
			<div><a href="addpost.html">add a post</a></div>            
            
            
            
            </section>
                        <section class="hero-banner events" style="float:left; height:900px; width:75%">
                        
                        <div class="new_post">
	

	<div id="adminPosts" class="adminPosts">
    
    
    </div>

	<div id="allPosts" class="allPosts">
    
    
    
    </div>
</div>

                        
                        </section>
      	</div>
        </div>
  




<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<script type="text/javascript" src=js/getPosts.js></script>
</body>

</html>
