<?php 
require('../config/db.php');


//file_put_contents('/home/sel/php_debug.log',$_POST['username']);

if (isset($_POST['username'])){
    $firstname = stripslashes($_POST['first_name']);
    $firstname = mysqli_real_escape_string($con,$firstname);
    $lastname = stripslashes($_POST['last_name']);
    $lastname = mysqli_real_escape_string($con,$lastname);
    
    $username = stripslashes($_POST['username']);
    $username = mysqli_real_escape_string($con,$username);
    $email = stripslashes($_POST['email']);
    $email = mysqli_real_escape_string($con,$email);
    $password = stripslashes($_POST['password']);
    $password = mysqli_real_escape_string($con,$password);
    $user_role = stripslashes($_POST['user_role']);
    $user_role = (int)mysqli_real_escape_string ($con,$user_role);
    $user_org = stripslashes($_POST['user_org']);
    $user_org = (int)mysqli_real_escape_string($con,$user_org);
    
    
    $create_date = date("Y-m-d H:i:s"); 
    $qry = "INSERT INTO `users` (`id`, `username`, `email`, `password`, `create_date`, `first_name`, 
            `last_name`, `is_active`, `organizations_id`, `roles_id`) 
             VALUES(NULL, '$username', '$email', '".md5($password)."', '$create_date', 
            '$firstname', '$lastname', '', '$user_org', '$user_role')";
    
    //$result = mysqli_query($con,$query);
    if($con->query($qry) === TRUE) {
        echo "User created successfully";
    } else {
        echo "Error creating user: " . $con->error;
    }
    }
?>