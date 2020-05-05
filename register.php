
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <link rel="STYLESHEET" type="text/css" href="style/AlexStyle.css" />

    <title>Register</title>
     
</head>
<body>
<div class="container">
<div class="wrapper">
<h2>New user registration</h2>


    <?PHP
    //require_once("./include/membersite_config.php");
    // Include config file
    require_once "MyFunctions.php";

    if(isset($_POST['Submit']))
    {   
        $sql = "select count(*) from USERS where USERNAME= '".$_POST['username']."'";

        if (SqlOneValueQuery($sql,0)==0){
            $sql="insert into USERS (USERNAME,PW) values('".$_POST['username']."','".password_hash($_POST['password'], PASSWORD_DEFAULT)."')";
            SqlTask($sql);
            echo "<font color=green><h4>User ".$_POST['username']." created!</h4></font>";
        }
        else{
            echo "<font color=red><h4>User ".$_POST['username']." already exist!</h3></font>";
        }
    }
    ?>



<p>Please fill in new credentials</p>
<form id='register'  action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>' method='post'  class="was-validated" accept-charset='UTF-8'>

    <div class="form-group">
                <label for="uname">Username:</label>
                <input type="text" class="form-control" id="username" placeholder="Enter username" name="username" required>
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">Please fill out this field.</div>
            </div>
            <div class="form-group">
                <label for="pwd">Password:</label>
                <input type="password" class="form-control" id="password" placeholder="Enter password" name="password" required>
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">Please fill out this field.</div>
            </div>
    <br>
    <input type='submit' name='Submit' value='Submit' />
    <br><br><hr>
    <a href='login.php'>Login</a>
</form>
<br>

</div>

</div>
</body>
</html>