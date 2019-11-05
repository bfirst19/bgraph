<?php            
require('../config/db.php');
//session_start();

// storing  request (ie, get/post) global array to a variable
$requestData = $_REQUEST;

$query  = "select * from users";
$result = mysqli_query($con,$query) or die(mysqli_error($con));


$data = array();
while ($row = mysqli_fetch_array($result)) {  // preparing an array
    $nestedData = array();
    $nestedData[] = [];
    $nestedData[] = $row["id"];
    $nestedData[] = $row["username"];
    $nestedData[] = $row["email"];
    $nestedData[] = $row["first_name"];
    $nestedData[] = $row["last_name"];   
    $nestedData[] = $row["password"];
    //$nestedData[] = $row["organizations_id"];
   
    //query role
    $role_id = $row["roles_id"];
    $roleQry = "SELECT name FROM roles WHERE id='$role_id' LIMIT 1";
    $resultRole = mysqli_query($con,$roleQry);
    $row1 = mysqli_fetch_assoc($resultRole);
    $nestedData[] = $row1["name"];
    
    //query organization
    $org_id = $row["organizations_id"];
     $orgQry = "SELECT name FROM organizations WHERE id='$org_id' LIMIT 1";
     $resultOrg = mysqli_query($con,$orgQry);
     $row2 = mysqli_fetch_assoc($resultOrg);
    $nestedData[] = $row2['name'];
    
    $nestedData[] = $row["create_date"];
    
    $data[] = $nestedData;
}

$results = ["sEcho" => 1,
    "iTotalRecords" => count($data),
    "iTotalDisplayRecords" => count($data),
    "aaData" => $data ];

echo json_encode($results); 

?>