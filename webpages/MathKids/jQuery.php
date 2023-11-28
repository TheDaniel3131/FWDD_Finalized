<?php
error_reporting(E_ALL);
ini_set('display_errors', true);
//insertHistory('assets/videos/Topic 1 Addition/Recommended Videos/Math Primary 1_ Adding Three Numbers.mp4');
//  Rest of the PHP code

//echo getcwd();
//insertHistory("test");

if($_POST['action'] == 'insertHistory') {
  // call removeday() here
	insertHistory($_POST['path']);
}

if($_POST['action'] == 'insertWatched') {
  // call removeday() here
  insertWatched($_POST['path'], $_POST['time']);
}

if($_POST['action'] == 'read_history') {
  // call removeday() here
  readHistory();
}

if($_POST['action'] == 'read_watched') {
  // call removeday() here
  readWatched();
}

if($_POST['action'] == 'insertTopic') {
  // call removeday() here
  insertTopic($_POST['topic']);
}

if($_POST['action'] == 'insertRec') {
  // call removeday() here
  insertRec($_POST['path'], $_POST['desc']);
}


if($_POST['action'] == 'insertRel') {
  // call removeday() here
  insertRel($_POST['path'], $_POST['desc']);
}



function readHistory()
{
  $username = "temp"; //change to current username
  $filepath = "history". "/" . $username .".txt";

  //echo $filepath . "\n";;

  /*if (file_exists($filepath)) {
    echo "The file $filepath exists" . "\n";
  } else {
      echo "The file $filepath does not exist" . "\n";
  }

  if (is_writable($filepath)) {
    echo 'The file is writable' . "\n";
  } else {
      echo 'The file is not writable' . "\n";
  }*/

  $historylist = array();
  $h = 0;

  $myfile = fopen($filepath, "r") or die("Unable to open file!");

  while(! feof($myfile))  {
      $result = fgets($myfile);
      $result = str_replace("\n", '', "$result");

      if($result != null)
      {
        $historylist[$h] =  $result ;
        //echo $historylist[h];
        $h++;
      }
      
    }

  $reversedhistory = array_reverse($historylist);
  //$reversedhistory = $historylist;
  //echo json_encode($reversedhistory);
  echo json_encode($reversedhistory);

  fclose($myfile);

  //return $reversedhistory;
}

function readWatched()
{
  $username = "temp"; //change to current username
  $filepath = "watched". "/" . $username .".txt";

  //echo $filepath . "\n";;

  /*if (file_exists($filepath)) {
    echo "The file $filepath exists" . "\n";
  } else {
      echo "The file $filepath does not exist" . "\n";
  }

  if (is_writable($filepath)) {
    echo 'The file is writable' . "\n";
  } else {
      echo 'The file is not writable' . "\n";
  }*/

  $watchedlist = array();
  $w = 0;

  $myfile = fopen($filepath, "r") or die("Unable to open file!");

  while(! feof($myfile))  {
      $result = fgets($myfile);
      $result = str_replace("\n", '', "$result");

      if($result != null)
      {
        $watchedlist[$w] =  $result ;
        //echo $historylist[h];
        $w++;
      }
      
    }

  $reversedwatched = array_reverse($watchedlist);
  //$reversedhistory = $historylist;
  //echo json_encode($reversedhistory);
  echo json_encode($reversedwatched);

  fclose($myfile);

  //return $reversedhistory;
}



function insertHistory($path)
{
	$username = "temp"; //change to current username
	$filepath = "history". "/" . $username .".txt";

	//echo $path . "<br>";
	echo $filepath . "\n";;

	//echo substr(sprintf('%o', fileperms($filepath)), -4);
	//echo chmod($filepath, 0666);
	//echo chmod($filepath, 0777);
	//echo fileowner($filepath);
	//print_r(posix_getpwuid(fileowner($filepath)));

	if (file_exists($filepath)) {
    echo "The file $filepath exists" . "\n";
  } else {
      echo "The file $filepath does not exist" . "\n";
  }

	if (is_writable($filepath)) {
    echo 'The file is writable' . "\n";
  } else {
      echo 'The file is not writable' . "\n";
  }



  $myfile = fopen($filepath, 'a+') or die("Unable to open file!");

  /*$myfile = fopen($filepath, "r") or die("Unable to open file!");

  while(!feof($myfile))  {

    $result = fgets($myfile);

    echo "RESULT : " . $result . "\n";

    $str = str_replace("\n", '', $result); 
    
    if ($str == $path)
    {
        echo "DUP" . "\n";
        //$contents = str_replace($result."\n", '', $result);
    }
  }*/


  $contents = file_get_contents("$filepath");
  $newcontents = str_replace("$path"."\n", '', "$contents");
  file_put_contents("$filepath", "$newcontents");

  //echo "new content - " . $newcontents . "\n";

  $wit = fwrite($myfile, $path . "\n");

  if($wit){
    echo "it worked" . "\n";
  }
  else
  {
  	echo "doesn't worked." . "\n";
  }

  fclose($myfile);
}

function insertWatched($path, $time)
{
  $username = "temp"; //change to current username
  $filepath = "watched". "/" . $username .".txt";

  echo $filepath . "\n";;

  if (file_exists($filepath)) {
    echo "The file $filepath exists" . "\n";
  } else {
      echo "The file $filepath does not exist" . "\n";
  }

  if (is_writable($filepath)) {
    echo 'The file is writable' . "\n";
  } else {
      echo 'The file is not writable' . "\n";
  }

  $myfile = fopen($filepath, 'a+') or die("Unable to open file!");

  while(! feof($myfile))  {
    $result = fgets($myfile);

    print_r($result);

     if($result != null)
      {
         if (str_contains($result, $path)) {

           //$newcontents = str_replace("$result"."\n", '', "$myfile");
           echo "result contains " . $result . "\n";
           $contents = file_get_contents("$filepath");
           $newcontents = str_replace("$result", '', "$contents");

           echo "newcontents " . $newcontents . "\n";

           file_put_contents("$filepath", "$newcontents");
           //file_put_contents("$filepath", "$newcontents");
           break;
         }
      }
   
  }


  $wit = fwrite($myfile, $path . "#t=". $time ."\n");

  if($wit){
    echo "it worked" . "\n";
  }
  else
  {
    echo "doesn't worked." . "\n";
  }

  fclose($myfile);
}

//TEACHER

function insertTopic($topic)
{

  $filepath = "assets/videos/Topics.txt";

  echo $filepath . "\n";;


  if (file_exists($filepath)) {
    echo "The file $filepath exists" . "\n";
  } else {
      echo "The file $filepath does not exist" . "\n";
  }

  if (is_writable($filepath)) {
    echo 'The file is writable' . "\n";
  } else {
      echo 'The file is not writable' . "\n";
  }


  $myfile = fopen($filepath, 'a+') or die("Unable to open file!");


  $wit = fwrite($myfile, $topic . "\n");

  if($wit){
    echo "it worked" . "\n";
  }
  else
  {
    echo "doesn't worked." . "\n";
  }

  fclose($myfile);
}

/*function insertRec($path, $desc)
{

  // Store the path of source file
  $source = $path; 
    
  // Store the path of destination file
  $destination = 'assets/videos/Recommended Videos/' . $desc; 
    
  if( !copy($source, $destination) ) { 
      echo "File can't be copied! \n"; 
  } 
  else { 
      echo "File has been copied! \n"; 
  } 
  
}*/


?>