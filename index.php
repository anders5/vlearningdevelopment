<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<!--TODO: continue following bookmarked tutorial to set up user registration system-->
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />  
<Title>Virtual Learning Environment</Title>
<link rel="stylesheet" href="style.css" type="text/css" />
</head>  
<body>  
<div id="main">
<?php
    session_start();
  
    $host = "localhost";
    $user = "root";
    $pwd = "";
    $db = "virtual_learning_environment";
    // Connect to database.
    $connection = mysqli_connect($host,$user,$pwd,$db) or die("MySQL Error: " . mysql_error());
    
    if(!empty($_SESSION['LoggedIn']) && !empty($_SESSION['Username']))
    {
        ?>
        <!--allow user to access the main page-->
        <h1>Member Area</h1>
        <p> You are logged in as <code><?=$_SESSION['Username']?></code>.</p>
        <a href="logout.php">Logout</a>
        <?php
    }
    elseif(!empty($_POST['username']) && !empty($_POST['password']))
    {
        $username = mysqli_real_escape_string($connection, $_POST['username']);
        $password = md5(mysqli_real_escape_string($connection, $_POST['password']));
        
     
        $checklogin = mysqli_query($connection, "SELECT * FROM students WHERE username = '".$username."' AND password = '".$password."'");
      
        if(mysqli_num_rows($checklogin) == 1)
        {
            $row = mysqli_fetch_array($checklogin);
            
         
            $_SESSION['Username'] = $username;
            
            $_SESSION['LoggedIn'] = 1;
         
            echo "<h1>Success</h1>";
            echo "<p>We are now redirecting you to the member area.</p>";
            echo "<meta http-equiv='refresh' content='=2;index.php' />";
        }   
    else
    {
        echo "<h1>Error</h1>";
        echo "<p>Sorry, your account could not be found. Please <a href=\"index.php\">click here to try again</a>.</p>";
    }
}
    
    else
    {
    ?>
        //display the registration form
           <h1>Member Login</h1>
     
            <p>Thanks for visiting! Please either login below, or <a href="register.php">click here to register</a>.</p>
     
    <form method="post" action="index.php" name="loginform" id="loginform">
    <fieldset>
        <label for="username">Username:</label><input type="text" name="username" id="username" /><br />
        <label for="password">Password:</label><input type="password" name="password" id="password" /><br />
        <input type="submit" name="login" id="login" value="Login" />
    </fieldset>
    </form>
     
   
        
        
        
        <?php
    }
    ?>

</div>
</body>
</html>
