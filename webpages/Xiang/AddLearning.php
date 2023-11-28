<?php
include ("nav_afterlogin.php")
?>
<!DOCTYPE html>

    <head>
        <link href="AddLearning.css" rel="stylesheet" type="text/css">
        <link href="AddLearning.php" rel="stylesheet" type="text/php">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="AddLearning.js"></script>
        <title>AddLearning | MathKids</title>
        <script>
            $(document).ready(function(){
    $('#Submit').click(function(e){
        e.preventDefault();
        var Learningtitle = $('#Title').val();
        var divdata = document.getElementById("content");
        var ContentLearning = divdata.innerHTML.trim();
        if (Learningtitle !== "" && ContentLearning !== ""){
        $.ajax({
            url: 'Lessonadd.php',
            type: 'post',
            data: {
                'save' : 1,
                'Title' : Learningtitle,
                'Page' : ContentLearning,
            },
            success: function(response) {
                console.log(response);
                window.alert("Lesson added successfully.");
                divdata.innerHTML = "";
                var titleremove = document.querySelector('.Title');
                titleremove.textContent = "";
            },
            error: function(xhr, status, error){
                console.log(response);
            }
        })
        }
        else {
            window.alert("Please enter value for title and content!");
        }
    })
}) 
    </script>
    </head>
    <body>
        <div class="Middle">
            <form class="form">
                <label>Lesson Name:</label><input type="text" class="Title" id="Title" name="Title">
                <label>
                    Content:
                </label>
                <div class="textarea" id="content">
                    
                </div>
                <label>Insert text here:</label>
                <div>
                    <label>Text Selected: </label><input type= 'text' id ='input' />
                </div>
                    <div class="buttonstore">
                        <button type="button" class="Bold" id="BOLD" onclick="Bold()">Bold</button>
                        <button type="button" class="Header" id="Headercall" onclick="HeadCall()">Heading</button>
                        <button type="button" class="Link" id="HYPER" onclick="HyperCall()">HyperLink</button>
                        <button type="button" class="Italic" id="ITALIC" onclick="Italic()">Italic</button>
                    </div>
                <textarea class="textAREA" id="Insert" name="Page">

                </textarea>
                <button type="button" id="InsertPara" onclick="InsertCall()">
                    Insert
                </button>
                <button type="button" id="Submit">
                    Submit
                </button>
            </form>
        </div>
    </body>
</html>