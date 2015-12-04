users_dir = 'http://'+window.location.hostname+'/users/';
function forgotPasswordFunc(){
	document.getElementById('forgotInput').innerHTML = '<input type=email name=forgot_email id=forgot_email placeholder="your email" /><br/><input type=button value=Send onclick="sendPassword()" >'
}
function sendPassword(){
	var httpRequest;
    httpRequest = new XMLHttpRequest();

    if (!httpRequest) {
        console.log('Cannot create an XMLHTTP instance');
        return false;
    }else{
        httpRequest.onreadystatechange = alertContents;
        httpRequest.open("POST",  users_dir+'forgot.php');
        var email = document.getElementById('forgot_email').value;
        httpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        httpRequest.send('email='+email);
    }
    function alertContents() {
        if (httpRequest.readyState === XMLHttpRequest.DONE) {
            if (httpRequest.status === 200) {
                console.log(httpRequest.responseText);
                var data = JSON.parse(httpRequest.responseText);
                console.log(data);

                document.getElementById('forgotInput').innerHTML = data;
                
            }else{
                console.log('There was a problem with the request.');
            }
        }
    }
}