var xmlHttp;
function makeRequest(queryString) {
	var msXml = new Array();
	msXml[0] = "Microsoft.XMLHTTP";
	msXml[1] = "MSXML2.XMLHTTP.5.0";
	msXml[2] = "MSXML2.XMLHTTP.4.0";
	msXml[3] = "MSXML2.XMLHTTP.3.0";
	msXml[4] = "MSXML2.XMLHTTP";
	if (window.xmlHttpRequest) {
		xmlHttp = new XMLHttpRequest();
	} else {
		for (var i = 0; i < msXml.length; i++) {
			try {
				xmlHttp = new ActiveXObject(msXml[i]);
				break;
			} catch (e) {
				xmlHttp = new xmlHttpRequest();
			}
		}
	}
	xmlHttp.onreadystatechange = getRequest;
	xmlHttp.open('post', 'tests.php', true);
	xmlHttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	xmlHttp.send(queryString);
}
function getRequest() {
	if(xmlHttp.readyState==4) { 
		if(xmlHttp.status==200) {
			$('seo_result').innerHTML =  xmlHttp.responseText;
		}
	}	
}