<?php
require ('../config/db.php');

$id = $_POST['del_id'];
$deleteAction = $_POST['deleteAction'];

$qryTsk = "SELECT * from tasks where id='$id'";
$qryTskRst = mysqli_query($con, $qryTsk);
$row = mysqli_fetch_assoc($qryTskRst);

$grpId = $row['group_id'];
$grpId = mysqli_real_escape_string($con,$grpId);

if (strcmp($deleteAction, "delAll")==0) {
    // echo $music_number;
    $qry = "DELETE FROM tasks WHERE group_id ='$grpId'";
    // $result=mysqli_query($con,$qry);
    if ($con->query($qry) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $con->error;
    }
} else {

    // echo $music_number;
    $qry = "DELETE FROM tasks WHERE id ='$id'";
    // $result=mysqli_query($con,$qry);
    if ($con->query($qry) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $con->error;
    }
}
?>


s