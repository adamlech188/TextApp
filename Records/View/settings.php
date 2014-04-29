<?php
    session_start();
    if(!isset($_SESSION['username'])) {
	header("Location: login.php");
	exit(); 
	
    }
    

?> 

     <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">
<head>
    <title>Records</title>
	<meta name="author" content="Adam Lech" /> 
        <meta name="keyword" content = "Adam Lech"/> 
<link rel="stylesheet" type="text/css" href="./Style/recordsstyle.css" />
<link rel="stylesheet" type="text/css" href="./Style/settingstyle.css" />
<script src="../Control/settings_control.js" language="javascript" type="text/javascript"></script>
    
</head>
    <?php
     $link = mysql_connect('db512462049.db.1and1.com','XXXXXXXX','XXXXXXXX'); 
        if (!$link) { 
            die('Could not connect to MySQL: ' . mysql_error()); 
        }
       
       
          $db_select = mysql_select_db("db512462049",$link); 
                    if (!$db_select) { 
                          die("Database selection failed:: " . mysql_error()); 
                         } 
        $sel_stmt = "SELECT place FROM places";
        $result = mysql_query($sel_stmt, $link); 
        if(!$result) {
            die('Error: ' . mysql_error($link));
        }
       
        
       
    ?>

<body>
    <div id="doc">
 
    <div id="topnavig">
        
      <ul>
       <li class="options" ><a href="index.php">Records</a></li>
       <li  class="options"><a href="places.php">Places</a></li>
       <li  class="options"><a href="settings.php">Settings</a></li>
       <li id="logout"><a href="logout.php">Logout</a></li>
       </ul>
    </div>
      <div id="main">
         <p class="users">Administrator password</p>
	 <div class="userpw">
	 <form >
	    <label for="currentad">Current Password<span class="star">*</span></label>
	    <input type="password" id="currentad"> <br>
	    <label for="newad">New Password<span class="star">*</span></label>
	    <input type="password" id ="newad"> <br>
	    <label for="confirmad">Confirm new Password<span class="star">*</span></label>
	    <input type="password" id="confirmad">
	    <div class="lower">
		  <div id="adresponse">
		   </div>
		<input id="changead" type="button" value="Change Password" name="login" onclick="changeAdPass()">
		    
	    </div>
	 </form>
	 </div>
	 <p class="users">Mobile user password</p>
	 	 <div class="userpw">
	 <form >
	    <label for="currentmb">Current Password<span class="star">*</span></label>
	    <input type="password" id="currentmb"> <br>
	    <label for="newmb">New Password<span class="star">*</span></label>
	    <input type="password" id ="newmb"> <br>
	    <label for="confirmmb">Confirm new Password<span class="star">*</span></label>
	    <input type="password" id="confirmmb">
	    <div class="lower" style="margin-bottom: 30px">
		<div id="mbresponse">
			
		    </div>
		  <input id="changemb" type="button" value="Change Password" name="login" onclick="changeUserPass()">
		     
	    </div>
	    
	 </form>
	 </div>
	 
        </div>
    </div>
        
    
    
</body>
</html>
