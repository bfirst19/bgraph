<?php
session_start();
require ('../config/db.php');

$requestData = $_REQUEST;


$start_date = $_POST['starts_at'];
$report_type = $_POST['report_type'];

if (isset($_POST['starts_at'])) { 
    
    $start_date = $_POST['starts_at'];
    $report_type = $_POST['report_type'];
    
    $period = explode('-', $start_date);
    
    // echo $period;
    $yr = $period[0];
    $mo = $period[1];
    $prep_stmt = "select *from mnt_report where YEAR(maintenance_date) = '$yr' AND MONTH(maintenance_date) = '$mo'";
    $result = mysqli_query($con, $prep_stmt) or die(mysqli_error($con));
   // $row = mysqli_fetch_assoc($result);
    
    $events = array();
    while ($row = mysqli_fetch_array($result)) { 
        $checklist_id=$row['checklist_id'];
        $checklist_id = mysqli_real_escape_string($con, $checklist_id);
        
        $task_stmt = "select *from tasks where checklist_id='$checklist_id'";
        $task_result = mysqli_query($con, $task_stmt) or die(mysqli_error($con));
        $row2 = mysqli_fetch_assoc($task_result);
        
        $stations_id=$row2['stations_id'];
        $stations_id = mysqli_real_escape_string($con, $stations_id);
        
        $st_stmt = "select *from stations where station_id='$stations_id'";
        $st_result = mysqli_query($con, $st_stmt) or die(mysqli_error($con));
        $row3 = mysqli_fetch_assoc($st_result);
        
        $type1 = pathinfo($row["before_image"], PATHINFO_EXTENSION);
        $imageData1 = file_get_contents($row["before_image"]);
        $before_image = 'data:image/' . $type1 . ';base64,' . base64_encode($imageData1);
        
        $type2 = pathinfo($row["after_image"], PATHINFO_EXTENSION);
        $imageData2 = file_get_contents($row["after_image"]);
        $after_image = 'data:image/' . $type2 . ';base64,' . base64_encode($imageData2);
         
        $milliseconds = round(microtime(true) * 1000);
        $fname =$milliseconds.'_'.$row2['id'].'.pdf';
        
        $e = array(
            'before_image' => $before_image,
            'after_image' => $after_image,
            'task_name' => $row2["name"],//$start,
            'station_id' => $row2["stations_id"],            
            'station_name' =>$row3["name"],        
            'start_date' =>$row2["start_date"], 
            'file_name'=>$fname
        );
        array_push($events, $e);
    }
    
    echo json_encode($events);
    exit();
}


?>