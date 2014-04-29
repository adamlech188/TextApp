<?php
    $place = addslashes($_REQUEST['place']);
   
         $link = mysql_connect('db512462049.db.1and1.com','XXXXXX','XXXXXX'); 
        if (!$link) { 
            die('Could not connect to MySQL: ' . mysql_error()); 
        }
       
       
          $db_select = mysql_select_db("db512462049",$link); 
                    if (!$db_select) { 
                          die("Database selection failed:: " . mysql_error()); 
                         } 
        $sel_stmt = "INSERT INTO places value('".$place."');";
        $result = mysql_query($sel_stmt, $link); 
        if(!$result) {
            die('Error: ' . mysql_error($link));
            echo "There was an error while adding place to records!"; 
        }
        else {
            echo stripslashes($place); 
        }
?>