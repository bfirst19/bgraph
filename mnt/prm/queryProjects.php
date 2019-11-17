<?php            
require('../config/db.php');
//session_start();

// storing  request (ie, get/post) global array to a variable
$requestData = $_REQUEST;


$query  = "select * from projects";
$result = mysqli_query($con,$query) or die(mysqli_error($con));


$data = array();
while ($row = mysqli_fetch_array($result)) {  // preparing an array
    $nestedData = array();
    $nestedData[] = [];
    $nestedData[] = $row["id"];
    $nestedData[] = $row["number"];
    $nestedData[] = $row["name"];
    $nestedData[] = $row["description"];
    $nestedData[] = $row["start_date"];
    $nestedData[] = $row["end_date"];
    $nestedData[] = $row["manager"];
    $nestedData[] = $row["customer_name"];
    $data[] = $nestedData;
}

$results = ["sEcho" => 1,
    "iTotalRecords" => count($data),
    "iTotalDisplayRecords" => count($data),
    "aaData" => $data ];

/*
while($row = $result->fetch_array(MYSQLI_ASSOC)){
    $data[] = $row;
}
$results = ["sEcho" => 1,
    "iTotalRecords" => count($data),
    "iTotalDisplayRecords" => count($data),
    "aaData" => $data ];
    
    echo json_encode($results);
*/
/*$json_data = array(
    "draw" => intval($requestData['draw']),  
    "recordsTotal" => intval($totalData),  
    "recordsFiltered" => intval($totalFiltered), 
    "data" => $data   
);*/
echo json_encode($results); 

?>