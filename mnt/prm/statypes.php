<?php
require ('../config/db.php');
session_start();
$query = "select * from station_type";
$result = mysqli_query($con, $query) or die(mysqli_error($con));
$data;
while ($row = mysqli_fetch_array($result)) {
    $nestedData = array();
    $nestedData[] = [];
    
    //$nestedData = $row['id'];
    //$nestedData = $row['name'];
    
    $return_arr[] = array("id" => $row['id'],
        "value" => $row['type_value']);
   
 }
$data = $return_arr;
echo json_encode($data);
?>