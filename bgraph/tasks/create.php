<?php
require('../config/db.php');


//file_put_contents('/home/sel/php_debug.log',$_POST['username']);

if (isset($_POST['task_name'])){
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
    $user_org = (int)mysqli_real_escape_string($con,$user_org);*/
    
    $project_id = stripslashes($_POST['project_id']);
    $project_id = (int)mysqli_real_escape_string($con,$project_id);
    
    $station_id = stripslashes($_POST['station_id']);
    $station_id = (int)mysqli_real_escape_string($con,$station_id);
    
    $checklist_id = stripslashes($_POST['checklist_id']);
    $checklist_id = (int)mysqli_real_escape_string($con,$checklist_id);
    
    $assigned_to = stripslashes($_POST['assigned_to']);
    $assigned_to = (int)mysqli_real_escape_string($con,$assigned_to);
    
    $username = stripslashes($_POST['username']);
    $username = mysqli_real_escape_string($con,$username);
    
    $date = date("Y-m-d H:i:s");
    
    $sql  = "INSERT INTO `tasks` (`id`, `name`, `number`, `assigned_to`, `created_by`, `create_date`, 
    `reassigned_to`, `status`, `check_list_id`, `projects_id`, `users_id`, `start_date`,`end_date`,`stations_id`) VALUES 
    (NULL, '$taskname', NULL, '$assigned_to', '$username', '$date', '0000','Not Started', '$checklist_id', '$project_id', '0041', '$start_date','$end_date','$station_id')";
    
 /*  $sql  = 'INSERT INTO `tasks` (`id`, `name`, `number`, `assigned_to`, `created_by`, `create_date`,
 `reassigned_to`, `status`, `check_list_id`, `projects_id`, `users_id`, `start_date`, `end_date`, `stations_id`) VALUES 
(NULL, \'Test rain gauge\', \'\', \'0001\', \'Admin\', \'2019-11-16 00:00:00\', NULL, \'Not Started\', \'2\', \'10028\', \'0041\', \'2019-11-16 00:00:00\', \'2019-11-23 00:00:00\', \'23\')';
    //$result = mysqli_query($con,$query);*/
    if($con->query($sql) === TRUE) {
        echo "Task created successfully";
    } else {
        echo "Error creating task: " . $con->error;
    }
}


function randomDate($start_date, $end_date)
{
    // Convert to timetamps
    $min = strtotime($start_date);
    $max = strtotime($end_date);
    
    // Generate random number using above bounds
    $val = rand($min, $max);
    
    // Convert back to desired date format
    return date('Y-m-d H:i:s', $val);
}

?>