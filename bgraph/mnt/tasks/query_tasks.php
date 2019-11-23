<?php            
require('../config/db.php');
//session_start();

// storing  request (ie, get/post) global array to a variable
$requestData = $_REQUEST;


$start = $_GET['start'];
$end = $_GET['end'];

$query  = "select * from tasks where start_date >='$start' and end_date <='$end'" ;
$result = mysqli_query($con,$query) or die(mysqli_error($con));


$events = array();
while ($row = mysqli_fetch_array($result)) {  // preparing an array
       
    $e = array(
        'id' => $row["id"],
        'title' => $row["name"],
        'start' => $row["start_date"],//$start,
        'end' => $row["end_date"],
        'allDay' => ''
    );
    array_push($events, $e);  
}

echo json_encode($events); 
exit();

?>