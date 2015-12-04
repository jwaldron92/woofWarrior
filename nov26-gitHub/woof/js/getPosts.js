$(document).ready(function(){

    getPostsAjax({action:'getFirst'});

   

    $('#adminPosts').scroll(function(){

        check_scroll($('#adminPosts'), 'adminBlock', 'admin');

    })



    $('#allPosts').scroll(function(){

        check_scroll($('#allPosts'), 'userBlock', 'user');

    })

})





function check_scroll(elem, classname, from){

    if (elem[0].scrollHeight - elem.scrollTop() == elem.outerHeight()) {

        getPostsAjax({lastPost:$('.'+classname+':last').attr('id'), from:from})

    }

}



function getPostsAjax(data){

     $.ajax({

        type:'post',

        url:'posts.php',

        data:data,

        success:function(data){

            //console.log(data);



            var data = JSON.parse(data);



            if(data['admin']){

                for(i=0;i<data['admin'].length;i++){

                    $('#adminPosts').append("<div class=adminBlock id="+data['admin'][i]['post_id']+"><a href='showpost.php?post_id="+data['admin'][i]['post_id']+"'><div>"+data['admin'][i]['post_title']+"</div><div><img src='post_image/"+data['admin'][i]['post_image']+"' alt='post image' class=post_image /></div></a></div>");

                }

            }

//<div>"+data['admin'][i]['post_create_time']+"</div>

            if(data['other']){

                for(i=0;i<data['other'].length;i++){

                    $('#allPosts').append("<div class=userBlock id="+data['other'][i]['post_id']+"><div><a href='showpost.php?post_id="+data['other'][i]['post_id']+"'>"+data['other'][i]['post_title']+"</a></div></div>")

                }

            }

        }

    })

}