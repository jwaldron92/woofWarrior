$(document).ready(function(){
	$('.deletePost').click(function(event){
		postId = event.target.id;
		$.ajax({
			type:'post',
			url:'users_delete.php',
			data:{action:'deletePost', id:postId},
			success:function(data){
				console.log(data);
				$('#'+postId).parent().remove();
			}
		})
	})
})