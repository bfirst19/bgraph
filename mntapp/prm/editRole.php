<?php
require('../config/db.php');
session_start();

//file_put_contents('/home/sel/php_debug.log',$_POST['username']);

if (isset($_POST['1'])){
    $rolename = stripslashes($_POST['2']);
    $rolename = mysqli_real_escape_string($con,$rolename);
    
    $roleid = stripslashes($_POST['1']);
    $roleid = mysqli_real_escape_string($con,$roleid);
    
    $created_by  = stripslashes($_SESSION['username']);
    $created_by = mysqli_real_escape_string($con,$created_by);
    
    $role_id = $rolename;
    $role_id = strtolower($role_id);
    $role_id =  preg_replace('/\s+/', '_', $role_id);
    
    
    
    $create_date = date("Y-m-d H:i:s");
    //$qry = "UPDATE  `roles` set `name`=$rolename WHERE `id`=$roleid";
    $qry  = "UPDATE `roles` SET `name`='$rolename',`role_id`='$role_id' WHERE id='$roleid'";
   
    //$result = mysqli_query($con,$query);
    if($con->query($qry) === TRUE) {
        echo "Record edited successfully";
    } else {
        echo  "Error editing record:".$con->error;;
    }
}
?>