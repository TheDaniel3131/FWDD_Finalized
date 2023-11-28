<?php
include ("nav_afterlogin.php")
?>
<?php
$db = mysqli_connect('localhost','root','','MathKids');

$query = "SELECT * FROM lessons";
$data = mysqli_query ($db, $query);

$rows = [];
while ($row = $data->fetch_assoc()) {
    $rows[] = $row;
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <link href="Learning.css" rel="stylesheet" type="text/css">
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Learning Page | MathKids</title>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="Learning.js" ></script>
        <script>
            $(document).ready(function(){
                var DataCollected = localStorage.getItem("role");
                var Choose = document.getElementById("AddLink");
                var Choose1 = document.getElementById("ButtonText");
                if (DataCollected === "student"){
                    Choose.style.display = "none";
                    Choose1.style.display = "none";
                } else if (DataCollected === "teacher");
                else {
                    Choose.style.display = "none";
                }
            })
            
        </script>
    </head>
    <body>
        <div class="ShowLinkButton" id="Hmm">
            <button id="ButtonText" onclick="ShowMore()"><</button>
            <button class="hiddenText" id="Text" onclick="window.location.href='AddLearning.php';">Add Page</button>
        </div>
        <button id="AddLink" class="LinkButton" onclick = "window.location.href='AddLearning.php';">Add Page</button>
        <div id="Content-box">
            <div class="left-choice">
                <?php foreach ($rows as $index => $row) { ?>
                    <button class="collapsible" onclick="CallContent(<?php echo $index; ?>)"><?php echo $row['LessonName']; ?></button>
                <?php } ?>
            </div>
            <div class="container"> 
            <?php foreach($rows as $row) { ?>
                <div class="Content" id="Content"><h1 class="LessonName"><?php echo $row['LessonName']; ?></h1> <br> <?php echo $row['LessonDescription']; ?></div>
            <?php } ?>
            <div class="ButtonGroup">
            <?php foreach ($rows as $index => $row) { ?>
                <button class="Exercise" onclick="ExercisePage(<?php echo $index + 1; ?>)">Exercise</button>
            <?php } ?>
            <?php foreach ($rows as $index => $row) { ?>
                <button class="Discuss" onclick="Discussion(<?php echo $index + 1; ?>)">Discussion</button>
            <?php } ?>
            <?php foreach ($rows as $index => $row) { ?>
                <button class="Edit" onclick="Edit(<?php echo $index; ?>)">Edit</button>
            <?php } ?>
            <?php foreach ($rows as $index => $row) { ?>
                <button class="Submit" onclick="Submit(<?php echo $index; ?>)">Submit</button>
            <?php } ?>
            </div>
            <script>
                var content = document.getElementsByClassName("Content");
                var Updates = document.getElementsByClassName("Submit");
                var Lesson = document.getElementsByClassName("LessonName");
                var Edits = document.getElementsByClassName("Edit");
                function Submit(g) {
                    var lessonName = content[g].getElementsByTagName('h1')[0].innerHTML;
                    var updatedLessonDescription = '<article>' + content[g].getElementsByTagName('article')[0].innerHTML + '</article>';
                    $.ajax({
                        url: 'Learning.php',
                        type: 'post',
                        data: {
                            lessonName: lessonName,
                            updatedLessonDescription: updatedLessonDescription
                        },
                        success: function(response) {
                            console.log('Success:', response);
                        },
                        error: function(xhr, status, error) {
                            console.error('Error:', status, error);
                        }
                    })
                    Updates[g].style.display = "none";
                    Edits[g].style.display = "block";
                }
            </script>
            <?php 
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $lessonName = $_POST['lessonName'];
                    $updatedLessonDescription = $_POST['updatedLessonDescription'];

                    $db = mysqli_connect('localhost', 'root', '', 'MathKids');

                    if (!$db) {
                        $response = array('status' => 'error', 'message' => 'Database connection error');
                        header('Content-Type: application/json');
                        echo json_encode($response);
                        exit;
                    }

                    $lessonName = mysqli_real_escape_string($db, $lessonName);
                    $updatedLessonDescription = mysqli_real_escape_string($db, $updatedLessonDescription);

                    $updateQuery = "UPDATE lessons SET LessonDescription = '$updatedLessonDescription' WHERE LessonName = '$lessonName'";
                    $result = mysqli_query($db, $updateQuery);

                    if ($result) {
                        $response = array('status' => 'success', 'message' => 'Data updated successfully');
                    } else {
                        $response = array('status' => 'error', 'message' => 'Error updating data');
                    }

                    mysqli_close($db);

                    header('Content-Type: application/json');
                    echo json_encode($response);
                    exit;
                }
            ?>
            <?php foreach($rows as $row) { ?>
            <?php 
            $title = $row["LessonName"];
            $lessonPage = $row["LessonDescription"];

            $qrCodeText = "Title: $title\nLessonPage: $lessonPage\n";

            $qrCodeURL = 'https://quickchart.io/qr?text=' . urlencode($qrCodeText);
            ?>
            <img src="<?php echo $qrCodeURL;?>" alt="QR Code" class="QR">
            <?php } ?>
            </div>
        </div>
    </body>
</html>
