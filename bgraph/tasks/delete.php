<?php 
require('../config/db.php');

$id = $_POST['del_id'];

//echo $music_number;
$qry = "DELETE FROM tasks WHERE id ='$id'";
//$result=mysqli_query($con,$qry);
if($con->query($qry) === TRUE) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . $con->error;
}
?>
