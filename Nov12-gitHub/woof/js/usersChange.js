$(document).ready(function(){

	$('#changeEmail').click(function(){
		if($('#new_email').val() != ''){
			$.ajax({
				type:'post',
				url:'users_change.php',
				data:{action:'change_email', email:$('#new_email').val()},
				success:function(data){
					console.log(data);
					var data = JSON.parse(data);
					$('#current_email').val($('#new_email').val());
					$('#new_email').val('');
					$('#statusEmail').html(data);
				}
			})
		}
	})

	$('#changePassword').click(function(){
		if($('#new_password').val() != '' && $('#repeat_new_password').val() != '' && $('#current_password').val() !=''){
			$.ajax({
				type:'post',
				url:'users_change.php',
				data:{action:'change_password', current_password:$('#current_password').val() , new_password:$('#new_password').val(), repeat_new_password:$('#repeat_new_password').val()},
				success:function(data){
					console.log(data);
					var data = JSON.parse(data);
					$('#new_password').val('');
					$('#repeat_new_password').val('');
					$('#current_password').val('');
					$('#statuspassword').html(data);
				}
			})
		}
	})

})