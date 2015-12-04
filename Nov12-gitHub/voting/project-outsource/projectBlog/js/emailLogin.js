function checkLogin(){
    var httpRequest;
    httpRequest = new XMLHttpRequest();

    if (!httpRequest) {
        console.log('Cannot create an XMLHTTP instance');
        return false;
    }else{
        httpRequest.onreadystatechange = alertContents;
        httpRequest.open("POST", 'login.php');
        httpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        httpRequest.send('action=checkLogin');
    }
    function alertContents() {
        if (httpRequest.readyState === XMLHttpRequest.DONE) {
            if (httpRequest.status === 200) {
                console.log(httpRequest.responseText);
                var data = JSON.parse(httpRequest.responseText);
                console.log(data);
                if(data == 'logged in'){
                    document.getElementById('loginDiv').innerHTML = "<input type='button' value='Log out' onclick='logout()' />";
                }else{
                     document.getElementById('loginDiv').innerHTML = '<form id="loginForm"><input type="email" name="email" placeholder="email"/><br/><input type="password" name="password" placeholder="password"/><br/><input type="button" id="login" value="Login" onclick="loginEmail()" /></form>';
                }
                
            }else{
                console.log('There was a problem with the request.');
            }
        }
    }
}
checkLogin();
function logout(){
    var httpRequest;
    httpRequest = new XMLHttpRequest();

    if (!httpRequest) {
        console.log('Cannot create an XMLHTTP instance');
        return false;
    }else{
        httpRequest.onreadystatechange = alertContents;
        httpRequest.open("POST", 'login.php');
        httpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        httpRequest.send('action=logout');
    }
    function alertContents() {
        if (httpRequest.readyState === XMLHttpRequest.DONE) {
            if (httpRequest.status === 200) {
                console.log(httpRequest.responseText);
                var data = JSON.parse(httpRequest.responseText);
                console.log(data);
                if(data == 'logged out'){
                    FB.logout(function(response) {
                        console.log(response)
                    });
                    window.location = 'login.html';
                }
                
            }else{
                console.log('There was a problem with the request.');
            }
        }
    }
}

function loginEmail(){
    var formElement = document.getElementById('loginForm');

    var httpRequest;
    httpRequest = new XMLHttpRequest();

    if (!httpRequest) {
        console.log('Cannot create an XMLHTTP instance');
        return false;
    }else{
        httpRequest.onreadystatechange = alertContents;
        var formData = new FormData(formElement);
        httpRequest.open("POST", 'login.php');
        //console.log(formData);
        httpRequest.send(formData);
    }
    function alertContents() {
        if (httpRequest.readyState === XMLHttpRequest.DONE) {
            if (httpRequest.status === 200) {
                console.log(httpRequest.responseText);
                var data = JSON.parse(httpRequest.responseText);
                console.log(data);
                if(data == 'logged in'){
                    document.getElementById('loginDiv').innerHTML = "Logged In!";
                    window.location = 'view.php';
                }
                
            }else{
                console.log('There was a problem with the request.');
            }
        }
    }
    checkLogin();
}