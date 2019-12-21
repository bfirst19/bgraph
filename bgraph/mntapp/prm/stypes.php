<?php            
require('../config/db.php');
session_start();

// storing  request (ie, get/post) global array to a variable
//$requestData = $_REQUEST;


$query  = "select * from station_type";
$result = mysqli_query($con,$query) or die(mysqli_error($con));


$data = array();
while ($row = mysqli_fetch_array($result)) {  // preparing an array
    $nestedData = array();   
    $nestedData[] = [];
    $nestedData[] = $row["id"];
    $nestedData[] = $row["type_value"];    
   // $nestedData[] = $row["checklist_template_id"]; 
    $data[] = $nestedData;
}

$results = ["sEcho" => 1,
    "iTotalRecords" => count($data),
    "iTotalDisplayRecords" => count($data),
    "aaData" => $data ];


echo json_encode($results); 

?>