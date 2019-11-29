<?php 

require('../config/db.php');
session_start();

// storing  request (ie, get/post) global array to a variable
$requestData = $_REQUEST;


$id = $_POST['id'];



$query  = "select * from tasks where id ='$id'";
$result = mysqli_query($con,$query) or die(mysqli_error($con));


$events = array();
while ($row = mysqli_fetch_array($result)) {  // preparing an array
    
    $e = array(
        'id' => $row["id"],
        'title' => $row["name"],
        'start' => $row["start_date"],//$start,
        'end' => $row["end_date"],
        'station_id' => $row["stations_id"],
        'assigned_to' => $row["assigned_to"],
        'project_id' => $row["projects_id"],
        'checklist_id' => $row["checklist_id"],
        'allDay' => ''
    );
    array_push($events, $e);
}

echo json_encode($events);
exit();


?>