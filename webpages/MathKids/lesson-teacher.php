<?php
//require "jQuery.php";

$gfg_folderpath = "assets/videos";
$gfg_rec = "Recommended Videos";
$gfg_rel = "Topic Related Videos";
$topics = array();
$topics_count = array();
$topics_count2 = array();
$recvids = array(array());
$relvids = array(array());
$recvids_path = array(array());
$relvids_path = array(array());


$username = "temp"; //change to current username
$filepath =  $gfg_folderpath . "/Topics.txt";
$h = 0;
$myfile = fopen($filepath, "r") or die("Unable to open file!");
//$historylist = readHistory($filepath, $myfile);
//echo fread($myfile,filesize($filepath));

while(! feof($myfile))  {
    $result = fgets($myfile);

     if($result != null)
      {
         $topics[$h] = $result;
         $topics_count[$h] = 0;
         $topics_count2[$h] = 0;

         for($i = 0 ; $i < 3 ; $i++)
         {
          $recvids[$h][$i] = "No Video";
          $recvids_path[$h][$i] = "";
          $relvids[$h][$i] = "-No Video-";
          $relvids_path[$h][$i] = "";
         }
	       $h++;
      }
   
  }

function function_alert($message) {
      
    // Display the alert box 
    echo "<script>alert('$message');</script>";
}


// CHECKING WHETHER PATH IS A DIRECTORY OR NOT
if (is_dir($gfg_folderpath)) {
    // GETTING INTO DIRECTORY
    $files = opendir($gfg_folderpath); {
        // CHECKING FOR SMOOTH OPENING OF DIRECTORY
        if ($files) {

           //$i = 0;                
          //READING NAMES OF EACH FILE INSIDE SUBFOLDERS
          while (($gfg_subfolder2 = readdir($files)) !== FALSE) 
          {
            if ($gfg_subfolder2 != '.' && $gfg_subfolder2 != '..') 
            {

               $dirpath2 = $gfg_folderpath . "/" . $gfg_subfolder2 . "/";
               //function_alert($dirpath2);

                // GETTING INSIDE EACH SUBFOLDERS
                if (is_dir($dirpath2)) 
                {
                    $file2 = opendir($dirpath2); 
                    {

                    
                      if ($file2) 
                      {
                         $j = 0; //rec vids index
                         $k = 0; //rel vids index

                         //function_alert("Topics" . $topics);
                         //function_alert("Topics count rec" . $topics_count);
                         //function_alert("Topics count rel" . $topics_count2);

                         //print_r(array_values($topics));
                         //print_r(array_keys($topics_count));
                         //print_r(array_keys($topics_count2));

                        //READING NAMES OF EACH FILE INSIDE SUBFOLDERS
                        
                        while (($gfg_filename = readdir($file2)) !== FALSE) 
                        {

                          if ($gfg_filename != '.' && $gfg_filename != '..') 
                          {

                          	//function_alert("FILE NAME : " . $gfg_filename);

                            if ($gfg_subfolder2 == $gfg_rec) {	

                            	for ($i=0; $i < sizeof($topics); $i++) {

                            		$currentTopic = "Topic" . ($i+1);
                            		//function_alert("Current Topic : " . $currentTopic);

                            		if (str_contains($gfg_filename, $currentTopic)) {	
                            			//function_alert("before :" . $i . " - " . $topics_count[$i] . " = " . $gfg_filename);
                            			$count = $topics_count[$i];
                            			$recvids[$i][$count] = $gfg_filename;
			                            $recvids_path[$i][$count] = $dirpath2 . $gfg_filename;

			                            $topics_count[$i]++;

			                            //function_alert("Recvids : " . $recvids[$i][$topics_count[$i]]);
			                            //function_alert("Path : " . $recvids_path[$i][$topics_count[$i]]);
			                            //function_alert("count : " . $topics_count[$i]);
                            		}
                            	}
                             
                            }
                            else if ($gfg_subfolder2 == $gfg_rel) {	

                            	for ($i=0; $i < sizeof($topics); $i++) {

                            		$currentTopic = "Topic" . ($i+1);
                            		//function_alert($currentTopic);

                            		if (str_contains($gfg_filename, $currentTopic)) {	

                            			$count2 = $topics_count2[$i];
                            			$relvids[$i][$count2] = $gfg_filename;
			                            $relvids_path[$i][$count2] = $dirpath2 . $gfg_filename;

			                            $topics_count2[$i]++;

			                            //function_alert($relvids[$i][$topics_count2[$i]]);
			                            //function_alert($relvids_path[$i][$topics_count2[$i]]);
			                            //function_alert($topics_count2[$i]);
                            		}
                            	}
                             
                            }
							
                              
                              
                          }
                         }
                      }
                    }
                }
            }
            //
           }
                    
            
                
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <title>MathKids</title>

    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-woox-travel.css">
    <link rel="stylesheet" href="assets/css/owl.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" href="assets/css/nav.css">
    <link rel="stylesheet"href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>

  </head>

<body>

  <!-- ***** Preloader Start ***** -->
  <div id="js-preloader" class="js-preloader">
    <div class="preloader-inner">
      <span class="dot"></span>
      <div class="dots">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
  </div>
  <!-- ***** Preloader End ***** -->

  <!-- ***** Header Area Start ***** -->
  <header class="header-area header-sticky">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                    <!-- ***** Logo Start ***** -->
                    <a href="index.php" class="logo">
                        <img src="assets/images/logo-1.png" alt="MathKids">
                    </a>
                    <!-- ***** Logo End ***** -->
                    <!-- ***** Menu Start ***** -->
                    <ul class="nav">
                        <li><a href="index.php">Home</a></li>
                        <li class="dropdown">
                          <a href="#">Learning</a>
                          <div class="dropdown-content">
                            <ul>
                              <li><a href="lesson.html">Lesson</a></li>
                              <li><a href="lesson-teacher.php" class="active">Video</a></li>
                              <li><a href="course.html">Course</a></li>
                              <li><a href="background.html">Background</a></li>
                            </ul>
                          </div>
                        </li>   
                        <li><a href="about.php">About Us</a></li>
                        <li><a href="faq.php">FAQ</a></li>
                        <li><a href="contact.php">Contact Us</a></li>
                    </ul>   
                    <a class='menu-trigger'>
                        <span>Menu</span>
                    </a>
                    <!-- ***** Menu End ***** -->
                </nav>
            </div>
        </div>
    </div>
  </header>
  <!-- ***** Header Area End ***** -->


  <div class="sidenav">

    <?php
      for ($i=0;$i<sizeof($topics);$i++){
    ?>
    <a href="#" class="topicList" onclick="toggleDivs(<?php echo $i ?>);"><?php echo $topics[$i]; ?><i class="fa fa-arrow-right" aria-hidden="true" style="float: right; padding-top: 5px;"></i></a> <?php } ?>
  </div>

<?php
      for ($i=0;$i<sizeof($topics);$i++){
    ?>
  <div class="main myTopics">
    <div class="recContent" id="<?php echo 'recContent'.$i; ?>">
      <p class="header4">Recommended Videos<a href="#" class="addvideo addRecBtn bluebtn2" id="<?php echo 'addRecBtn'.$i; ?>" onclick="openRecModal(<?php echo $i ?>);">Add Video</a></p>  
      <div class="w3-content w3-display-container" style="max-width:420px">

        <?php	
        	if(!empty($recvids[$i]))
        	{ //function_alert("NOT EMPTY ! " . $i);
          for ($j=0;$j<sizeof($recvids[$i]);$j++){
        ?>
        <video id="<?php echo 'vid'.$j; ?>" class="mySlides <?php echo 'mySlides'.$i; ?>" controls>
          <source src="<?php echo $recvids_path[$i][$j]; ?>" type=video/mp4>
        </video><?php } ?>
      
        <div class="w3-center w3-container w3-section w3-large w3-text-white w3-display-bottommiddle" style="width:400px">

          <button class="w3-button w3-gray w3-display-left" onclick="plusDivs(<?php echo $i?>, -1)">&#10094;</button>
          <button class="w3-button w3-gray w3-display-right" onclick="plusDivs(<?php echo $i?>, 1)">&#10095;</button>

           <?php
        	
          for ($j=0;$j<sizeof($recvids[$i]);$j++){
        	?>
          <span class="w3-badge <?php echo 'demo'.$i; ?> w3-border w3-gray w3-hover-white" onclick="currentDiv(<?php echo $i?>, $j+1)"></span><?php } ?>
          
        </div><?php } ?>
      </div>
    </div>

    <div>
      <p class="header4">Topic Related Videos &nbsp
          <a href="#" class="<?php echo 'viewall'.$i; ?> viewallt" onclick="toggleCollapsible(<?php echo $i?>);" >View All >></a>&nbsp&nbsp&nbsp&nbsp&nbsp
		      <a href="#" class="addvideo addRelBtn bluebtn2" id="<?php echo 'addRelBtn'.$i; ?>" onclick="openRelModal(<?php echo $i ?>);">Add Video</a>&nbsp&nbsp&nbsp&nbsp&nbsp
        </p>
        <div>
          <div class="container">
            <div class="row">
            	<?php	
		        	if(!empty($relvids[$i]))
		        	{ //function_alert("EMPTY ! " . $i);
		        ?>
              <div class="col-lg-4 col-sm-12">
                <div class="info-item">
                  <video class="relatedVids" width="320" height="240" controls>
                    <source src="<?php echo $relvids_path[$i][0]; ?>" type=video/mp4>
                  </video>
                  <p><?php echo $relvids[$i][0]; ?></p>
                </div>
              </div>
              <div class="col-lg-4 col-sm-12">
                <div class="info-item">
                  <video class="relatedVids" width="320" height="240" controls>
                    <source src="<?php echo $relvids_path[$i][1]; ?>" type=video/mp4>
                  </video>
                  <p><?php echo $relvids[$i][1]; ?></p>
                </div>
              </div>
              <div class="col-lg-4 col-sm-12">
                <div class="info-item">
                  <video class="relatedVids" width="320" height="240" controls>
                    <source src="<?php echo $relvids_path[$i][2]; ?>" type=video/mp4>
                  </video>
                  <p><?php echo $relvids[$i][2]; ?></p>
                </div>
              </div>
              <?php } ?>
            </div>
          </div>

          <div class="container relContent" id="<?php echo 'relContent'.$i; ?>">

            <?php
            	if(!empty($relvids[$i]))
		        { 
              $rowCount = sizeof($relvids[$i]) / 3 ;
              $rowCount = ceil($rowCount) - 1;

              //function_alert($rowCount);

              $vidCount = 3;
              
              for ($j=0;$j<$rowCount;$j++){ ?>
            
              <div class="row">

                <?php

                  for ($k=0;$k<3;$k++)
                  {

                    if($vidCount != (sizeof($relvids[$i]))) {

                      //function_alert("SIZE : " . (sizeof($relvids[$i])-1) . " VIDCOUNT : " . $vidCount);
                    ?>

                  <div class="col-lg-4 col-sm-12">
                    <div class="info-item">
                      <video class="relatedVids" width="320" height="240" controls>
                        <source src="<?php echo $relvids_path[$i][$vidCount]; ?>" type=video/mp4>

                      </video>
                      <p><?php echo $relvids[$i][$vidCount]; ?></p>
                    </div>
                  </div>  <?php $vidCount++; } } ?>
                </div>
                    <?php } }?>
           
          </div>
        </div>

    </div>
  </div> <?php } fclose($myfile);?>

 <a href="#" class="float2" id="addTopicBtn">Add Topic</a>

    <!-- The Modal -->
<div id="addTopicModal" class="modal" >

  <!-- Modal content -->
  <div class="modal-content" style="width: 50%; margin-left: 25%; margin-right: 25%">
    <div class="modal-header">
      <h4 style="color: white;">Add a <em>New Topic</em> here !</h4>
      <span class="close" id="close">&times;</span>   
    </div>

    <div class="modal-body">
          <div class="">
            <div class="">
              <form name="insertTopicForm">
                <div class="">
                  <div class="">
                      <fieldset>
                          <h5> Title : </h5><br/>
                          <label for="desc" class="form-label">Topic <?php echo sizeof($topics)+1; ?> -</label>
                          <input id="topicTitle" type="text" name="desc" class="topicInput rounded" placeholder="New Topic..." required>
                      </fieldset>
                  </div>
                </div>
                <div class="modal-footer">
                   <a class="bluebtn" type="button" onclick="insertTopic(<?php echo sizeof($topics)+1; ?>)" >Add</a>
                </div>
              </form>
            </div>
          </div>
    </div>

  </div>
</div>

  <!-- The Modal -->
<div id="addRecModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content"  style="width: 50%; margin-left: 25%; margin-right: 25%;">
    <div class="modal-header">
      <h4 style="color: white;">Upload a New<em> Recommended Video</em> here !</h4>
      <span class="close" id="recclose">&times;</span>   
    </div>

    <div class="modal-body">
          <div class="">
            <div class="">
              <form name="insertRecForm" method="post" enctype="multipart/form-data" action="recUpload.php" onsubmit="alertSubmit();">
                <div class="">
                  <div class="">
                    <h5 id="recTopicCount"></h5><br/>
                      <fieldset>
                          <label for="file" class="form-label">Select Video :</label><br/>
                          <input id="recFile" type="file" name="recFile" class="file" required accept="video/*">
                          <input type="text" name="hiddenRecTopic" id="hiddenRecTopic" hidden>
                      </fieldset>
                  </div>
                  <br/>
                  <!--div class="">
                      <fieldset>
                          <label for="desc" class="form-label">Description</label><br/>
                          <textarea id="recdesc" type="textarea" name="recDesc" class="desc rounded" placeholder="Video description..." required rows="3" cols="50"></textarea>
                      </fieldset>
                  </div-->
                </div>

                 <div class="modal-footer">
                  <input type="submit" class="bluebtn" value="Upload Video" name="submit">
                </div>
              </form>
            </div>
          </div>
    </div>

   

  </div>
</div>

  <!-- The Modal -->
<div id="addRelModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content"  style="width: 50%; margin-left: 25%; margin-right: 25%;">
    <div class="modal-header">
      <h4 style="color: white;">Upload a New<em> Topic Related Video</em> here !</h4>
      <span class="close" id="relclose">&times;</span>   
    </div>

    <div class="modal-body">
          <div class="">
            <div class="">
              <form name="insertRelForm" method="post" enctype="multipart/form-data" action="relUpload.php" onsubmit="alertSubmit();">
                <div class="">
                  <div class="">
                    <h5 id="relTopicCount"></h5><br/>
                      <fieldset>
                          <label for="file" class="form-label">Select Video :</label><br/>
                          <input id="relFile" type="file" name="relFile" class="file" required accept="video/*">
                          <input type="text" name="hiddenRelTopic" id="hiddenRelTopic" hidden>
                      </fieldset>
                  </div>
                  <br/>
                  <div class="">
                      <fieldset>
                          <label for="desc" class="form-label">Description</label><br/>
                          <textarea id="reldesc" type="textarea" name="relDesc" class="desc rounded" placeholder="Video description..." required rows="3" cols="50"></textarea>
                      </fieldset>
                  </div>
                </div>

                 <div class="modal-footer">
                  <input type="submit" class="bluebtn" value="Upload Video" name="submit2">
                </div>
              </form>
            </div>
          </div>
    </div>
  </div>
</div>
  <footer class="footer">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <p>
            <i class="fa fa-phone">  +03 XXX XXXX</i> &nbsp &nbsp &nbsp
            <i class="fa fa-envelope">  mathkids@help.com</i>
          </p>
        </div>
      </div>
    </div>
  </footer>

  <!-- Scripts -->
  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

  <script src="assets/js/isotope.min.js"></script>
  <script src="assets/js/owl-carousel.js"></script>
  <!--script src="assets/js/wow.js"></script-->
  <script src="assets/js/tabs.js"></script>
  <script src="assets/js/popup.js"></script>
  <script src="assets/js/custom.js"></script>


  <script>

      var recContent = document.getElementsByClassName("recContent");
      var relContent = document.getElementsByClassName("relContent");
      var changeText = document.getElementsByClassName("viewallt");
      var mySlides = document.getElementsByClassName("mySlides");
      var relatedVids = document.getElementsByClassName("relatedVids");
      let videos = document.getElementsByTagName("video");
      var currentVideo, currentVideo2;

      // Get the modal
      var modal = document.getElementById("addTopicModal");
      var recmodal = document.getElementById("addRecModal");
      var relmodal = document.getElementById("addRelModal");

      // Get the button that opens the modal
      var btn = document.getElementById("addTopicBtn");
      var recbtn = document.getElementsByClassName("addRecBtn");
      var relbtn = document.getElementsByClassName("addRelBtn");

      // Get the <span> element that closes the modal
      //var span = document.getElementsByClassName("close")[0];
      var span = document.getElementById("close");
      var recspan = document.getElementById("recclose");
      var relspan = document.getElementById("relclose");


      for (var x = 0; x < videos.length; x++) {

      	if ( videos[x].currentSrc == "" ) {
      		videos[x].setAttribute("poster", "assets/images/no-video.png");
		}

	}

  function insertTopic(count)
  {
    var topic = document.getElementById("topicTitle").value;
    var newTopic = "Topic " + count + " - " + topic;

    if (topic.length <= 5) {
      alert("Title too short or cannot be empty!");
    }
    else
    {
      ajax1(newTopic);
    }

    
  }

  function alertSubmit()
  {
    //alert("Form submitted !");
  }

  /*function insertRec(count)
  {
    var file = document.getElementById("recFile");
    var desc =  document.getElementById("recDesc").value;
    //[Topic X] .....mp4
    var newVideo = "[Topic " + count + "] " + desc;
    var path = "";

    alert(file.value);

    if (desc.length <= 5) {
      alert("Description too short or cannot be empty!");
    }
    else if (file.files.length == 0)
    {
      alert("You have not selected any video !");
    }
    else
    {

      //ajax2(path, newVideo);
    }
  }*/

  function openRecModal(count)
  {
    var topiccount = document.getElementById("recTopicCount");
    topiccount.innerHTML = "[ Topic " + (count+1) + " ]";
    var hiddenRecTop = document.getElementById("hiddenRecTopic");
    hiddenRecTop.value = "[Topic" + (count+1) + "] ";

    //document.getElementById('recUpload').setAttribute('onclick','insertRec('+count+')');

    recmodal.style.display = "block";
  }

   function openRelModal(count)
  {
    var topiccount = document.getElementById("relTopicCount");
    topiccount.innerHTML = "[ Topic " + (count+1) + " ]";
    var hiddenRelTop = document.getElementById("hiddenRelTopic");
    hiddenRelTop.value = "[Topic" + (count+1) + "] ";

    //document.getElementById('recUpload').setAttribute('onclick','insertRec('+count+')');

    relmodal.style.display = "block";
  }


      function ajax1(topic) {
      $.ajax({
           type: "POST",
           url: 'jQuery.php',
           data:{action:'insertTopic', topic : topic},
           success:function(html) {
            alert("Topic added successfully !");
            location.reload();
           }

      });
	}

	 /* function myAjax2(path, desc) {
      $.ajax({
           type: "POST",
           url: 'jQuery.php',
           data:{action:'insertRec', path : path, desc : desc},
           success:function(html) {
            alert(html);
            alert("Video added successfully !");
            location.reload();
           }

      });
	}*/


     
    function bannerSwitcher() {
      next = $('.sec-1-input').filter(':checked').next('.sec-1-input');
      if (next.length) next.prop('checked', true);
      else $('.sec-1-input').first().prop('checked', true);
    }

    var bannerTimer = setInterval(bannerSwitcher, 5000);

    $('nav .controls label').click(function() {
      clearInterval(bannerTimer);
      bannerTimer = setInterval(bannerSwitcher, 5000)
    });

    //Slideshow
    var slideIndex = 1;
    showDivs(0, slideIndex);
    toggleDivs(0);

    function plusDivs(i, n) {
      showDivs(i, slideIndex += n);
    }

    function currentDiv(i, n) {
      showDivs(i, slideIndex = n);
    }

    function showDivs(count, n) {
      var i;
      var x = document.getElementsByClassName("mySlides"+count);

      var dots = document.getElementsByClassName("demo"+count);
      if (n > x.length) {slideIndex = 1}
      if (n < 1) {slideIndex = x.length}

      for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";  
      }
      for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" w3-gray", "");
      }

      x[slideIndex-1].style.display = "block";  
      dots[slideIndex-1].className += " w3-gray";

      //console.log("mySlides length : " + x.length);
      //console.log("dots length : " + dots.length);
      //console.log("n : " + n, "count : " + count);
      //console.log("slide index : " + slideIndex);
    }

    function toggleDivs(n) {

      //alert(n);
      for (i = 0; i < relContent.length; i++) 
      {
        relContent[i].style.maxHeight = 0;
        recContent[i].style.maxHeight = "400px";
        changeText[i].textContent = "View All >>";
      }

      //console.log(recContent[n].style.maxHeight);
      //console.log(relContent[n].style.maxHeight);
      //console.log(recContent[n].scrollHeight);
      //console.log(relContent[n].scrollHeight);

      slideIndex = 1;
      showDivs(n, slideIndex);

      var i;
      var x = document.getElementsByClassName("myTopics");
      var list = document.getElementsByClassName("topicList");

      for (i = 0; i < x.length; i++) {
        x[i].style.display = "none"; 
        list[i].style.backgroundColor = '#E5E4E2';
      }
      
      x[n].style.display = "block";  
      list[n].style.backgroundColor = '#D3D3D3';
    }
      
    
    function toggleCollapsible(n)
    {
        //console.log("REC :" + recContent[n].style.maxHeight);
        //console.log("REL :" + relContent[n].style.maxHeight);

        if (relContent[n].style.maxHeight == "4000px") {
          relContent[n].style.maxHeight = 0;
          recContent[n].style.maxHeight = "400px";
          changeText[n].textContent = "View All >>";

        }
        else
        {
          recContent[n].style.maxHeight = 0;
          relContent[n].style.maxHeight = "4000px";
          changeText[n].textContent = "Collapse <<";
        }

        //console.log("REC :" + recContent[n].style.maxHeight);
        //console.log("REL :" + relContent[n].style.maxHeight);

    }

	var delay = ( function() {
    var timer = 0;
    return function(callback, ms) {
	        clearTimeout (timer);
	        timer = setTimeout(callback, ms);
	    };
	})();


   

    // When the user clicks the button, open the modal 
    btn.onclick = function() {
      modal.style.display = "block";
    }

    /*for (var c = 0 ; c < recbtn.length ; c++)
    {
        recbtn[c].onclick = function() {
          recmodal.style.display = "block";
          //alert();
        }
    }

    for (var c = 0 ; c < relbtn.length ; c++)
    {
        relbtn[c].onclick = function() {
          relmodal.style.display = "block";
        }
    }*/
    

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
      modal.style.display = "none";
    }

    recspan.onclick = function() {
      recmodal.style.display = "none";
    }

    relspan.onclick = function() {
      relmodal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }

      if (event.target == recmodal) {
        recmodal.style.display = "none";
      }

      if (event.target == relmodal) {
        relmodal.style.display = "none";
      }
    }
    </script>

  </body>

</html>
