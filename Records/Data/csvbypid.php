<?php

  if(isset($_GET['pid']))
  {
   $pid = $_GET['pid']; 
   $filename = $_GET['pid'].'.csv';
      $link = mysql_connect('db512462049.db.1and1.com','XXXXXXXX','XXXXXXXX'); 
        if (!$link) { 
            die('Could not connect to MySQL: ' . mysql_error()); 
        }
       
       
          $db_select = mysql_select_db("db512462049",$link); 
                    if (!$db_select) { 
                          die("Database selection failed:: " . mysql_error()); 
                         } 
        $sel_stmt = "SELECT date,start,end,yes,no,place FROM car_records WHERE pid='".$pid."';"; 
        $result = mysql_query($sel_stmt, $link); 
        if(!$result) {
            die('Error: ' . mysql_error($link));
        }
        
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename='.$filename);
        header('Cache-Control: max-age=0');
        
        $out=fopen('php://output', 'w');
        $schema =array("Date","Start", "End","Yes","No","Place");
        fputcsv($out,$schema); 
        
        while($row=mysql_fetch_assoc($result))
        {
            fputcsv($out,$row);
            }
        fclose($out); 
    }
  
    else
    {
         echo "No pid."; 
     }
 
?>