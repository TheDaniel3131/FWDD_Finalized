<?php
$target_dir = "assets/videos/Topic Related Videos/";
$target_file = $target_dir . basename($_FILES["relFile"]["name"]);

$target_desc = "";
$target_topic = "";

//print_r($target_file);
$uploadOk = 1;
$videoFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit2"])) 
{
  if($videoFileType =="mp4") 
  {
     //echo "The movie ",$videoFileType," is of video type.";
     $uploadOk = 1;
  } 
  else 
  {
     //echo "The movie ",$videoFileType," is not of video type.";
     $uploadOk = 0;
  }
}

if(isset($_POST['relDesc']))
{
  $target_desc = $_POST['relDesc'];
  //echo $_POST['relDesc'] . ", " . $target_desc;4
  //$target_file = $target_dir . $target_desc . ".mp4";
  $uploadOk = 1;
}
else
{
  $uploadOk = 0;
}

if(isset($_POST['hiddenRelTopic']))
{
  $target_topic = $_POST['hiddenRelTopic'];
  //echo $_POST['relDesc'] . ", " . $target_desc;4
  $target_file =  $target_dir . $target_topic . $target_desc . ".mp4";
  //print_r($target_file);
  $uploadOk = 1;
}
else
{
  //print_r("no hidden");
  $uploadOk = 0;
}

// Check if file already exists
if (file_exists($target_file)) {
  //echo "Sorry, file already exists.";
  $uploadOk = 0;
}

// Check file size
/*if ($_FILES["relFile"]["size"] > 500000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}*/

// Allow certain file formats
if($videoFileType != "mp4" ) {
  //echo "Sorry, only mp4 files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  //echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["relFile"]["tmp_name"], $target_file)) {
    //echo "The file ". htmlspecialchars( basename( $_FILES["relFile"]["name"])). " has been uploaded.";
    //print_r("Successfully uploaded.");
    echo '<script type="text/javascript">';
    echo ' alert("File has been uploaded"); ';  //not showing an alert box.
    //echo ' window.open("lesson-teacher.php"); '; //not showing an alert box.
    //echo 'history.back(); ';
    echo 'window.location=document.referrer;';
    echo '</script>';
    
  } else {
    //echo "Sorry, there was an error uploading your file.";
    //print_r("Fail to upload.");
    echo '<script type="text/javascript">';
    echo ' alert("There was an error uploading your file, please try again."); ';
    //echo ' window.open("lesson-teacher.php"); '; //not showing an alert box.
    //echo 'history.back(); ';
    echo 'window.location=document.referrer;';
    echo '</script>';
    //header("location:lesson-teacher.php");  
  }
}

//header("location:lesson-teacher.php");  

?>