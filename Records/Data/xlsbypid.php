<?php
    if(isset($_GET['pid'])) {
    
              $link = mysql_connect('db512462049.db.1and1.com','XXXXXXXX','XXXXXXXX'); 
        if (!$link) { 
            die('Could not connect to MySQL: ' . mysql_error()); 
        }
       
       
          $db_select = mysql_select_db("db512462049",$link); 
                    if (!$db_select) { 
                          die("Database selection failed:: " . mysql_error()); 
                         } 
        $sel_stmt = "SELECT date,start,end,yes,no,place FROM car_records WHERE pid='".$_GET['pid']."';"; 
        $result = mysql_query($sel_stmt, $link); 
        if(!$result) {
            die('Error: ' . mysql_error($link));
        }
        header("Content-type: application/msexcel; charset=utf-8");
        header("Content-Disposition: attachment; Filename=".$_GET['pid'].".xls");
      
        echo "<html>"; 
        echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">";
        echo "<body>";
       
        echo "Date\t Start \t End\t Yes \t No \t Location \t \n";
        
    
        while($row=mysql_fetch_array($result)) {
            
            echo '\t'.$row['date'].'\t'.$row['start'].
            '\t'.$row['end'].'\t'.$row['yes'].'\t'.$row['no'].'\t'.$row['place'].'\t'."\n"; 
        }
       
       
        echo "</body>";
        echo "</html>"; 
    }
    else {
        echo "No pid is set"; 
    }
?>
