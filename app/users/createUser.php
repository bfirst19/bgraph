<?php 
require('../config/db.php');


file_put_contents('/home/sel/php_debug.log',$_POST['username']);

if (isset($_POST['username'])){
    $username = stripslashes($_POST['username']);
    $username = mysqli_real_escape_string($con,$username);
    $email = stripslashes($_POST['email']);
    $email = mysqli_real_escape_string($con,$email);
    $password = stripslashes($_POST['password']);
    $password = mysqli_real_escape_string($con,$password);
    $create_date = date("Y-m-d H:i:s");
    $query = "INSERT into `users` (username,password,email,create_date,user_type,first_name,last_name,is_active,user_role)
VALUES ('$username', '".md5($password)."', '$email', '$create_date','','','','','user')";
    $result = mysqli_query($con,$query);
    if(!$result){
        
        echo"Error description: " . mysqli_error($con);
        ?>
		 <input type="button" class="btn btn-dark"" VALUE="Close"
        onclick="window.location.href='../index'"> 
		  
<?php
        }else{
			 echo "<div class='form'>
<h3>You are registered successfully.</h3>
<br/>Click here to <a href='login'>Login</a></div>";
		}
    }
?>