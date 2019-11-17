
<?php
require('../config/db.php');

if (isset($_POST['task_id'])){
    $taskname = stripslashes($_POST['task_name']);
    $taskname = mysqli_real_escape_string($con,$taskname);
    $taskdesc = stripslashes($_POST['task_desc']);
    $taskdesc = mysqli_real_escape_string($con,$taskdesc);
    
    $start_date = stripslashes($_POST['starts_at']);
    $start_date = mysqli_real_escape_string($con,$start_date);
    $end_date = stripslashes($_POST['ends_at']);
    $end_date = mysqli_real_escape_string($con,$end_date);
    
    /*
    $username = stripslashes($_POST['2']);
    $username = mysqli_real_escape_string($con,$username);
    $email = stripslashes($_POST['3']);
    $email = mysqli_real_escape_string($con,$email);
    $password = stripslashes($_POST['6']);
    $password = mysqli_real_escape_string($con,$password);
    $user_role = stripslashes($_POST['7']);
    $user_role = (int)mysqli_real_escape_string ($con,$user_role);
    $user_org = stripslashes($_POST['8']);
    $user_org = (int)mysqli_real_escape_string($con,$user_org);
    
    $project_id = stripslashes($_POST['9']);
    $project_id = (int)mysqli_real_escape_string($con,$project_id);*/
    
    $project_id = stripslashes($_POST['project_id']);
    $project_id = (int)mysqli_real_escape_string($con,$project_id);
    
    $station_id = stripslashes($_POST['station_id']);
    $station_id = (int)mysqli_real_escape_string($con,$station_id);
    
    $checklist_id = stripslashes($_POST['checklist_id']);
    $checklist_id = (int)mysqli_real_escape_string($con,$checklist_id);
    
    $assigned_to = stripslashes($_POST['assigned_to']);
    $assigned_to = (int)mysqli_real_escape_string($con,$assigned_to);
    
    
    $date = date("Y-m-d H:i:s");
    
    $id = stripslashes($_POST['task_id']);
    $id = mysqli_real_escape_string($con,$id);
    
    echo $id;
    $sql  = "UPDATE `tasks` SET `name`='$taskname', `assigned_to`='0001', `created_by`='0001', `create_date`='$date',
             `stations_id`='$station_id', `projects_id`='$project_id', `check_list_id`='$checklist_id', `assigned_to`='$assigned_to',
            `start_date`='$start_date',`end_date`='$end_date' WHERE `id`='$id'"; 
   // `reassigned_to`, `status`, `check_list_id`, `projects_id`, `users_id`, `stations_id`,`start_date`,`end_date`)  
   
    
    //$result = mysqli_query($con,$query);
    if($con->query($sql) === TRUE) {
        echo "Task updated successfully"+$start_date;
    } else {
        echo "Error updating task: " . $con->error;
    }
}else{
    echo "No task id is set to the request";
}
?>