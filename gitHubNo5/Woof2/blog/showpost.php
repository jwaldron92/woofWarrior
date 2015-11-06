<?php
include_once('mysql.php');

if (!isset($_GET['post_id']) || empty($_GET['post_id'])) {
	header("Location: postslist.php");
	exit;
}

$stmt = mysqli_prepare($link, "SELECT `post_id` FROM `forum_posts` WHERE `post_id`=?;") or die(mysqli_error($link));
mysqli_stmt_bind_param($stmt, 'i', $_GET['post_id']);
mysqli_stmt_execute($stmt);
mysqli_stmt_store_result($stmt);
$rows = mysqli_stmt_num_rows($stmt);
mysqli_stmt_close($stmt);

if($rows == '0'){
	echo "<p><em>You have selected an invalid post.<br/> Please <a href=\"postslist.php\">try again</a>.</em></p>";
	exit;
}else{
	$res = mysqli_query($link, "SELECT * FROM `forum_posts` WHERE `post_id`=".$_GET['post_id'].";") or die(mysqli_error($link));
	$post = mysqli_fetch_assoc($res);
	
}


?>

<!DOCTYPE html>
<html>
<head>
	<title>Post</title>
</head>
<body>
	<div class=postBlock>	
		 	<div><h2><?php echo $post['post_title']; ?></h2></div>
		 	<div><?php $date = date('j/m', $post['post_create_time']); echo $date; ?></div>
		 	<div><?php echo nl2br($post['post_text']); ?></div>
	</div>
		<div id="disqus_thread"></div>
<script>
    /**
     *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
     *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables
     */
    
    var disqus_config = function () {
        this.page.url = window.Location.href;
        this.page.identifier = "<? php echo $_GET['post_id']; ?>";
        this.page.title = 'Show post';
    };
    
    (function() {  // REQUIRED CONFIGURATION VARIABLE: EDIT THE SHORTNAME BELOW
        var d = document, s = d.createElement('script');
        
        s.src = '//woofwarrior.disqus.com/embed.js';  // IMPORTANT: Replace EXAMPLE with your forum shortname!
        
        s.setAttribute('data-timestamp', +new Date());
        (d.head || d.body).appendChild(s);
    })();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript" rel="nofollow">comments powered by Disqus.</a></noscript>
			
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script type="text/javascript" src=online.js></script>
</body>
</html>