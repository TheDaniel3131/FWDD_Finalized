<?php
$db = mysqli_connect('localhost', 'root', '','MathKids');

if (!$db){
    die('Connection error: '.mysqli_connect_error());
}

if (isset($_POST['save'])){
    $Title = $_POST['Title'];
    $Page = $_POST['Page'];
        $query = "INSERT INTO lessons (LessonName, LessonDescription) VALUES ('$Title', '$Page')";
        $results = mysqli_query($db, $query);
        echo 'Registered Successfully!';
}
if ($_POST['Title'] != '' && $_POST['Page'] != ''){
    $Title = $_POST['Title'];
    $Page = $_POST['Page'];
    $Showquery = "SELECT LessonID FROM lessons WHERE LessonName = '$Title' AND LessonDescription = '$Page'";
    $data = mysqli_query ($db, $Showquery);
    if ($data) {
        $row = $data->fetch_assoc();
        if ($row) {
            $get = $row['LessonID'];
            if ($get != NULL){
                $Insertquery = "INSERT INTO relationship (RelateID, LessonID, BoardID, DiscussionID) VALUES (NULL,'$get',NULL,NULL)";
                $Insert = mysqli_query($db, $Insertquery);
                if ($Insert){
                    echo 'Relationship created!';
                } else {
                    echo 'Relationship not created!';
                }
            }
        } else {
            echo 'No matching record found in lessons.';
            exit();
        }
    } else {
        echo 'Error executing query: ' . mysqli_error($db);
        exit();
    }
}
else {
    echo 'There are no input received.';
}
exit();
?>