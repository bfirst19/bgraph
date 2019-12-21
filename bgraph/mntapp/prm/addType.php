<?php
require ('../config/db.php');
session_start();

if (isset($_POST['2'])) {
    $type = stripslashes($_POST['2']);
    $type = mysqli_real_escape_string($con, $type);
    
    $checklist_id = stripslashes($_POST['3']);
    $checklist_id = mysqli_real_escape_string($con, $checklist_id);
    
 
    if (!empty($type)) {
        $sql = "INSERT INTO `station_type` (`id`, `type_value`) VALUES (NULL, '$type')";
        // $result=mysqli_query($con,$qry);
        if ($con->query($sql) === TRUE) {
            echo "Record Added successfully";
        } else {
            echo "Error adding record: " . $con->error;
        }
    }
}
?>
