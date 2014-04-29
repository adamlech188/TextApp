    <?php
     $link = mysql_connect('db512462049.db.1and1.com','XXXXXXXX','XXXXXXXX'); 
        if (!$link) { 
            die('Could not connect to MySQL: ' . mysql_error()); 
        }
       
       
          $db_select = mysql_select_db("db512462049",$link); 
                    if (!$db_select) { 
                          die("Database selection failed:: " . mysql_error()); 
                         }
        $current = md5($_REQUEST['current']);
        $new = md5($_REQUEST['new']);
        
        $sel_stmt = "SELECT admin_password FROM passwords WHERE admin_password='".$current."';";
         $result = mysql_query($sel_stmt, $link); 
        if(!$result) {
            die('Error: ' . mysql_error($link));
        }
        if(mysql_num_rows($result)>0) {
            
            $change_stmt = "UPDATE passwords SET admin_password='".$new."' WHERE admin_password='".$current."';";
             $change = mysql_query($change_stmt, $link); 
            if(!$change) {
                 die('Error: ' . mysql_error($link));
             }
              $ver_stmt = "SELECT admin_password FROM passwords WHERE admin_password='".$new."';";
              $ver = mysql_query($ver_stmt, $link);
             if(!$ver) {
                 die('Error: ' . mysql_error($link));
             }
             if(mysql_num_rows($ver)>0)  {
                echo '<p style="color:green"> You have successfully changed your password.</p>'; 
             }
             else {
                echo "<p> You did not change your password.</p>"; 
             }
         
        }
        else {
            //echo $current;
            echo "Incorrect password."; 
            
        }
      ?>
      