//ajax call to send upvote
function vote(name){
    var httpRequest;
    httpRequest = new XMLHttpRequest();

    if (!httpRequest) {
        console.log('Cannot create an XMLHTTP instance');
        return false;
    }else{
        httpRequest.onreadystatechange = alertContents;
        httpRequest.open('POST', 'vote.php', true);
        var data = "name="+encodeURIComponent(name);
        httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        //console.log(data);
        httpRequest.send(data);
    }
    function alertContents() {
        if (httpRequest.readyState === XMLHttpRequest.DONE) {
            if (httpRequest.status === 200) {
                console.log(httpRequest.responseText);
                var data = JSON.parse(httpRequest.responseText);
                if(data['imageID'] && data['new_amount']){
                    document.getElementById(data['imageID']).innerHTML = data['new_amount'];
                }
            } else {
                console.log('There was a problem with the request.');
            }
        }
    }
}
