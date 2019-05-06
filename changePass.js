var xmlHttp = createXmlHttpRequestObject();

function createXmlHttpRequestObject() {
    var xmlHttp;

    if (window.ActiveXObject) {
        try{
            xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        catch(e){
            xmlHttp=false;
        }
    }
    else{
        try{
            xmlHttp = new XMLHttpRequest();
        }
        catch(e){
            xmlHttp=false;
        }

        // body...
    }

    if (!xmlHttp) {
        alert("Can't create the object")
    }
    else
        return xmlHttp;
}

function processStart() {
    if (xmlHttp.readyState ==0 || xmlHttp.readyState ==4) {
        oldPwd = encodeURIComponent(document.getElementById('oldpwd').value);
        xmlHttp.open("GET","change_password.php?oldPwd="+oldPwd,true);
        xmlHttp.onreadystatechange = handleServerResponse;
        xmlHttp.send();
    }
    else{
        setTimeout('processStart()',1000);

    }
}

function handleServerResponse() {

    if (xmlHttp.readyState == 4) {
        if (xmlHttp.status == 200) {
            document.getElementById("underOldPwd").innerHTML = '<span style="color:blue;">'+this.responseText+'</span>';
            setTimeout('processStart()',1000);
        }
    }

}