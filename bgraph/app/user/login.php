<!DOCTYPE html>

<html>
<head>
<meta charset="utf-8">
<title>Login</title>

<!-- Custom styles for this template-->

	<link href="../css/l-form.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/vendors/iconfonts/font-awesome/css/font-awesome.css"/>
</head>
<body>
<?php
require('../config/db.php');
session_start();
if (isset($_POST['username'])){
	$username = stripslashes($_REQUEST['username']);
	$username = mysqli_real_escape_string($con,$username);
	$password = stripslashes($_REQUEST['password']);
	$password = mysqli_real_escape_string($con,$password);
        $query = "SELECT * FROM `users` WHERE username='$username'
and password='".md5($password)."'";
	$result = mysqli_query($con,$query) or die(mysql_error());
	$rows = mysqli_num_rows($result);
        if($rows==1){
	    $_SESSION['username'] = $username;
	    header("Location: ../doc/dashboard.php");
         }else{
	echo "<div class='form'>
<h3>Username/password is incorrect.</h3>
<br/>Click here to <a href='login.php'>Login</a></div>";
	}
    }else{
?>

	<form class="login-form" action="" method="post" name="login">
  <p class="login-text">
    <span class="fa-stack fa-lg">
      <i class="fa fa-circle fa-stack-2x"></i>
      <i class="fa fa-lock fa-stack-1x"></i>
    </span>
  </p>
  
		<input type="text" class="login-username" name="username" placeholder="Username" autofocus>
    <input type="password" class="login-password" name="password" placeholder="Password">
    <input type="submit" value="Login" name="submit" class="login-submit">
		
</form>
<a href="#" class="login-forgot-pass">forgot password?</a>
<div class="underlay-photo"></div>
<div class="underlay-black"></div> 

<?php } ?>
</body>
</html>
