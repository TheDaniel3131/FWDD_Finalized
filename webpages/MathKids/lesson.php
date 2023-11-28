<?php
include("nav_afterlogin.php");
?>
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

//$historylist = readHistory();

$historylist = array();
$h = 0;

$watchedlist = array();
$w = 0;

$username = "temp"; //change to current username
$filepath =  $gfg_folderpath . "/Topics.txt";

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
      <p class="header4">Recommended Videos</p>  
      <div class="w3-content w3-display-container" style="max-width:420px">

        <?php	
        	if(!empty($recvids[$i]))
        	{ //function_alert("NOT EMPTY ! " . $i);
          for ($j=0;$j<sizeof($recvids[$i]);$j++){
        ?>
        <video id="<?php echo 'vid'.$j; ?>" class="mySlides <?php echo 'mySlides'.$i; ?>" onpause="onPause('<?php echo $recvids_path[$i][$j]; ?>');" controls>
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
      <p class="header4">Topic Related Videos

      	
		        <a href="#" class="<?php echo 'viewall'.$i; ?> viewall" onclick="toggleCollapsible(<?php echo $i?>);" >View All >></a></p>

        <div>
          <div class="container">
            <div class="row">
            	<?php	
		        	if(!empty($relvids[$i]))
		        	{ //function_alert("EMPTY ! " . $i);
		        ?>
              <div class="col-lg-4 col-sm-12">
                <div class="info-item">
					
        	
                  <video class="relatedVids" width="320" height="240" onpause="onPause('<?php echo $relvids_path[$i][0]; ?>');"  controls>
                    <source src="<?php echo $relvids_path[$i][0]; ?>" type=video/mp4>

                  </video>
                    <!--p><?php //echo $relvids[$i][0]; ?></p-->
                    <p><?php echo str_replace(".mp4", "", $relvids[$i][0]); ?></p>
                </div>
              </div>
              <div class="col-lg-4 col-sm-12">
                <div class="info-item">
                  <video class="relatedVids" width="320" height="240" onpause="onPause('<?php echo $relvids_path[$i][1]; ?>');"  controls>
                    <source src="<?php echo $relvids_path[$i][1]; ?>" type=video/mp4>
                  </video>
                  <!--p><?php //echo $relvids[$i][1]; ?></p-->
                    <p><?php echo str_replace(".mp4", "", $relvids[$i][1]); ?></p>
                </div>
              </div>
              <div class="col-lg-4 col-sm-12">
                <div class="info-item">
                  <video class="relatedVids" width="320" height="240" onpause="onPause('<?php echo $relvids_path[$i][2]; ?>');"  controls>
                    <source src="<?php echo $relvids_path[$i][2]; ?>" type=video/mp4>
                  </video>
                  <!--p><?php //echo $relvids[$i][2]; ?></p-->
                    <p><?php echo str_replace(".mp4", "", $relvids[$i][2]); ?></p>
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
                      <video class="relatedVids" width="320" height="240" onpause="onPause('<?php echo $relvids_path[$i][$vidCount]; ?>');" controls>
                        <source src="<?php echo $relvids_path[$i][$vidCount]; ?>" type=video/mp4>

                      </video>
                      <!--p><?php //echo $relvids[$i][$vidCount]; ?></p-->
                    <p><?php echo str_replace(".mp4", "", $relvids[$i][$vidCount]); ?></p>
                    </div>
                  </div>  <?php $vidCount++; } } ?>
                </div>
                    <?php } }?>
           
          </div>
        </div>

    </div>
  </div> <?php } fclose($myfile);?>

  <a href="#" class="float" id="watchedBtn">Cont. Watching</a>
  <a href="#" class="float2" id="historyBtn">History</a>

    <!-- The Modal -->
	<div id="historyModal" class="modal">

	  <!-- Modal content -->
	   <div class="modal-content">
			<div class="modal-header">
				<h4 style="color: white;">Your<em> History </em></h4>
				<span class="close" id="historyclose">&times;</span>
			</div>

			<div class="modal-body">
				<div class="container" id="historyContent">


				</div>
			</div>

		</div>

	</div>

	    <!-- The Modal -->
	<div id="watchedModal" class="modal">

	  <!-- Modal content -->
	   <div class="modal-content">
			<div class="modal-header">
				<h4 style="color: white;">Continue<em> Watching </em> Here !</h4>
				<span class="close" id="watchedclose">&times;</span>
			</div>

			<div class="modal-body">
				<div class="container" id="watchedContent">


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
  <script src="assets/js/wow.js"></script>
  <script src="assets/js/tabs.js"></script>
  <script src="assets/js/popup.js"></script>
  <script src="assets/js/custom.js"></script>


  <script>

      var recContent = document.getElementsByClassName("recContent");
      var relContent = document.getElementsByClassName("relContent");
      var changeText = document.getElementsByClassName("viewall");
      var mySlides = document.getElementsByClassName("mySlides");
      var relatedVids = document.getElementsByClassName("relatedVids");
      let videos = document.getElementsByTagName("video");
      var currentVideo, currentVideo2;
      var historylist = new Array();
      var watchedlist = new Array();
      var watchedtime = new Array();

      for (var x = 0; x < videos.length; x++) {

      	if ( videos[x].currentSrc == "" ) {
      		videos[x].setAttribute("poster", "assets/images/no-video.png");
		}
	

	  // add an event listening for errors
	  /*videos[x].addEventListener('error', function(e) {

	  	console.log("check " + videos[x].currentSrc + " ; error " + e);
	    
	    // if the error is caused by the video not loading
	    if (this.networkState > 2) {
	      alert("error");
	      // add an image with the message "video not found"
	      this.setAttribute("poster", "http://dummyimage.com/312x175/000/fff.jpg&text=Video+Not+Found");
	    }
	  }, true);*/

	}


      function onPause(path)
      {
        //detect path
        //console.log(currentVideo + "     " + path);

         for (i = 0; i < videos.length; i++) {
          let res = videos[i].currentSrc.replace(/%20/g, " ");
          res = res.replace("http://localhost/MathKids/", "");

          //console.log(res + "     " + path);

          if(res == path)
          {
            //console.log("same");

            
            	var currentTime = videos[i].currentTime;
            	var duration = videos[i].duration;
            	var diff = duration - currentTime;
            	//console.log(currentTime + ", " + duration + ", " + diff);

            	if(currentTime > 10)
            	{
					       if(diff < 10) //history
	            	{
	            		if(currentVideo != path)
	            		{		
      							myAjax(path);
      							//alert("call insert");
      							currentVideo = path;
      	         }
	            	}
	            	else //watched
	            	{
	            		//if(currentVideo2 != path)
	            		{		
    							myAjax2(path , currentTime);
    							//alert("call insert");
    							currentVideo2 = path;
	            		}
	            	}
            	}
            	

            	
          }
          else
          {
            videos[i].pause();
          }
         
        }

        
        //store path into txt file
      }

      function myAjax(path) {
      $.ajax({
           type: "POST",
           url: 'jQuery.php',
           data:{action:'insertHistory', path : path},
           success:function(html) {
            //alert(html);
           }

      });
	}

	  function myAjax2(path, time) {
      $.ajax({
           type: "POST",
           url: 'jQuery.php',
           data:{action:'insertWatched', path : path, time : time},
           success:function(html) {
            //alert(html);
           }

      });
	}


     
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


        // Get the modal
    var modal = document.getElementById("historyModal");
    var modal2 = document.getElementById("watchedModal");

    // Get the button that opens the modal
    var btn = document.getElementById("historyBtn");
    var btn2 = document.getElementById("watchedBtn");

    // Get the <span> element that closes the modal
    //var span = document.getElementsByClassName("close")[0];
    var span = document.getElementById("historyclose");
	var span2 = document.getElementById("watchedclose");

    // When the user clicks the button, open the modal 
    btn.onclick = function() {
      readHistory();
      modal.style.display = "block";
    }

    btn2.onclick = function() {
      readWatched();
      modal2.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
      modal.style.display = "none";
    }

    span2.onclick = function() {
      modal2.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }

       if (event.target == modal2) {
        modal2.style.display = "none";
      }
    }

    let arr;

    function readHistory() {
      $.ajax({
           type: "POST",
           url: 'jQuery.php',
           data:{action:'read_history'},
           dataType:"JSON",
           success:function(html) {
            //alert(html);
            //document.getElementById("test").innerHTML = html;
            let arr = html.toString();
            historylist = [];
            historylist.length = 0;
            historylist = arr.split(',');
			//console.log(historylist);

			const myNode = document.getElementById("historyContent");
  			myNode.textContent = '';

			for (var k=0; k<historylist.length;k++)
			{
			    var appendLoop =       
			          	'<div class="row">' +
			          		
			            	'<div class="col-lg-6">' +
			            	'<div class="row">' +
				            	'<div class="col-lg-2">' + '</div>' +
				            	'<div class="col-lg-8">' +
				            		'<video class="historyVideo" width="320" height="240">' +
				                    '<source src="' + historylist[k] + '#t=30 " type=video/mp4>' +
				                  '</video>' +
				                '</div>' +
				                '<div class="col-lg-2">' +'</div>' +
			            	'</div>' +
			              '</div>' +
			            	'<div class="col-lg-6">' +
			            		'<br/><br/><br/><p>Rewatch this :</p>' +
			            		'<a href="#" onclick="openFullscreen(this);" name="'+historylist[k]+'">' + historylist[k].substring(historylist[k].indexOf("[")).replace(".mp4", "") + '</a>' +
			            	'</div>' +
			            '</div>';

			          $("#historyContent").append(appendLoop);
			}

           }

      });
	}

	function readWatched() {
      $.ajax({
           type: "POST",
           url: 'jQuery.php',
           data:{action:'read_watched'},
           dataType:"JSON",
           success:function(html) {
            //alert(html);
            //document.getElementById("test").innerHTML = html;
            let arr = html.toString();
            watchedlist = [];
            watchedlist.length = 0;
            watchedtime = [];
            watchedtime.length = 0;
            watchedlist = arr.split(',');
			//console.log(watchedlist);

			const myNode = document.getElementById("watchedContent");
  			myNode.textContent = '';

			for (var k=0; k<watchedlist.length;k++)
			{
				var split = watchedlist[k].split("#");
				watchedtime[k] = split[1];
				//console.log(split);
			    var appendLoop =       
			          	'<div class="row">' +
			          		
			            	'<div class="col-lg-6">' +
			            	'<div class="row">' +
				            	'<div class="col-lg-2">' + '</div>' +
				            	'<div class="col-lg-8">' +
				            		'<video class="watchedVideo" width="320" height="240">' +
				                    '<source src="' + watchedlist[k] +'" type=video/mp4>' +
				                  '</video>' +
				                '</div>' +
				                '<div class="col-lg-2">' +'</div>' +
			            	'</div>' +
			              '</div>' +
			            	'<div class="col-lg-6">' +
			            		'<br/><br/><br/><p>Continue watching this :</p>' +
			            		'<a href="#" onclick="openFullscreen(this);" name="'+ watchedlist[k] +'">' + split[0].substring(split[0].indexOf("[")).replace(".mp4", "") + '</a>' +
			            	'</div>' +
			            '</div>';

			          $("#watchedContent").append(appendLoop);
			}

           }

      });
	}

	var delay = ( function() {
    var timer = 0;
    return function(callback, ms) {
	        clearTimeout (timer);
	        timer = setTimeout(callback, ms);
	    };
	})();


	function openFullscreen(element) {

	var name = element.getAttribute("name");
	var elem = name.split("#t=");
	//console.log("SPLIT " + elem);
	

	for (var i = 0; i < videos.length ; i++) {

		//console.log(videos[i].currentSrc + "][" + elem);
		let res = videos[i].currentSrc.replace(/%20/g, " ");
        res = res.replace("http://localhost/MathKids/", "");
		//console.log(res);

		if (res == elem[0]) {
			//console.log("FOUND." + res + "," + elem);
			modal.style.display = "none";
			modal2.style.display = "none";
			//console.log(videos[i].getAttribute("class").includes("mySlides"));
			//mySlides, relatedvids
			

			const after_ = res.charAt(res.indexOf(']') - 1) - 1;
			//console.log("SLICE" + after_);
			toggleDivs(after_);

			if (videos[i].getAttribute("class").includes("mySlides")) {
				//showDivs(after_, );
				
				let slideInd = videos[i].id;
				slideInd = slideInd.replace("vid", "");
				slideInd = parseInt(slideInd) + 1;
				//alert("includes !"  + after_ + ", " + slideInd);
				currentDiv(after_, slideInd);
			}

			if(elem.length == 2)
			{
				videos[i].currentTime = elem[1];
			}

			delay(function(){
			    // do stuff
			    //console.log("VIDEO" + videos[i].currentSrc);
				if (videos[i].requestFullscreen) {
			    videos[i].requestFullscreen();
			  } else if (videos[i].webkitRequestFullscreen) { /* Safari */
			    videos[i].webkitRequestFullscreen();
			  } else if (videos[i].msRequestFullscreen) { /* IE11 */
			    videos[i].msRequestFullscreen();
			  }

			}, 1000 );
			
			
			//videos[i].play();
			
			  break;
		}
	}
	  
 
	}

   /* $(function() {

	  // optional: don't cache ajax to force the content to be fresh
	  $.ajaxSetup({
	    cache: false
	  });

	  // specify the server/url you want to load data from
	  var url = "history/temp.txt";
	  // on click, load the data dynamically into the #demo div
	  // while loading, show three dots (…)
	  $(btn).click(function() {
	    $(modal).html("…").load(url);
	    alert("history clicked");
	  });

	});*/
    </script>

  </body>

</html>
