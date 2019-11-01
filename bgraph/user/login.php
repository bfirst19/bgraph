<!DOCTYPE html>

<html>
<head>
<meta charset="utf-8">
<title>Login</title>

<!-- Custom styles for this template-->

	<link href="../css/l-form.css" rel="stylesheet">
</head>
<body>
<?php
session_start();
require('../config/db.php');

if (isset($_POST['username'])){
	$username = stripslashes($_REQUEST['username']);
	$username = mysqli_real_escape_string($con,$username);
	$password = stripslashes($_REQUEST['password']);
	$password = mysqli_real_escape_string($con,$password);
        $query = "SELECT * FROM `users` WHERE username='$username'
and password='".md5($password)."'";
	$result = mysqli_query($con,$query) or die(mysqli_error($con));
	$rows = mysqli_num_rows($result);
        if($rows==1){
            while ($row = mysqli_fetch_array($result)) {
                $_SESSION['email'] = $row['email'];
            }
        
			$_SESSION['username'] = $username;
			$_SESSION['auth'] = "OKAY";
	           header("Location: ../doc/dashboard.php");
         }else{
	echo "<div class='login'>
<h3>Username/password is incorrect.</h3>
<br/><h3>Click here to <a href='login.php'>Login</a></div></h3>";
	}
    }else{
?>

	<form class="login" action="" method="post" name="login">
  
  
		<input type="text"  name="username" placeholder="Username" autofocus>
    <input type="password"  name="password" placeholder="Password">
    <input type="submit" value="Login" name="submit" >
		<a href="#" >Forgot password?</a>
</form>

<?php } ?>
</body>
</html>
