/**
 * Created by Haziq on 10/22/2015.
 */

//Allowed EXxtensions
var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'bmp'];

$("#images").change(function(){

    var fileSize = this.files[0].size;
    console.log( 'Bytes: '+fileSize);
    var KB  = Math.round(  parseFloat( ( parseFloat(fileSize)/1024 )) * 100)/ 100;
    var MB  = Math.round(  parseFloat( ( parseFloat(KB)/1024 )) * 100) / 100;
    console.log( 'KiloBytes: '+ KB);
    console.log('MegaBytes: ' + MB);
    if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1)
    {
        //alert("Only formats are allowed : "+fileExtension.join(', '));
        errorMessage("Only formats are allowed : "+fileExtension.join(', '));
        $("#image-list").removeAttr('src');
        return;
    }
    else
    {
        if (MB > 10)
        {
            //alert("FileSize should not exceed by 10");
            errorMessage('FileSize should not exceed by 10');
            $("#image-list").removeAttr('src');
            return;
        }
        else
        {
            previewImage($("#images"));
            uploadFile();
        }
    }

});


function uploadFile()
{
    var formData = new FormData($('#form')[0]);
    $.ajax({

        url:'ActionClasses/upload.php',
        type:'POST',
        data:formData,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function(data)
        {
            //console.log(formData);
        },

        onComplete: function(data)
        {

        },

        success:    function(data)
        {
            //var result = JSON.parse(data);
            console.log(result);
            if(data[0]['Status'] == 'ok')
            {
                //preview Image
                removeError();
                previewImage($("#images"));
            }
            else
            {
                errorMessage(data[0]['Message']);
            }
        },

        error:      function(data)
        {
            errorMessage(data[0]['Message']);
            console.log(data);
        }
    });

}

function previewImage(input)
{
    var image_holder = $("#image-list");
    image_holder.empty();
    var reader = new FileReader();
    reader.onload = function (e)
    {
        var image = document.getElementById('image-list');
        $("#image-list").attr({
            src: e.target.result
        });
    }
    //image_holder.show();
    reader.readAsDataURL($(input)[0].files[0]);

    //display div with sucess here
    $("#alert").show();
    $("#alert").addClass('alertSuccess');
    $("#alertText").text('Your file has been uploaded!!!!!');

    setTimeout(function()
    {
        $("#alert").fadeOut('slow', function(){
            $("#alertText").text('');
            $("#alert").removeClass('alertSuccess');
            $("#alert").hide();
        });
    }, 500);

}

function errorMessage(message)
{
    $("#image-list").removeAttr('src');
    $("#image-list").hide();
    $("#error").show();
    $("#error").html(message);

    //display div with error here
    $("#alert").show();
    $("#alert").addClass('alertError');
    $("#alertText").text(message);

    setTimeout(function()
    {
        $("#alert").fadeOut('slow', function(){
            $("#alertText").text('');
            $("#alert").removeClass('alertError');
            $("#alert").hide();
        });
    }, 500);

}

function removeError()
{
    $("#error").html('');
    $("#error").hide();
    $("#image-list").hide();
}