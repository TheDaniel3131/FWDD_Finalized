var column = document.getElementsByClassName("collapsible");
var content = document.getElementsByClassName("Content");
var QRCode = document.getElementsByClassName("QR");
var Exercises = document.getElementsByClassName("Exercise");
var Edits = document.getElementsByClassName("Edit");
var Updates = document.getElementsByClassName("Submit");
var discuss = document.getElementsByClassName("Discuss");

function CallContent(n){
    var DataCollect = localStorage.getItem("role");
    console.log("Clicked index:", n);
    for (var j = 0; j < column.length; j++) {
        column[j].classList.remove("active");
        content[j].style.display = "none";
        QRCode[j].style.display = "none";
        Exercises[j].style.display = "none";
        Edits[j].style.display = "none";
        discuss[j].style.display = "none";
    }
    column[n].classList.add("active");
    content[n].style.display = "block";
    Exercises[n].style.display = "block";
    QRCode[n].style.display = "block";
    discuss[n].style.display = "block";
    if (DataCollect === "Teacher"){
        Edits[n].style.display = "block";
    }
}

function ShowMore(){
    var text = document.getElementById("ButtonText");
    text.textContent = ">";
    var text1 = document.getElementById("Text");
    var text2 = document.getElementById("Hmm");
    var computedStyle = window.getComputedStyle(text1);

    if (computedStyle.display === "none") {
        text1.style.display = "block";
        text2.style.width = "150px";
    } else {
        text1.style.display = "none";
        text2.style.width = "50px";
    }
}

function ExercisePage(m){
    localStorage.setItem('lessons',m);
    window.alert("LessonID saved into local");
    window.location = "../Oscar/exercisePage.php";
}

function Edit(j) {
    content[j].contentEditable = true;
    Edits[j].style.display = "none";
    Updates[j].style.display = "block";
}

function Discusssion(r){
    localStorage.setItem('lessons',r);
    window.alert("LessonID saved into local");
    window.location = "../Daniel/discussion.php";
}