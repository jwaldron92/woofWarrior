<?php
include('mysql.php');
$dir="../uploads";

//get top two images for voting from mysql
$result = mysqli_query($link, "SELECT * FROM `image`INNER JOIN `votes_amount` ON `image`.`imageID`=`votes_amount`.`imageID` ORDER BY `votes_amount`.`amount` DESC LIMIT 2") or die(mysqli_error($link));
$images = array();
while($row = mysqli_fetch_assoc($result)){
	$images[] = $row;
}

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		.popupWindow{
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
	<script src="js/jquery-1.11.3.min.js"></script>
</head>
<body>
	<div id="content" >
		site content
	</div>

	<div class="popupWindow" id="popupWindow">
	<div id="closeWindow">&#10006;</div>
		<form name="voteForm" id="voteForm">
			<div id="radio_input">
			<?php
				for($i=0;$i<count($images);$i++){
					echo '<input type="radio" name="votePic" value="'.$images[$i]['imageID'].'"/><img src="'.$dir.'/'.$images[$i]['name'].'" class="voteImg"/>';
				}
			?>
			</div>
  			<input type=button id="submitVote" value="VOTE"/>
		</form>
	</div>
</body>
</html>

<script type="text/javascript">
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
            		for(i=0;i<data.length;i++){
            			html += '<input type="radio" name="votePic" value="'+data[i]['imageID']+'"/><img src="../uploads/'+data[i]['name']+'" class="voteImg"/>';
            		}
            		document.getElementById('radio_input').innerHTML = html;
            	}else{
                	console.log('There was a problem with the request.');
            	}
        	}
    	}
	}

$(document).ready(function(){
	$("#popupWindow").animate({
        	width: 'toggle'
    	}, 'slow');

	$("#closeWindow").click(function(){
   		$("#popupWindow").animate({
        	width: 'toggle'
    	}, 'slow');
	}); 
})

</script>
