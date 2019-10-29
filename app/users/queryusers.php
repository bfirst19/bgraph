<?php            
require('../config/db.php');
//session_start();

// storing  request (ie, get/post) global array to a variable
$requestData = $_REQUEST;
$columns = array(
// datatable column index  => database column name
    0 => 'username',
    1 => 'email',
    2 => 'first_name',
    3 => 'last_name',
    4 => 'user_role',
    5 => 'create_date'
);

$query  = "select * from users";
$result = mysqli_query($con,$query) or die(mysqli_error($con));


$data = array();
while ($row = mysqli_fetch_array($result)) {  // preparing an array
    $nestedData = array();
    $nestedData[] = [];
    $nestedData[] = $row["username"];
    $nestedData[] = $row["email"];
    $nestedData[] = $row["first_name"];
    $nestedData[] = $row["last_name"];
    $nestedData[] = $row["user_role"];
    $nestedData[] = $row["create_date"];
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