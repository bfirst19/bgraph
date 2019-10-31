<?php 
require('../config/db.php');


//file_put_contents('/home/sel/php_debug.log',$_POST['username']);

if (isset($_POST['eusername'])){
    $euser_id = stripslashes($_POST['euser_id']);
    $euser_id = mysqli_real_escape_string($con,$euser_id);
    
    $firstname = stripslashes($_POST['efirst_name']);
    $firstname = mysqli_real_escape_string($con,$firstname);
    $lastname = stripslashes($_POST['elast_name']);
    $lastname = mysqli_real_escape_string($con,$lastname);
    
    $username = stripslashes($_POST['eusername']);
    $username = mysqli_real_escape_string($con,$username);
    $email = stripslashes($_POST['eemail']);
    $email = mysqli_real_escape_string($con,$email);
    $password = stripslashes($_POST['epassword']);
    $password = mysqli_real_escape_string($con,$password);
    $user_role = stripslashes($_POST['euser_role']);
    $user_role = mysqli_real_escape_string($con,$user_role);
    $user_org = stripslashes($_POST['euser_org']);
    $user_org = (int)mysqli_real_escape_string($con,$user_org);
    
    $create_date = date("Y-m-d H:i:s");
    
    $qry = "UPDATE `users` SET `username` = '$username', `email` = '$email',
 `password` = '".md5($password)."', `create_date` ='$create_date', `first_name` = '$firstname', 
`last_name` = '$lastname', `is_active` = '', `organizations_id` = '$user_org', 
`roles_id` = '$user_role' WHERE `id` = '$euser_id'";
    
    //$result = mysqli_query($con,$query);
    if($con->query($qry) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $con->error;
    }
}
?>