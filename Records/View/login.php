
<?php
	//Login procedure
    session_start();
    
    if(isset($_POST['login']))
    {
	$username = htmlspecialchars(trim($_POST['username']));
	$password = htmlspecialchars(trim($_POST['password']));
	if($username && $password) {
	    $password = md5($password);
	    $link = mysql_connect('db512462049.db.1and1.com','XXXXXXXX','XXXXXXXX'); 
	    if (!$link) { 
		die('Could not connect to MySQL: ' . mysql_error()); 
	     }
	    $db_select = mysql_select_db("db512462049",$link); 
                if (!$db_select) { 
                    die("Database selection failed:: " . mysql_error()); 
                    }
	  
	    $sel_stmt = "SELECT admin_password FROM passwords WHERE admin_password='".$password."';";
	    $result = mysql_query($sel_stmt, $link); 
	    if(!$result) {
		die('Error: ' . mysql_error($link));
	    }
	    if(mysql_num_rows($result)>0) {
		$_SESSION['username'] = $username;
		 header("Location: index.php");
	    }
	}
     }
   
?> 
     
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">
<head>
    <title>Login</title>

<link rel="stylesheet" type="text/css" href="./Style/logstyle.css" />
<script language="javascript" type="text/javascript">
    function clearFields() {
        document.getElementById("username").value = null; 
	document.getElementById("password").value = null; 
    }
</script>
</head>


<body>
    <div id="container">
	<form method="POST" action="<?php echo(htmlspecialchars($_SERVER['PHP_SELF'])) ?>" >   
	<label for="username">Username:</label> 
	<input type="text" id="username" name="username">
	<label for="password">Password: </label>
	<input type="password" id="password" name="password"> 
	<div id="lower"> 
	    <input id="login" type="submit" value="Login" name="login">
	    <input id="clear" type="button" value="Clear" onclick="clearFields()"> 
	</div>
	</form> 
    </div>
        
    
    
</body>
</html>
