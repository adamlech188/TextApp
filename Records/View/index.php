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
<script src="../Control/index_control.js" language="javascript" type="text/javascript"></script>
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
        $sel_stmt = "SELECT  pid FROM collectors";
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
         
           <dl>
            <?php
			/*
			  echo '<dt>' .$pid['pid'].'<button class="csvbtn" onclick="removeUser('.trim('\''.$pid['pid'].'\'').')">'.
		      'Remove'.'</button>'.'<a href="../Data/csvbypid.php?pid='
		      .$pid['pid'].'">'.'<button class="csvbtn">'.'Save as CSV file'.'</button>'
		      .'</a>'.'</dt>';
			*/
		
               while($pid= mysql_fetch_array($result)) {
		      echo '<div  id="remove'.$pid['pid'].'">'; 
		      echo '<dt>' .$pid['pid'].'<button class="csvbtn" onclick="removeUser(\''.trim($pid['pid']).'\')">'.
		      'Remove'.'</button>'.'<a href="../Data/csvbypid.php?pid='.$pid['pid'].'">'.'<button class="csvbtn">'.'Save as CSV file'.'</button>'
		      .'</a>'.'</dt>';
		      ++$index;
		        $tmp_stmt = "SELECT date,start,end,yes,no,place FROM
		      car_records WHERE pid='".$pid['pid']."';";
		      $tmp_result = mysql_query($tmp_stmt, $link);
		      if(mysql_num_rows($tmp_result)>0) { 
			    echo '<dd>'.'<table>';
			    echo '<tr>'; 
			    echo '<th class="date" >Date</th><th class="start" >Start</th><th class="end">End</th>'; 
			    echo '<th class="texters">Yes</th><th class="nontexters">No</th>'; 
			    echo '<th class="location">Location</th>'; 
			    echo '</tr>'; 
			  	     
			     while($record = mysql_fetch_array($tmp_result)) {
				 echo '<tr>'; 
				 echo '<td class="date">' . $record['date'] . '</td>';
				 echo '<td class="start">' . $record['start'] . '</td>'; 
				 echo '<td class="end">' . $record['end'] . '</td>';
				 echo '<td class="texters">' . $record['yes'] . '</td>';
				 echo '<td class="notexters">' . $record['no'] . '</td>';
				 echo '<td class="location" >' . $record['place'] . '</td>';
				 echo '</tr>'; 
			     }
			 echo '</table>'.'</dd>';
			 }
			 echo '</div>'; 
		    }
		     mysql_close($link); 
            ?>
            </dl>
            <div id="adduser" >
	     <input type="button" value="Add new collector" id="adduserbtn" onclick="addUser()">
	    </div>
       

        </div>
    </div>
        
    
    
</body>
</html>
