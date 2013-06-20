function tianjia(obj)
{
    var Result = document.getElementById(obj).innerHTML.toLowerCase().replace(/<br\s*\/?>/ig,"\r\n"); 
    copyToClipboard(Result);
}
    
function  copyToClipboard(txt) {    
    if(window.clipboardData) {      
            window.clipboardData.setData("Text", txt);  
            window.alert('域名Whois查询结果已复制到剪切板上�?');  
    } 
    else if(navigator.userAgent.indexOf("Opera") != -1) {    
        window.location = txt;
    }
    else if (window.netscape) {    
        try {    
            netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");    
        }   
        catch (e){ 
    alert("被浏览器拒绝！\n请在浏览器地�?栏输�?'about:config'并回车\n然后�?'signed.applets.codebase_principal_support'设置�?'true'"); 
    }
var clip = Components.classes['@mozilla.org/widget/clipboard;1'].createInstance
    (Components.interfaces.nsIClipboard);    
        if (!clip)    
            return;    
        var trans = Components.classes

['@mozilla.org/widget/transferable;1'].createInstance
(Components.interfaces.nsITransferable);    
        if (!trans)    
            return;    
        trans.addDataFlavor('text/unicode');    
        var str = new Object();    
        var len = new Object();    
        var str = Components.classes["@mozilla.org/supports-string;1"].createInstance

(Components.interfaces.nsISupportsString);    
        var copytext = txt;    
        str.data = copytext;    
        trans.setTransferData("text/unicode",str,copytext.length*2);    
        var clipid = Components.interfaces.nsIClipboard;    
        if (!clip)    
            return false;    
        clip.setData(trans,null,clipid.kGlobalClipboard);    
        alert("域名Whois查询结果已复制到剪切板上�?")    
    }    
}  
function GetWhoisURL()
{
        var url = document.getElementById("Domain").value.toLowerCase();
        var DomainArr = new Array();
        url = url.replace("http://","");
        if(url.indexOf("www.")==0)
        {
        url = url.replace("www.","").split("/")[0];
        }
        else 
        {
        DomainArr = url.split("/")[0].split(".");
      
        if(DomainArr.length > 3)
        {
            url = url.replace((DomainArr[0]+"."),"");
        }
        url = DomainArr.join('.');
        }
        window.location='/'+url;
        document.getElementById("detail").style.display="block";
}
