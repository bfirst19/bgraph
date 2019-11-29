<?php
require ('../config/db.php');
session_start();

if (isset($_POST['type'])) {
    $type = stripslashes($_POST['type']);
    $type = mysqli_real_escape_string($con, $type);
 
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
