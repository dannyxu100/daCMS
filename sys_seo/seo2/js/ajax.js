function newXMLHTTPRequest(){
    var xmlreq;
    //是否支持 new XMLHttpRequest创建，即IE7,IE8及非IE
    if(window.XMLHttpRequest){
        xmlreq = new XMLHttpRequest();
    }
    else{
        try{
            //IE5.5，IE6.O
            xmlreq = new ActiveXObject("Msxml2.XMLHTTP");
        }
        catch(e){
            //IE5既以下
            xmlreq = new ActiveXObject("Microsoft.XMLHTTP");
        }
    }
    return xmlreq;
}

function backFun(req,id,vType){	
    return function (){
        if(req.readyState==4 && req.status == 200){
            switch(vType){
                case "value":
                    document.getElementById(id).value = req.responseText;
                    break;
                case "html":
                    document.getElementById(id).innerHTML = req.responseText;
                    break;
                case "alert":
                    alert(req.responseText)
                    break;   
            }
        }
    }
}

function talktoServer(url,id,vType){	
    var req = newXMLHTTPRequest();
    var cbf = backFun(req,id,vType);
    req.onreadystatechange = cbf;
    req.open("POST",url,true);
	req.setRequestHeader( "Content-Type", "text/html;charset=UTF-8" ); 
    req.send(null);
}