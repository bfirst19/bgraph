<?php 
require('../config/db.php');
session_start();

//file_put_contents('/home/sel/php_debug.log',$_POST['username']);

if (isset($_POST['1'])){
    $rolename = stripslashes($_POST['2']);
    $rolename = mysqli_real_escape_string($con,$rolename);
      
    $created_by  = stripslashes($_SESSION['username']);
    $created_by = mysqli_real_escape_string($con,$created_by);
    
    $role_id = $rolename;
    $role_id = strtolower($role_id);
    $role_id =  preg_replace('/\s+/', '_', $role_id);
    
    
    $create_date = date("Y-m-d H:i:s");
    $qry = "INSERT into `roles` (name,create_date,created_by,role_id)
    VALUES ('$rolename', '$create_date','$created_by','$role_id')";
    //$result = mysqli_query($con,$query);
    if($con->query($qry) === TRUE) {
        echo "Record added successfully";
    } else {
        echo  "Error adding record:".$con->error;;
    }
   }
?>