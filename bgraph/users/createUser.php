<?php 
require('../config/db.php');


//file_put_contents('/home/sel/php_debug.log',$_POST['username']);

if (isset($_POST['1'])){
    $firstname = stripslashes($_POST['4']);
    $firstname = mysqli_real_escape_string($con,$firstname);
    $lastname = stripslashes($_POST['5']);
    $lastname = mysqli_real_escape_string($con,$lastname);
    
    $username = stripslashes($_POST['2']);
    $username = mysqli_real_escape_string($con,$username);
    $email = stripslashes($_POST['3']);
    $email = mysqli_real_escape_string($con,$email);
    $password = stripslashes($_POST['6']);
    $password = mysqli_real_escape_string($con,$password);
    $user_role = stripslashes($_POST['7']);
    $user_role = (int)mysqli_real_escape_string ($con,$user_role);
    $user_org = stripslashes($_POST['8']);
    $user_org = (int)mysqli_real_escape_string($con,$user_org);
    
    $project_id = stripslashes($_POST['9']);
    $project_id = (int)mysqli_real_escape_string($con,$project_id);
    
    
    $create_date = date("Y-m-d H:i:s"); 
    $qry = "INSERT INTO `users` (`id`, `username`, `email`, `password`, `create_date`, `first_name`, 
            `last_name`, `is_active`, `organizations_id`, `roles_id`,`projects_id`) 
             VALUES(NULL, '$username', '$email', '".md5($password)."', '$create_date', 
            '$firstname', '$lastname', '', '$user_org', '$user_role','$project_id')";
    
    //$result = mysqli_query($con,$query);
    if($con->query($qry) === TRUE) {
        echo "User created successfully";
    } else {
        echo "Error creating user: " . $con->error;
    }
    }
?>