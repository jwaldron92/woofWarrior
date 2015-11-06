$(document).ready(function(){
    getPostsAjax({action:'getFirst'});
})

$(window).scroll(function() {
   if($(window).scrollTop() + $(window).height() == $(document).height()) {
        getPostsAjax({lastPost:$('.post_block:last').attr('id')});
   }
});

function getPostsAjax(data){
     $.ajax({
        type:'post',
        url:'ajax.php',
        data:data,
        success:function(data){

            var data = JSON.parse(data);
            for(i=0;i<data.length;i++){
                $('#allPosts').append("<div class=post_block id="+data[i]['post_id']+"><a href='showpost.php?post_id="+data[i]['post_id']+"'><div>"+data[i]['post_create_time']+"</div><div><img src='post_image/"+data[i]['post_image']+"' alt='post image' class=post_image /></div><div>"+data[i]['post_title']+"</div></a></div>");
            }
        }
       })
}