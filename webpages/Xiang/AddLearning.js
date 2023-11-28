//View Selected Text
var t = '';
function SelectedText(e){
    if (window.getSelection){
        t = window.getSelection().toString();
    }
    else if (document.selection && document.selection.type != "Control") {
        document.selection.createRange().text;
    }

    var textarea = document.querySelector('.textAREA');
    textarea.textContent = t;

    var input = document.getElementById('input');
    input.value = t;
}
document.onmouseup = SelectedText;

//Change text to header in html format
function HeadCall(){
    if (t !== ""){
        $("#Insert").each(function(){
            var original = document.querySelector('.textAREA');
            var originalTEXT = original.value;
            var replaced = originalTEXT.replace(t, '<h1>' + t + '</h1>');
            original.value = replaced;
        })
    }
    else {
        window.alert("Please insert an value!");
    }
}

//Change text to hyperlink in html format
function HyperCall(){
    if (t !== ""){
        $("#Insert").each(function(){
            var original = document.querySelector('.textAREA');
            var originalTEXT = original.value;
            var replaced = originalTEXT.replace(t, "<a href=\"" + t + "\">" + t +"</a>");
            original.value = replaced;
        })
    }
    else {
        window.alert("Please insert an value!");
    }
}

//Change text to bold in html format
function Bold(){
    if (t !== ""){
        $("#Insert").each(function(){
            var original = document.querySelector('.textAREA');
            var originalTEXT = original.value;
            var replaced = originalTEXT.replace(t, "<b>" + t +"</b>");
            original.value = replaced;
        })
    }
    else {
        window.alert("Please insert an value!");
    }
}

function Italic(){
    if (t !== ""){
        $("#Insert").each(function(){
            var original = document.querySelector('.textAREA');
            var originalTEXT = original.value;
            var replaced = originalTEXT.replace(t, "<i>" + t +"</i>");
            original.value = replaced;
        })
    }
    else {
        window.alert("Please insert an value!");
    }
}

function InsertCall(){
    var x = document.getElementById("Insert");
    if (x != null){
        var Select = x.value;
        var replaceText = Select.replace(/\n/g, '<br/>')
        var AddArticle = "<article>" + replaceText + "</article>";
        document.getElementById("content").innerHTML = AddArticle;
        x.value = "";
    }
    else {
        window.alert("Please insert an value!");
    }
}