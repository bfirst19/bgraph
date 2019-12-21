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
  
    $nestedData[]= $row["id"];
    $nestedData[]= $row["name"];
    $nestedData[]= $row["assigned_to"];//$start,
    $nestedData[]= $row["start_date"];
    $nestedData[]= $row["status"];
    $nestedData[]= $row["comments"];
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
