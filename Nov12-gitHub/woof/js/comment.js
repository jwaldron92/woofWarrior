$(document).ready(function(){

	$.ajax({
		type:'post',
		url:'comment.php',
		data:{action:'getFirstComments', postID:postID},
		success:function(data){
			var data = JSON.parse(data);
			for(i=0;i<data['user'].length; i++){
				var comment = makeComment(data['user'][i], data['comment'][i], data['date'][i]);
				$('#commentsBock').append(comment);
			}
		}
	})


	$('#postComment').click(function(){
		$.ajax({
			type:'post',
			url:'comment.php',
			data:{newComment:$('#comment').val(), postID:postID},
			success:function(data){
				var data = JSON.parse(data);
				var comment = makeComment(data['user'], $('#comment').val(), data['date']);
				$('#commentsBock').prepend(comment);
				$('#comment').val('');
			}
		})
	})
})

function makeComment(user, comment, date){
	var comment = '<div><div>'+user+'</div><div>'+comment+'</div><div>'+date+'</div><div>';
	return comment;
}
function getComments(){

}