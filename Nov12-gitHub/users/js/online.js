users_dir = 'http://'+window.location.hostname+'/users/';
var Client = Client || {};
Client.Pulse = null; 
$(document).ready(function(){
  Client.Active(); 
});

Client.Active = function(){
  $.ajax({ 
    url :  users_dir+'online.php',
    type : 'post',
    success : function(jActiveUsers,sStatus,jqXHR){ 
      console.log(jActiveUsers,sStatus,jqXHR);
      Client.RenderActiveUsers(jActiveUsers);
      Client.Pulse = setTimeout(function(){
        Client.Active();
      },60000); 
    }
  });
}

Client.RenderActiveUsers = function(jActiveUsers){
}