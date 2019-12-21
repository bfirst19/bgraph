<?php 
require('../config/db.php');
session_start();

//file_put_contents('/home/sel/php_debug.log',$_POST["created_by"]);

if (isset($_POST['2'])){
    
    $st_id = stripslashes($_POST['2']);
    $st_id = mysqli_real_escape_string($con,$st_id);
    
    $st_name = stripslashes($_POST['3']);
    $st_name = mysqli_real_escape_string($con,$st_name);
      
    $created_by  = stripslashes($_SESSION['username']);
    $created_by = mysqli_real_escape_string($con,$created_by);
    
    $st_type_id  = stripslashes($_POST['4']);
    $st_type_id = mysqli_real_escape_string($con,$st_type_id);
    
    //query project
    $sttQry = "SELECT * FROM station_type WHERE type_value='$st_type_id' LIMIT 1";
    $resultStt = mysqli_query($con,$sttQry);
    $rowSt = mysqli_fetch_assoc($resultStt);
    $st_type_id = $rowSt['id'];
    
    
    $st_add = stripslashes($_POST['5']);
    $st_add = mysqli_real_escape_string($con,$st_add);
    
    $st_lat = stripslashes($_POST['6']);
    $st_lat = mysqli_real_escape_string($con,$st_lat);
    
    $st_lon = stripslashes($_POST['7']);
    $st_lon = mysqli_real_escape_string($con,$st_lon);
    
    $st_pro = stripslashes($_POST['8']);
    $st_pro = mysqli_real_escape_string($con,$st_pro);
    
    //query project
    $prQry = "SELECT * FROM projects WHERE number='$st_pro' LIMIT 1";
    $resultPr = mysqli_query($con,$prQry);
    $row3 = mysqli_fetch_assoc($resultPr);
    $st_pro = $row3['id'];
    
    
    
    $create_date = date("Y-m-d H:i:s");  
    
    $qry = "INSERT INTO `stations` (`id`, `name`, `create_date`, `created_by`, `station_id`,
`station_address`,`station_type_id`,`lat`,`lon`,`projects_id`) VALUES (NULL, '$st_name','$create_date', '$created_by', 
                '$st_id','$st_add', '$st_type_id','$st_lat','$st_lon','$st_pro')";
    
    echo $qry;
    //$result = mysqli_query($con,$query);
    if($con->query($qry) === TRUE) {
        echo "Station created successfully";
    } else {
        echo "Error creating record: " . $con->error;
    }
    }
?>