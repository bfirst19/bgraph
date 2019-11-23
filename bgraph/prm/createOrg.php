<?php 
require('../config/db.php');
session_start();

//file_put_contents('/home/sel/php_debug.log',$_POST["created_by"]);

if (isset($_POST['1'])){
    $orgname = stripslashes($_POST['2']);
    $orgname = mysqli_real_escape_string($con,$orgname);
      
    $created_by  = stripslashes($_SESSION['username']);
    $created_by = mysqli_real_escape_string($con,$created_by);
    
    $create_date = date("Y-m-d H:i:s");
    $qry = "INSERT into `organizations` (name,create_date,created_by)
VALUES ('$orgname', '$create_date','$created_by')";
    $result = mysqli_query($con,$query);
    if($con->query($qry) === TRUE) {
        echo "Organization created successfully";
    } else {
        echo "Error creating record: " . $con->error;
    }
    }
?>