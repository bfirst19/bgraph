<?php 

require('../config/db.php');
session_start();

// storing  request (ie, get/post) global array to a variable
$requestData = $_REQUEST;


$id = $_POST['id'];



$query  = "select * from tasks where id ='$id'";
$result = mysqli_query($con,$query) or die(mysqli_error($con));
$row = mysqli_fetch_assoc($result);

$events = array();
//while ($row = mysqli_fetch_array($result)) {  // preparing an array
    $st_id = $row['stations_id'];
    $query2 = "select * from stations where station_id ='$st_id'";
    $result2 = mysqli_query($con, $query2) or die(mysqli_error($con));
    $row2 = mysqli_fetch_assoc($result2);
   
    $project_id = $row2['projects_id'];
    $query3 = "select * from projects where id ='$project_id'";
    $result3 = mysqli_query($con, $query3) or die(mysqli_error($con));
    $row3 = mysqli_fetch_assoc($result3);
       
    $e = array(
        'id' => $row["id"],
        'title' => $row["name"],
        'start' => $row["start_date"],//$start,
        'end' => $row["end_date"],
        'status' => $row["status"],
        'station_id' => $row2["station_id"],        
        'status' => $row["status"],
        'assigned_to' => $row['assigned_to'],
        'checklist_id' => $row["checklist_id"],     
        'group_id' => $row["group_id"], 
        'description' => $row["description"],
        'allDay' => 'false'
    );
    array_push($events, $e);
//}

echo json_encode($events);
exit();


?>