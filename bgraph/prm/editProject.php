<?php
require('../config/db.php');
session_start();

//file_put_contents('/home/sel/php_debug.log',$_POST["created_by"]);

if (isset($_POST['1'])){
    
    $id = stripslashes($_POST['1']);
    $id = mysqli_real_escape_string($con,$id);
    
    $name = stripslashes($_POST['3']);
    $name = mysqli_real_escape_string($con,$name);
    
    $desc  = stripslashes($_POST['4']);
    $desc = mysqli_real_escape_string($con,$desc);
    
    $start_date  = stripslashes($_POST['5']);
    $start_date = mysqli_real_escape_string($con,$start_date);
    
    $end_date  = stripslashes($_POST['6']);
    $end_date = mysqli_real_escape_string($con,$end_date);
    $manager  = stripslashes($_POST['7']);
    $manager = mysqli_real_escape_string($con,$manager);
    $cust_name  = stripslashes($_POST['8']);
    $cust_name = mysqli_real_escape_string($con,$cust_name);
    
    
    $sql  = "UPDATE `projects` SET `name`='$name', `description`='$desc',
            `start_date`='$start_date', `end_date`='$end_date', 
            `manager`='$manager',`customer_name`='$cust_name' WHERE `id`='$id'";
   
    
    $create_date = date("Y-m-d H:i:s");
    
    //$result = mysqli_query($con,$sql);
    if($con->query($sql) === TRUE) {
        echo "Project updated successfully";
    } else {
        echo "Error updating record: " . $con->error;
    }
}
?>