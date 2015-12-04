/**
 * Created by Haziq on 10/22/2015.
 */

var images;



function getImages()
{
    return images;
}


/**
 *
 */
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
                    console.log(data);
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
        var pth = data[i]['Alt'];
        pth    = 'Uploaded/' + pth;
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


function lsitImages()
{
    var fileExt = {};
    fileExt[0]=".png";
    fileExt[1]=".jpg";
    fileExt[2]=".gif";
    $.ajax({
        //This will retrieve the contents of the folder if the folder is configured as 'browsable'
        url: 'Uploaded/',
        success: function (data)
        {
            console.log(data);
            $("#main").html('<ul>');
            //List all png or jpg or gif file names in the page
            $(data).find('a:contains(" + fileExt[0] + "),a:contains(" + fileExt[1] + "),a:contains(" + fileExt[2] + ")').each(function () {
                var filename = this.href.replace(window.location.host, "").replace("http:///", "");
                console.log(filename);
                $("#main").append( '<li>'+filename+'</li>');
            });
            $("#main").append('</ul>');
        },
        error: function(data)
        {
           console.log('Error: '+data);
        }
    });
}