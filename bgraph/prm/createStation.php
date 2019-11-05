<?php 
require('../config/db.php');
session_start();

//file_put_contents('/home/sel/php_debug.log',$_POST["created_by"]);

if (isset($_POST['2'])){
    
    $st_id = stripslashes($_POST['4']);
    $st_id = mysqli_real_escape_string($con,$st_id);
    
    $st_name = stripslashes($_POST['2']);
    $st_name = mysqli_real_escape_string($con,$st_name);
      
    $created_by  = stripslashes($_SESSION['username']);
    $created_by = mysqli_real_escape_string($con,$created_by);
    
    $st_type  = stripslashes($_POST['3']);
    $st_type = mysqli_real_escape_string($con,$st_type);
    
    $create_date = date("Y-m-d H:i:s");  
    
    $qry = "INSERT INTO `stations` (`id`, `name`, `create_date`, `created_by`, `type`, `station_id`) 
   VALUES (NULL, '$st_name', '$create_date', '$created_by', '$st_type', '$st_id')";
    
    echo $qry;
    //$result = mysqli_query($con,$query);
    if($con->query($qry) === TRUE) {
        echo "Station created successfully".$qry;
    } else {
        echo "Error creating record: " . $con->error;
    }
    }
?>