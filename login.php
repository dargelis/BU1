<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
  header("location: TimeRegV1.php");
  exit;
}
 
// Include config file
require_once "MyFunctions.php";
 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "select PW from USERS where USERNAME= '".$username."'";
        
        $hashed_password = SqlOneValueQuery($sql,0);
        if(password_verify($password, $hashed_password)){
        //if($password==$hashed_password){
          // Password is correct, so start a new session
          session_start();
          
          // Store data in session variables
          $_SESSION["loggedin"] = true;
          $_SESSION["username"] = $username;                            
          
          // Redirect user to welcome page
          header("location: TimeRegV1.php");
      } else{
          // Display an error message if password is not valid
          $password_err = "The password or username you entered was not valid.";
      }

    }
}

?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <link rel="stylesheet" href="style/AlexStyle.css" />

</head>
<body id="login_page">

    <div class="wrapper">
        <h2>Login</h2>
        <p>Please fill in your credentials to login.</p>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post"  class="was-validated">

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
                <?php if ($password_err!="") {echo "<script>alert('".$password_err."');</script>";}; ?></div>
            
                <input type="submit" class="btn btn-primary" value="Login">
            
            </div>
        </form>
    </div>    

~
</body>



<script type="text/javascript">

(function(){ 

  document.onreadystatechange = () => {

    if (document.readyState === 'complete') {

      let el = document.querySelector('#MyMISTEAM');
      let myAnimation = new LazyLinePainter(el, {"ease":"easeLinear","strokeWidth":1,"strokeOpacity":1,"strokeColor":"#222F3D","strokeCap":"square","delay":0}); 
      myAnimation.paint(); 
    }
  }

})();

</script>
</html>