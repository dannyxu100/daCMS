function getid(id) {
    return (typeof id == 'string') ? document.getElementById(id) : id
};
var getby = document.getElementsByClassName;
function attach(o, e, f) {
    if (document.attachEvent)
        o.attachEvent("on" + e, f);
    else if (document.addEventListener)
        o.addEventListener(e, f, false);
}
var currentInput = null;
var iswords = false;
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
        attach(tags[i], 'keyup', addInput);
        attach(tags[i], 'mouseout', BoxHide);
        attach(tags[i], 'mouseover', InputMouseOver);
    }
}