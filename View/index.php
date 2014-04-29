		 <?php
			session_set_cookie_params(86400); 
			session_start(); 
			if(!isset($_SESSION['user_name'])) {
			   
				header('Location: login_page.php');
				exit(); 
			}
		   ?> 
		
		
		 <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
			 "http://www.w3.org/TR/html4/loose.dtd">
		 <html lang="en" >
		 <head>
			   <?php  require_once('./header.php'); ?>
		 <script language="javascript" type="text/javascript">
			var user_name = "<?php echo($_SESSION['user_name']); ?>";
			var user_place = "<?php echo($_SESSION['place'])?>";
		 </script>
		 <script src="../Controler/index_controler.js"></script>
		 <script src="../Library/localstorage.js"></script>
	
		  <link href="./indexstyle.css" rel="stylesheet" type="text/css">
			
			 <title>No Texting</title>
		 <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=no;" />
		 <meta name="MobileOptimized" content="width" />
		 <meta name="HandheldFriendly" content="true" />
		 <meta name="mobile-web-app-capable" content="yes">
		 <meta name="apple-mobile-web-app-capable" content="yes">
		 </head>
		 <body >
			 
			 <div data-role="page" id="pageone"  >
				 <div data-role="header" >
					<div data-role="navbar" class="navbar">
					<ul >
					
					<li  ><a href="#dialog_info"  data-rel="dialog" data-role="button" data-icon="info"  >Information</a></li> 
					 <li> <a id="logout" href="logout.php" data-role="button" 
						data-icon="back">Logut</a></li> 
					 <li> <a id="clearButton" href="#" data-role="button" 
						data-icon="grid">Clear</a></li> 
					   </ul>
					</div>
				 </div>
				 <div data-role="content" class="content" >
					 
					 <div class="ui-grid-a" id="ss" style="width:97%" >
					 <div class="ui-block-a"  data-theme="d"  ><button id="startButton"  style="margin-right:20px;width:90%" >START</button></div>
					 <div class="ui-block-b" data-theme="c" ><button id="stopButton" style="margin-left:15px;width:90%" >STOP</button></div>
					 </div>
					 <h1  id="timeElapsed" style="position:relative; left:38%">00:00:00</h1>
					 <div id="progressbar" style="width:97%;"></div>
					 <button class="my_class" id="undoButton" style=";width:97%;top:2%">UNDO</button>
					<!-- <p style="margin: auto">User visually manipulates data. </p> --> 
					 <div class="ui-grid-a" id="tn" style="position:relative;top:5%;width:97%">
					 <div class="ui-block-a" ><button   id="texting" style="width:91%;margin-right:20px; font-weight: bold">YES</button>
					 <p id="textCount" style="position:relative; left:46%; font-weight: bold;font-size:larger">0</p></div>
					 <div class="ui-block-b" ><button id="notexting" style="width:91%;margin-left:15px">NO</button>
					 <p id="notextCount"style="position:relative; left:46%; font-weight: bold; font-size: larger">0</p></div>
					 
					 </div>
					 
					<button class="my_class" id="save" style="position:relative; width: 97%;top:2%"">SAVE</button> 
				 </div>
				 
			 </div>
			 
			 <div data-role="page" id="dialog_info" style="height: 100%">
				  <div data-role="header" style="height:100%;margin-bottom:0">
					  <h1 style="font-size:15px">Information</h1>
				 </div>
				 <div data-role="content">
					 <p style="font-size:20px">So what you should look for ?</p>
					 <ul>
						<li>Drivers holding a phone in front of their face</li>
						<li>Thumbs or fingers moving on a phone</li>
						<li>Drivers looking down (as if there were a phone on their lap) for 2 or more seconds</li>
						<li>If you are not sure, press “no”</li>
					 </ul>
					 <p> For more information <a href="http://textcar.adamlech.info/Instructions" style="text-decoration: none">
					 Click Here.</a> </p>
				 </div>
				 <div data-role="footer">
					 <h1></h1>
				 </div>
			 </div>
			 
			 <div data-role="page" id="warning_info" style="height: 100%">
				  <div data-role="header" style="height:100%;margin-bottom:0">
					  <h1 style="font-size:15px">Error</h1>
				 </div>
				 <div data-role="content">
					 <p style="font-size:20px">You have to start timer, before counting cars !</p>
				 </div>
				 <div data-role="footer">
					 <h1></h1>
				 </div>
			  </div>
			 <div data-role="page" id="start_info" style="height: 100%">
				  <div data-role="header" style="height:100%;margin-bottom:0">
					  <h1 style="font-size:15px">Error</h1>
				 </div>
				 <div data-role="content">
					 <p style="font-size:20px">You have to start timer, before saving data!</p>
				 </div>
				 <div data-role="footer">
					 <h1></h1>
				 </div>
			 </div>
			 <div data-role="page" id="end_info" style="height: 100%">
				  <div data-role="header" style="height:100%;margin-bottom:0">
					  <h1 style="font-size:15px">Error</h1>
				 </div>
				 <div data-role="content">
					 <p style="font-size:20px">You have to stop timer, before saving data!</p>
				 </div>
				 <div data-role="footer">
					 <h1></h1>
				 </div>
			 </div>
				<div data-role="page" id="save_place" style="height: 100%">
				  
					<div data-role="content">
						<p style="font-size:16px">Enter description of your current place.</p>
					<input type="text" name="place" id="place_des" >
				 </div>
				 <div data-role="footer">
					 <!-- <div data-role="controlgroup" data-type="horizontal" style="display: block"> -->
					 <div class="ui-grid-a" align="center">
					 <div class="ui-block-a" ><a class="my_class" data-role="button" href='#' data-rel="back" style="width:70%; margin-left:0px; margin-right:5px" >Cancel</a></div>
					 <div class="ui-block-b"><a class="my_class" id="cont_btn" data-role="button" href="#" data-rel="dialog" style="width: 70%;margin-left:5px">Continue</a></div>
				   </div>
				 </div>
			 </div>
				
	 <div data-role="page" id="save_data">
		 <div data-role="header" >
			 <h1 style="font-size:20px;margin:1px">Please check the data first. <br>
			 TAP SEND IN ORDER TO SAVE.</h1>
			 <style >
				 span {
					 padding-left: 1em;
					 margin-left: 1em; 
				 }
				 
				
			 </style>
		 </div>
		 <div data-role="main" class="ui-content" >
			 <form method="post" action="../Data/save_data.php" name="saved_data">
				 <div class="ui-field-contain"  >
					 
					 <label for="pid">PID: <span id="pid_text" class="my_fin"></span></label> <input type="hidden" name="pid" value=""> 
					 <label for="date">Date: <span id="date_text" class="final"></span></label> <input type="hidden" name="date" value=""> 
					 <label for="start">Start time: <span id="start_text" class="final"></span></label> <input type="hidden" name="start" value="">
					 <label for="stop">End time: <span id="end_text" class="final"></span></label> <input type="hidden" name="end" value="">
					 <label for="text">Number of yes: <span id="text_text" class="final"></span></label> <input type="hidden" name="text" value="">
					 <label for="notext">Number of  no: <span id="notext_text" class="final"></span></label> <input type="hidden" name="notext" value="">
					 <label for="location">Location: <span id="place_text" class="final"></span></label> <input type="hidden" name="place" value="">
					  
				 </div>
				 <div class="ui-grid-a"  style="padding:0px" >
				  <div class="ui-block-a" > <input type="button" id="cancel_data" value="Cancel"></input></div>
				  <div class="ui-block-b"  > <input type="submit" id="send"  value="Send" ></input> </div>
				 </div>
			   </form>      
			</div>
				 
		 </div>
	  
		 </body>
		 </html>
