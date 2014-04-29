<html>
  <body >
    <?php
    $link = mysql_connect('db512462049.db.1and1.com','XXXXXXXX','XXXXXXXX'); 
        if (!$link) { 
            die('Could not connect to MySQL: ' . mysql_error()); 
        }
       
        echo 'Connection OK<br><br>'; 
          $db_select = mysql_select_db("db512462049",$link); 
                    if (!$db_select) { 
                          die("Database selection failed:: " . mysql_error()); 
                         }
        if($_POST["pid"] != '' ) {
        $ins_stmt = "INSERT INTO car_records VALUES('$_POST[pid]','$_POST[date]','$_POST[start]', '$_POST[end]','$_POST[text]','$_POST[notext]' , '$_POST[place]')";
        if(!mysql_query($ins_stmt, $link)) {
            die('Error: ' . mysql_error($link));
        }
       
        echo '1 record added<br><br>';
        }
        mysql_close($link);
    ?>
     <pre>
     PID:    <?echo $_POST["pid"]; ?> <br>
     Date:    <?echo $_POST["date"]; ?> <br>
     Start time:    <?echo $_POST["start"]; ?> <br>
     End time:    <?echo $_POST["end"]; ?> <br>
     Number of yes:    <?echo $_POST["text"]; ?> <br>
     Number of no:  <?echo $_POST["notext"]; ?> <br>
     Location: <?echo $_POST["place"]; ?>
    </pre>
     
    <script type="text/javascript">
        localStorage.clear(); 
        setTimeout(function() {document.location = "../View/logout.php"} ,2000); 
    </script> 
    
    </body>

   
</html>