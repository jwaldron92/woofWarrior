/**
 * Created by Haziq on 10/29/2015.
 */




function logout()
{
    $.ajax({

                url: 'ActionClasses/Logout.php',
           dataType: 'json',
            success: function(data){

                      if(data[0]['Status'] == 'ok')
                      {
                          window.location = 'Login.php';
                      }
                      else
                      {
                          alert(data[0]['Message']);
                      }

            },
            error  : function(data){
                      console.log(data);
                      alert('Some error occurred');
            }
    });

}