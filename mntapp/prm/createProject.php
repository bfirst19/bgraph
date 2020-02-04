<?php 
require('../config/db.php');
session_start();

//file_put_contents('/home/sel/php_debug.log',$_POST["created_by"]);

if (isset($_POST['2'])){
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
    
    
    $sql  = "INSERT INTO `projects` (`id`, `name`, `description`, 
            `start_date`, `end_date`, `manager`, `customer_name`, `number`) 
VALUES (NULL, '$name', '$desc', '$start_date', '$end_date', '$manager', '$cust_name', NULL)";
    
    
    $create_date = date("Y-m-d H:i:s");
    $qry = "INSERT into `organizations` (name,create_date,created_by)
VALUES ('$orgname', '$create_date','$created_by')";
    $result = mysqli_query($con,$query);
    if($con->query($sql) === TRUE) {
        echo "Project created successfully";
    } else {
        echo "Error creating record: " . $con->error;
    }
    }
?>