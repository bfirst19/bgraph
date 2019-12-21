<?php            
require('../config/db.php');
//session_start();

// storing  request (ie, get/post) global array to a variable
$requestData = $_REQUEST;
$username  = stripslashes($_SESSION['username']);
$username = mysqli_real_escape_string($con,$username);

$usrQry = "SELECT * from users where username='$username'";
$usrResult = mysqli_query($con,$usrQry) or die(mysqli_error($con));
$usrRow = mysqli_fetch_assoc($usrResult);

$assigned_to = $usrRow['id'];

$query  = "select * from tasks where assigned_to ='$assigned_to'" ;
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
    $nestedData[]= $row["create_date"];
    $nestedData[]= $row["created_by"];       
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