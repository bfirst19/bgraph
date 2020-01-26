<?php            
require('../config/db.php');
session_start();

// storing  request (ie, get/post) global array to a variable
$requestData = $_REQUEST;
$username  = stripslashes($_SESSION['username']);
$username = mysqli_real_escape_string($con,$username);


$role_name = $_SESSION['user_role'];
$role_id = preg_replace('/\s+/', '_', $role_name);
$role_id = strtolower($role_id);

if (strcmp($role_id, "super_administrator") == 0) {   
    $query  = "select * from tasks" ;
}else{
    $query  = "select * from tasks where assigned_to ='$username' OR reassigned_to='$username'" ;
}

$result = mysqli_query($con,$query) or die(mysqli_error($con));

$data = array();
while ($row = mysqli_fetch_array($result)) {  // preparing an array
    $nestedData = array();
    $nestedData[] = [];
  
    $st_id = $row["stations_id"];
    $status = $row['status'];
    $task_name = $row['name'];
    $main_time = $row['start_date'];
    
    $query_st = "select * from stations where station_id ='$st_id'";
    $result_st = mysqli_query($con, $query_st) or die(mysqli_error($con));
    $row_st = mysqli_fetch_assoc($result_st);
    
    
    $nestedData[]= $row["id"];
    $nestedData[]= $row_st["name"];
    $nestedData[]= $main_time;
    $nestedData[]=$status;
    $nestedData[]= $row["comments"];
    $nestedData[]= $row_st["lat"];
    $nestedData[]= $row_st["lon"];
    $nestedData[]= $st_id;
    $nestedData[]= $task_name;
    //$nestedData[]= "https://www.google.com/maps?q="+$row_st["lon"];
    //$nestedData[]= $row["create_date"];
    //$nestedData[]= $row["created_by"];       
    $nestedData[] = [];
    
    $data[] = $nestedData;
  
}

$results = ["sEcho" => 1,
    "iTotalRecords" => count($data),
    "iTotalDisplayRecords" => count($data),
    "aaData" => $data ];

echo json_encode($results); 
exit();

?>
