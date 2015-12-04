/**
 * Created by Haziq on 10/22/2015.
 */

var images;



function getImages()
{
    return images;
}



function getImagesDatabase()
{
    $.ajax(
        {
            type: "POST",
            url : "ActionClasses/GetImages.php",
            dataType:"json",
            success: function(data)
            {
                if(data[0]['Status'] == 'ok')
                {
                    images = data;
                    console.log('Success');
                    appendElements(data);
                }
                else
                {
                    showError(data[0]['Message']);
                }
            },
            error:  function(data)
            {
                console.log(data);
            }
        });
}


function showError(message)
{
    console.log(message);
}

function appendElements(data)
{
    for(var i=1; i<data.length; i++)
    {
        var id = data[i]['Description'];
        var pth = data[i]['Path'];
        pth     = pth.slice(28);
        console.log(pth);
        var image = new Image();
        image.src = pth;
        var divElement     = "<div id = "+id + '">';
        var imageElement   = "<image src = "+ pth + '" class = "image" />';
        var headingElement = '<h3 class="text">' + id + '<h3/> <div/>';
        var elements = divElement + imageElement + headingElement;
        $("#main").html(elements);
    }
}
