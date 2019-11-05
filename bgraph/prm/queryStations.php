<?php            
require('../config/db.php');
session_start();

// storing  request (ie, get/post) global array to a variable
$requestData = $_REQUEST;


$query  = "select * from stations";
$result = mysqli_query($con,$query) or die(mysqli_error($con));


$data = array();
while ($row = mysqli_fetch_array($result)) {  // preparing an array
    $nestedData = array();
    $nestedData[] = [];
    $nestedData[] = $row["id"];
    $nestedData[] = $row["name"];
    $nestedData[] = $row["type"];
    $nestedData[] = $row["station_id"];    
    $nestedData[] = $row["created_by"];
    $nestedData[] = $row["create_date"];
    $data[] = $nestedData;
}

$results = ["sEcho" => 1,
    "iTotalRecords" => count($data),
    "iTotalDisplayRecords" => count($data),
    "aaData" => $data ];


echo json_encode($results); 

?>