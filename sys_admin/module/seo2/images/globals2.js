var AjaxLite = {
    Browser: {
        IE: !!(window.attachEvent && !window.opera),
        Opera: !!window.opera,
        WebKit: navigator.userAgent.indexOf('AppleWebKit/') > -1,
        Gecko: navigator.userAgent.indexOf('Gecko') > -1 && navigator.userAgent.indexOf('KHTML') == -1
    },
    IE: __getIE(),
    mode: {
        Post: "Post",
        Get: "Get"
    },
    getRequest: function() {
        if (window.XMLHttpRequest) {
            return new XMLHttpRequest()
        } else {
            try {
                return new ActiveXObject("MSXML2.XMLHTTP")
            } catch (e) {
                try {
                    return new ActiveXObject("Microsoft.XMLHTTP")
                } catch (e) {
                    return false
                }
            }
        }
    }
};
function __getIE() {
    if (window.ActiveXObject) {
        var v = navigator.userAgent.match(/MSIE ([^;]+)/)[1];
        return parseFloat(v.substring(0, v.indexOf(".")))
    }
    return false
};
Array.prototype.foreach = function(func) {
    if (func && this.length > 0) {
        for (var i = 0; i < this.length; i++) {
            func(this[i])
        }
    }
};
String.format = function() {
    if (arguments.length == 0) return null;
    var str = arguments[0];
    for (var i = 1; i < arguments.length; i++) {
        var regExp = new RegExp('\\{' + (i - 1) + '\\}', 'gm');
        str = str.replace(regExp, arguments[i])
    }
    return str
};
String.prototype.startWith = function(s) {
    return this.indexOf(s) == 0
};
String.prototype.startWith = function(s) {
    var d = this.length - s.length;
    return (d >= 0 && this.lastIndexOf(s) === d)
};
String.prototype.trim = function() {
    return this.replace(/(^\s*)|(\s*$)/g, '')
};
function getid(id) {
    return (typeof id == 'string') ? document.getElementById(id) : id
};

document.getElementsByClassName = function(name) {
    var tags = document.getElementsByTagName('*') || document.all;
    var els = [];
    for (var i = 0; i < tags.length; i++) {
        if (tags[i].className) {
            var cs = tags[i].className.split(' ');
            for (var j = 0; j < cs.length; j++) {
                if (name == cs[j]) {
                    els.push(tags[i]);
                    break
                }
            }
        }
    }
    return els
};
var getby = document.getElementsByClassName;
function Cookie() { }
Cookie.Save = function(n, v, mins, dn, path) {
    if (n) {
        if (!mins) mins = 365 * 24 * 60;
        if (!path) path = "/";
        var date = new Date();
        date.setTime(date.getTime() + (mins * 60 * 1000));
        var expires = "; expires=" + date.toGMTString();
        if (dn) dn = "domain=" + dn + "; ";
        document.cookie = name + "=" + value + expires + "; " + dn + "path=" + path
    }
};
Cookie.Del = function(n) {
    save(n, '', -1)
};
Cookie.Get = function(n) {
    var name = n + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') c = c.substring(1, c.length);
        if (c.indexOf(name) == 0) return c.substring(name.length, c.length)
    }
    return ""
};

function getcookie(name) {
    var cookie_start = document.cookie.indexOf(name);
    var cookie_end = document.cookie.indexOf(";", cookie_start);
    return cookie_start == -1 ? '' : unescape(document.cookie.substring(cookie_start + name.length + 1, (cookie_end > cookie_start ? cookie_end : document.cookie.length)));
}
function setcookie(cookieName, cookieValue) {
    var expires = new Date();
    var now = parseInt(expires.getTime());
    var et = (86400 - expires.getHours() * 3600 - expires.getMinutes() * 60 - expires.getSeconds());
    expires.setTime(now + 1000000 * (et - expires.getTimezoneOffset() * 60));
    document.cookie = escape(cookieName) + "=" + escape(cookieValue) + ";expires=" + expires.toGMTString() + "; path=/";
}
function getOffsetTop(el, p) {
    var _t = el.offsetTop;
    while (el = el.offsetParent) {
        if (el == p) break;
        _t += el.offsetTop
    }
    return _t
};
function getOffsetLeft(el, p) {
    var _l = el.offsetLeft;
    while (el = el.offsetParent) {
        if (el == p) break;
        _l += el.offsetLeft
    }
    return _l
};
function attach(o, e, f) {
    if (document.attachEvent)
        o.attachEvent("on" + e, f);
    else if (document.addEventListener)
        o.addEventListener(e, f, false);
}

//--------- menu ------------
var tt;
var curMenu;
function mouseover(th, menu) {
    if (tt) clearTimeout(tt);
    displayMenu(false);
    menu = document.getElementById('menu' + menu);
    menu.style.left = getOffsetLeft(th) + 'px';
    menu.style.top = getOffsetTop(th) + th.offsetHeight + 'px';
    curMenu = menu;
    displayMenu(true)
}
function mouseout() {
    tt = setTimeout('displayMenu(false)', 200)
}
function _mouseover() {
    if (tt) clearTimeout(tt);
    displayMenu(true)
}
function _mouseout() {
    displayMenu(false)
}
function displayMenu(display) {
    if (curMenu) {
        curMenu.style.display = display ? 'block' : 'none'
    }
}
//---------- utils  ------------
function Getfocus() {
    document.getElementById('ctl00_Main_Address').focus();
    document.getElementById('ctl00_Main_Address').select()
}

function gotourl(url, isopen) {
    if (isopen) {
        document.open(url);
    }
    else {
        document.location = url;
    }
}
function onget(newargid, argid,newargid2,argid2) {
    getid(newargid).value = getid(argid).value;
    if (newargid2) {
        getid(newargid2).value = getid(argid2).value;    
    }
    getid("__VIEWSTATE").disabled = true;
    var inputs = document.getElementsByTagName('input');
    SetDisabled(inputs);
    var textareas = document.getElementsByTagName('textarea');
    SetDisabled(textareas);
    var selects = document.getElementsByTagName('select');
    SetDisabled(selects);
    return true;
}
function SetDisabled(items) {
    for (var i = 0; i < items.length; i++) {
        if (items[i].getAttribute('isget') == 'false') {
            items[i].disabled = true;
        }
    }
}
//--------- ToolBox --------------
var currentInput = null;
var iswords = false;
function BoxShow(e) {
    var input = e;
    if (!input.id) {
        input = e.target ? e.target : e.srcElement;
    }
    if (iswords) {
        FillUrls("toolbox_words");
    }
    else {
        FillUrls("toolbox_urls");
    }
    var box = getid("ToolBox");
    if (box.style.display != 'none' && currentInput==input.id) {
        box.style.display = 'none';
        return;
    }
    currentInput = input.id;
    
    box.style.left = getOffsetLeft(input) + 'px';
    box.style.top = (getOffsetTop(input) + (input.offsetHeight - 1)) + 'px';
    box.style.width = (input.offsetWidth - 2) + 'px';
    box.style.display = 'block';
}

function BoxShowUrls(e) {
    iswords = false;
    BoxShow(e);
}
function InputSetValue(val) {
    var obj = getid(currentInput);
obj.value = val;
if(obj.getAttribute('url') == 'true'){
var tags = document.getElementsByTagName('input');
for (var i = 0; i < tags.length; i++) {
        if (tags[i].getAttribute('url') == 'true' && tags[i] != obj) {
            tags[i].value = val;
        }
    }
}
    BoxHide();
}
function BoxHide() {
    if (getid("ToolBox")) {
        getid("ToolBox").style.display = 'none';
    }
}
function InputMouseOver(e){
    var input = e.target ? e.target : e.srcElement;
    if (input) {
        input.focus();
        try{
        input.select();
        }
        catch(e){}
    }
}


function addInput(e) {
    var obj = e.target ? e.target : e.srcElement;
    if (obj.value.indexOf('¡£') > 0) {
        obj.value = obj.value.replace('¡£', '.');
    }
    var tags = document.getElementsByTagName('input');
    for (var i = 0; i < tags.length; i++) {
        if (tags[i].getAttribute('url') == 'true' && tags[i] != obj) {
            tags[i].value = obj.value;
        }
    }
}

function Init() {
    getid("ToolBox").style.display = 'none';
    var tags = document.getElementsByTagName('input');
    for (var i = 0; i < tags.length; i++) {
        if (tags[i].getAttribute('url') == 'true') {
            attach(tags[i], 'keyup', addInput);           
            attach(tags[i], 'mouseout', BoxHide);
           // attach(tags[i], 'keydown', BoxHide);
            attach(tags[i], 'mouseover', InputMouseOver);
            tags[i].setAttribute('autocomplete', 'off');
        }
        else if (tags[i].getAttribute('words') == 'true') {          
            //attach(tags[i], 'keydown', BoxHide);
            attach(tags[i], 'mouseover', InputMouseOver);
           // tags[i].setAttribute('autocomplete', 'off');
        }
    }
}