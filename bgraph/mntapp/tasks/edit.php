
<?php
require ('../config/db.php');
session_start();
if (isset($_POST['task_id'])) {
    $taskname = stripslashes($_POST['task_name']);
    $taskname = mysqli_real_escape_string($con, $taskname);
    $taskdesc = stripslashes($_POST['task_desc']);
    $taskdesc = mysqli_real_escape_string($con, $taskdesc);

    $start_date = stripslashes($_POST['starts_at']);
    $start_date = mysqli_real_escape_string($con, $start_date);
    $end_date = stripslashes($_POST['ends_at']);
    $end_date = mysqli_real_escape_string($con, $end_date);

    $station_id = stripslashes($_POST['station_id']);
    $station_id = mysqli_real_escape_string($con, $station_id);

    $query = "select * from stations where station_id ='$station_id'";
    $result = mysqli_query($con, $query) or die(mysqli_error($con));
    $row = mysqli_fetch_assoc($result);

    $project_id = $row['projects_id'];
    $project_id = (int) mysqli_real_escape_string($con, $project_id);

    $station_type_id = $row['station_type_id'];
    $station_type_id = (int) mysqli_real_escape_string($con, $station_type_id);
   
    $query2 = "select * from station_type where id ='$station_type_id'";
    $result2 = mysqli_query($con, $query2) or die(mysqli_error($con));
    $row2 = mysqli_fetch_assoc($result2);

    $st_type = $row2['type_value'];
    $assigned_to = mysqli_real_escape_string($con, $st_type);
    
    $contentQry = "select * from checklist_template where station_type_id ='$station_type_id'";
    $conResult = mysqli_query($con, $contentQry) or die(mysqli_error($con));
    $row3 = mysqli_fetch_assoc($conResult);
    

    $checklist_template_id = $row3["id"];
    $checklist_template_id = (int) mysqli_real_escape_string($con, $checklist_template_id);

    $assigned_to = stripslashes($_POST['assigned_to']);
    $assigned_to = mysqli_real_escape_string($con, $assigned_to);

    $username = stripslashes($_POST['username']);
    $username = mysqli_real_escape_string($con, $username);

    $date = date("Y-m-d H:i:s");

    $contentQry = "select template_content from checklist_template where id ='$checklist_template_id'";
    $conResult = mysqli_query($con, $contentQry) or die(mysqli_error($con));
    $row3 = mysqli_fetch_assoc($conResult);

    $content = $row3['template_content'];
    $content = mysqli_real_escape_string($con, $content);

   
    $isEditSeries = stripslashes($_POST['eventEditingStyle']);
    $isEditSeries = mysqli_real_escape_string($con,$isEditSeries);
    
   
    echo $isEditSeries;
    if (strcmp($isEditSeries, 'thisSeriesOnly') == 0) {
        
        $groupId = stripslashes($_POST['group_id']);
        $groupId = mysqli_real_escape_string($con,$groupId);
        
        $taskQry = "select * from tasks where group_id='$groupId'";
        $taskResult = mysqli_query($con,$taskQry) or die(mysqli_error($con));
        while ($ta_row = mysqli_fetch_array($taskResult)) { 
            
            $id = $ta_row['id'];
            $chl_id = $ta_row['checklist_id'];
            $qry = "UPDATE `checklist` SET `checklist_content` = '$content',`station_id`='$station_id',`checklist_template_id`='$checklist_template_id' WHERE id='$chl_id'";
            
            if ($con->query($qry) === TRUE) {               
                
                $sql = "UPDATE `tasks` SET `name`='$taskname', `assigned_to`='$assigned_to', `created_by`='$username', `create_date`='$date',
                `stations_id`='$station_id',  `assigned_to`='$assigned_to',`description`='$taskdesc' WHERE `id`='$id'";                
                
                if ($con->query($sql) === TRUE) {
                    echo "Task updated successfully" + $start_date;
                } else {
                    echo "Error updating task: " . $con->error;
                }
            } else {
                echo "Error creating checklist: " . $con->error;
            }
            
            
        }
        
    }else{
        $id = stripslashes($_POST['task_id']);
        $id = mysqli_real_escape_string($con, $id);
        
        $query = "select * from tasks where id ='$id'";
        $result = mysqli_query($con, $query) or die(mysqli_error($con));
        $row = mysqli_fetch_assoc($result);
        $chl_id = $row['checklist_id'];
        
        $qry = "UPDATE `checklist` SET `checklist_content` = '$content',`station_id`='$station_id',`checklist_template_id`='$checklist_template_id' WHERE id='$chl_id'";
        
        if ($con->query($qry) === TRUE) {
            $sql = "UPDATE `tasks` SET `name`='$taskname', `assigned_to`='$assigned_to', `created_by`='$username', `create_date`='$date',
             `stations_id`='$station_id', `checklist_id`='$chl_id', `assigned_to`='$assigned_to',
            `start_date`='$start_date',`end_date`='$end_date',`description`='$taskdesc' WHERE `id`='$id'";
            if ($con->query($sql) === TRUE) {
                echo "Task updated successfully" + $start_date;
            } else {
                echo "Error updating task: " . $con->error;
            }
        } else {
            echo "Error creating checklist: " . $con->error;
        }
    }
       
    
} else {
    echo "No task id is set to the request";
}
?>
