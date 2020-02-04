<?php 
require('../config/db.php');


//file_put_contents('/home/sel/php_debug.log',$_POST["created_by"]);

if (isset($_POST['1'])){
    
    $id = stripslashes($_POST['1']);
    $id = mysqli_real_escape_string($con,$id);
    
    $st_id = stripslashes($_POST['2']);
    $st_id = mysqli_real_escape_string($con,$st_id);
    
    $st_name = stripslashes($_POST['3']);
    $st_name = mysqli_real_escape_string($con,$st_name);
    
    $created_by  = stripslashes($_SESSION['username']);
    $created_by = mysqli_real_escape_string($con,$created_by);
    
    $st_type_id  = stripslashes($_POST['4']);
    $st_type_id = mysqli_real_escape_string($con,$st_type_id);
    
    $st_add = stripslashes($_POST['5']);
    $st_add = mysqli_real_escape_string($con,$st_add);
    
    $st_lat = stripslashes($_POST['6']);
    $st_lat = mysqli_real_escape_string($con,$st_lat);
    
    $st_lon = stripslashes($_POST['7']);
    $st_lon = mysqli_real_escape_string($con,$st_lon);
    
    $st_pro = stripslashes($_POST['8']);
    $st_pro = mysqli_real_escape_string($con,$st_pro);
    
    $create_date = date("Y-m-d H:i:s");  
    
     
    
    $qry = "UPDATE `stations` SET `name`='$st_name', `station_type_id`='$st_type_id',
`station_id`='$st_id',`station_address`='$st_add' ,`lat`='$st_lat',`lon`='$st_lon',`projects_id`='$st_pro' WHERE `id`='$id'";
    
    
    //$result = mysqli_query($con,$query);
    if($con->query($qry) === TRUE) {
        echo "Station updated successfully";
    } else {
        echo "Error creating record: " . $con->error;
    }
    }
?>