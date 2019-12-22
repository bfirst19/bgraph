<?php 
require('../config/db.php');
session_start();


if (isset($_POST['completedData'])){
    
    $jsondata = $_POST['completedData'];
    $jsondata = mysqli_real_escape_string($con,$jsondata);
    
    $checklist_id = $_POST['checklist_id'];
    $checklist_id = (int)mysqli_real_escape_string($con,$checklist_id);
    
    $maint_date = $_POST['maint_date'];
    $maint_date = mysqli_real_escape_string($con,$maint_date);
     
    
    $project_manager = stripslashes($_POST['project_manager']);
    $project_manager = mysqli_real_escape_string($con, $project_manager);
    
    $task_name = stripslashes($_POST['task_name']);
    $task_name = mysqli_real_escape_string($con, $task_name);
    
    
    
    $prep_stmt = "SELECT * from mnt_report WHERE checklist_id='$checklist_id'";
    // execute query
    $result = mysqli_query($con, $prep_stmt) or die(mysqli_error($con));
    $count = mysqli_num_rows($result);
    
    
    
    if($count==0){
    $qry = "INSERT INTO `mnt_report` (`id`, `name`, `json`, `html`, `pdf`, `docx`, `maintenance_date`,`before_image`,`after_image`, `checklist_id`) 
            VALUES (NULL, '$task_name','$jsondata',NULL,NULL,NULL,'$maint_date',NULL,NULL,'$checklist_id')";
    }else {
        $qry="UPDATE `mnt_report` SET `json`='$jsondata' WHERE `checklist_id`='$checklist_id'"; 
    }
    //echo $jsondata;
    //$result = mysqli_query($con,$query);
    if($con->query($qry) === TRUE) {
        echo "Record created successfully";
    } else {
        echo "Error creating record: " . $con->error;
    }
    
    $comment = stripslashes($_POST['comment']);
    $comment = mysqli_real_escape_string($con, $comment);
    
    $task_id = stripslashes($_POST['task_id']);
    $task_id = mysqli_real_escape_string($con, $task_id);
    
    $status = "For Approval";
    $sql = "UPDATE `tasks` SET `status`='$status',`comments`='$comment' ,`reassigned_to`='$project_manager' WHERE `id`='$task_id'";
    if($con->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updated record: " . $con->error;
    }
}

?>