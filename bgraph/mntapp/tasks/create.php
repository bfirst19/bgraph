<?php
require ('../config/db.php');

include 'When.php';
include 'Valid.php';

use When;

// file_put_contents('/home/sel/php_debug.log',$_POST['username']);

if (isset($_POST['task_name'])) {
    $taskname = stripslashes($_POST['task_name']);
    $taskname = mysqli_real_escape_string($con, $taskname);
    $taskdesc = stripslashes($_POST['task_desc']);
    $taskdesc = mysqli_real_escape_string($con, $taskdesc);

    $station_id = stripslashes($_POST['station_id']);
    $station_id = mysqli_real_escape_string($con, $station_id);

    $ddRecurring = stripslashes($_POST['ddRecurring']);
    $ddRecurring = mysqli_real_escape_string($con, $ddRecurring);

    $start_at = stripslashes($_POST['starts_at']);
    $start_at = mysqli_real_escape_string($con, $start_at);

    $until_date = stripslashes($_POST['ends_at']);
    $until_date = mysqli_real_escape_string($con, $until_date);

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

    
    $content = $row3['template_content'];
    $content = mysqli_real_escape_string($con, $content);
  
    $checklist_template_id = $row3["id"];
    $checklist_template_id = (int) mysqli_real_escape_string($con, $checklist_template_id);
    

    $date = date("Y-m-d H:i:s");

    $assigned_to = stripslashes($_POST['assigned_to']);
    $assigned_to = mysqli_real_escape_string($con, $assigned_to);

    $username = stripslashes($_POST['username']);
    $username = mysqli_real_escape_string($con, $username);

    $groupId = round(microtime(true) * 1000);
    $is_recurring = 0;
        
    $r = new When\When();
    $r->startDate(new DateTime($start_at))
    ->rrule("FREQ=WEEKLY");
    $occurrences = $r->getOccurrencesBetween(new DateTime($start_at),
        new DateTime($until_date));
      
    
    if (strcmp($ddRecurring,"singleEvent")!=0) {
        $is_recurring = 1;

        $dt = new DateTime($until_date);
        $dt->setTimezone(new DateTimeZone('UTC'));
        $until_date = $dt->format('Ymd\THis\Z');

        $rrule;
        if (strcmp($ddRecurring, 'firstmondayofmonth') == 0) {
            $rrule = 'FREQ=MONTHLY;INTERVAL=1;BYDAY=1MO;UNTIL=' . $until_date;
            
            $year = date('Y', strtotime($start_at));
            $month = date('m', strtotime($start_at));
            
            $f_occur = getFirstMonday($month, $year);
            
            $next_date = date('Y-m-d H:i:s', strtotime('+1 month', strtotime($start_at)));
            $n_month = date('m', strtotime($next_date));
            $n_year = date('Y', strtotime($next_date));
            
            $n_occur = getFirstMonday($n_month, $n_year);
            
            
            if ($date > $start_at || $date > $f_occur) {
                $first_occ = $n_occur;
            } else {
                $first_occ = $f_occur;
            }
            
        } else if (strcmp($ddRecurring, 'firstdateofmonth') == 0) {
            $rrule = 'FREQ=MONTHLY;INTERVAL=1;BYMONTHDAY=1;UNTIL=' . $until_date;
            $first_date =  date("Y-m-01", strtotime($start_at));
            if($first_date == $start_at)
            {
                $first_occ = $start_at;
            }else{
                $next_date = date('Y-m-d H:i:s', strtotime('+1 month', strtotime($start_at)));
                $first_date =  date("Y-m-01", strtotime($next_date));
                $first_occ = $first_date;
            }
            
        } else if (strcmp($ddRecurring, 'everyweekmonday') == 0) {
            $rrule = 'FREQ=WEEKLY;INTERVAL=1;BYDAY=MO;UNTIL=' . $until_date;
            $first_occ = $start_at;
        }
                

        $r = new When\When();
        try{
        $r->startDate(new DateTime($first_occ))
            ->rrule($rrule)
            ->generateOccurrences();
        }catch (Exception $e){
            echo 'Caught Error: ',  $e->getMessage(), "\n";
        }

        $occurrences = $r->occurrences;
        foreach ($occurrences as $value) {

            $start_date = $value->format('Y-m-d H:i:s');
            $start_date = mysqli_real_escape_string($con, $start_date);

            $end_date = $start_date;

            $qry = "INSERT INTO `checklist` (`id`, `name`, `create_date`, `created_by`, `type`, `station_id`, `maintenance_time`, `checklist_template_id`,`checklist_content`) 
            VALUES (NULL, '$taskname', '$date', '$username', '$st_type', '$station_id', '$start_date', '$checklist_template_id','$content')";

            if ($con->query($qry) === TRUE) {

                $checklist_id = $con->insert_id;

                $sql = "INSERT INTO `tasks` (`id`, `name`,`description`, `number`, `assigned_to`, `created_by`, `create_date`, `reassigned_to`, `status`, `start_date`, `end_date`,  `checklist_id`,
                    `rrule`, `is_recurring`, `group_id`,`comments`,`stations_id`) VALUES (NULL, '$taskname','$taskdesc', 'NULL', '$assigned_to', '$username', '$date', '$assigned_to', 'Open', '$start_date', '$end_date',
                     '$checklist_id', '$rrule', '$is_recurring','$groupId','','$station_id')";

               
                if ($con->query($sql) === TRUE) {
                    echo "Task created successfully";
                } else {
                    echo "Error creating task: " . $con->error;
                }
            } else {
                echo "Error creating checklist: " . $con->error;
            }
        }
    } else if(strcmp($ddRecurring,"singleEvent")==0){
        $qry = "INSERT INTO `checklist` (`id`, `name`, `create_date`, `created_by`, `type`, `station_id`, `maintenance_time`, `checklist_template_id`,`checklist_content`)
            VALUES (NULL, '$taskname', '$date', '$username', '$st_type', '$station_id', '$start_at', '$checklist_template_id','$content')";
        echo $qry;
        if ($con->query($qry) === TRUE) {

            $checklist_id = $con->insert_id;

            $sql = "INSERT INTO `tasks` (`id`, `name`,`description`, `number`, `assigned_to`, `created_by`, `create_date`, `reassigned_to`, `status`, `start_date`, `end_date`, `checklist_id`, `rrule`, `is_recurring`,
                       `group_id`, `comments`, `stations_id`) VALUES (NULL, '$taskname','$taskdesc', 'NULL', '$assigned_to', '$username', '$date', '$assigned_to', 'Open', '$start_at', '$until_date', 
                     '$checklist_id', '$rrule', '$is_recurring','$groupId','','$station_id')";

            if ($con->query($sql) === TRUE) {
                echo "Task created successfully";
            } else {
                echo "Error creating task: " . $con->error;
            }
        } else {
            echo "Error creating checklist: " . $con->error;
        }
    }
}

function getFirstMonday($month, $year)
{
    return date('Y-m-d H:i:s', strtotime('First Monday ' . date('F o', @mktime(0, 0, 0, $month, 1, $year))));
}

?>

