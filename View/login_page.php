    <?php
        session_start();
        
        if(isset($_POST['submit'])) {
          $user_name = htmlspecialchars(trim($_POST['uid_r'])); 
          $password =  htmlspecialchars(trim($_POST['pwd_r']));
          $place = htmlspecialchars(trim($_POST['place']));
          $user_nameErr = "";
          $passwordErr = "";
          $loginErr = ""; 
          if(!$user_name) {
                $user_nameErr ="Please enter username."; 
          }
          if(!$password) {
                $passwordErr = "Please enter password."; 
          }
         
        
          if($user_name && $password && $place != "Select Place") {
                 $salt1 = "&*^%";
                 $salt2 = "*#))(*)"; 
                 $password = md5($salt1.$password.$salt2);
                 
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
                $sel_stmt = "SELECT user_password FROM passwords WHERE user_password='".$password."';";
                $resultPwd = mysql_query($sel_stmt, $link); 
                if(!$resultPwd) {
                    die('Error: ' . mysql_error($link));
                }
                $sel_stmt = "SELECT pid FROM collectors WHERE pid='".$user_name."';";
                $resultUsr = mysql_query($sel_stmt);
                 if(!$resultUsr) {
                    die('Error: ' . mysql_error($link));
                }
                
                if(mysql_num_rows($resultPwd)>0 && mysql_num_rows($resultUsr)>0) {
                    
                    $_SESSION['user_name'] = $user_name; 
                    $_SESSION['place'] = $place; 
                    header('Location: index.php'); 
                }

                else {
                  $loginErr = "Password is not valid.";
                  echo $loginErr; 
                }
            }
           }
      
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
    
    
    <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
        "http://www.w3.org/TR/html4/loose.dtd">
    <html lang="en">
    <head>
    
        <link rel="stylesheet" href="../Library/jquery.mobile-1.4.1.css">
        <script src="../Library/jquery-1.11.0.js"></script>
        <script src="../Library/jquery.mobile-1.4.1.js"></script>
     
     
        <title>Login page</title>
        
        <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=no;" />
        <meta name="MobileOptimized" content="width" />
        <meta name="HandheldFriendly" content="true" />
        <meta name="mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-capable" content="yes">
    <style>
        .ui-header .ui-title {
         margin-right: 10%;
          margin-left: 10%;
        }
    </style>
    <script language="javascript" type="text/javascript">
        $(document).on("pageinit", "#page_one", function() {
            
                $("#login").on("tap", function() {
                   
                    if (document.getElementById("place").value=="Select Place") {
                        alert("Select place before loggin in!"); 
                     }
                    }); 
        });
    </script>
    </head>
    <title>TO TEXT OR NOT TO TEXT?</title>
    <body>
    <div data-role="page" id="page_one">  
    <div  data-role="header" >  
    <h2>TO TEXT OR NOT TO TEXT?</>  
    </div>  
    <div align="center" data-role="content" id="Div2" name="contentConfirmation">  
    <h1>  
    Login Page</h1>  
    <h2>  
    </h2>  
    <form data-ajax="false" id="Form1" method="POST" action="<?php echo htmlspecialchars(($_SERVER['PHP_SELF'])); ?>">  
    <div data-role="fieldcontain">  
    <label for="url">Username:*</label>  
     <input class="required" id="Text1" name="uid_r" type="text" value="">            
    </div>  
    <div data-role="fieldcontain">  
    <label for="url">Password:*</label>  
              <input id="Password1" name="pwd_r" type="password" value="">
    </div>
    
    <div data-role="fieldcontain">
  
         <select name="place" id="place" >
            <option > Select Place</option>
             <?php
                while($row = mysql_fetch_row($result)) {
                    echo '<option value="'.$row[0].'">'.$row[0].'</option>'; 
                }
             ?>
         </select>
            </div>  
    
 
 <button id="login" data-theme="a" type="submit" style="background:#585858; color: white" name="submit">Login</button>  
           
   
     
    </form>  
    </div>  
    </div>

    </body>
    </html>
