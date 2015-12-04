users_dir = 'http://'+window.location.hostname+'/users/';
$(document).ready(function(){
	$('#submitChangePic').click(function(){
		var data = new FormData();
	  	$.each($('#file')[0].files, function(i, file) {
	      data.append('file[]', file);
	    });

     	$.ajax({
	        type: 'POST',
	        url:  users_dir+"profile_pic.php",
	        data: data,
	        cache: false,
	        contentType: false,
	        processData: false,
	        success: function(data) {
	            console.log(data); 
	            var data = JSON.parse(data);
	            if(data['pic']){
	            	$('#profilePic').html('<img src="http://'+window.location.hostname+'/users/profile_pic/'+data['pic']+'" width=100 heigth=100 />')
	            }
	        }
	    })
	})
})