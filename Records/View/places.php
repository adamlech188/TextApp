<?php
    session_start();
    if(!isset($_SESSION['username'])) {
	header("Location: login.php");
	exit(); 
	
    }
    

?> 

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">
<head>
    <title>Records</title>
	<meta name="author" content="Adam Lech" /> 
        <meta name="keyword" content = "Adam Lech"/> 
<link rel="stylesheet" type="text/css" href="./Style/recordsstyle.css" />
<script src="../Control/places_control.js" language="javascript" type="text/javascript"></script> 
    
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
         
	    <ul id="places">
            <?php
	       $index =0; 
               while($row= mysql_fetch_array($result)) {
		     
		    $place = $row['place'];
		    
		    echo '<li id="litem'.$index.'">'.$place.'<button onclick="removePlace(\''.addslashes($place).'\',\''.$index.'\')">Remove</button>'.'</li>'; 
		    ++$index;
		    
		      
		      
		     
               }
	    
	     
               mysql_close($link); 
            ?>
          </ul>
              
     <button id="newplbtn" onclick="addPlace()">Add new place</button>  
       

        </div>
    </div>
        
    
    
</body>
</html>
