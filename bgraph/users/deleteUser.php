<?php 
require('../config/db.php');

$id = $_POST['del_id'];
//echo $music_number;
$id = stripslashes($_POST['1']);
$id = mysqli_real_escape_string($con,$id);

$qry = "DELETE FROM users WHERE id ='$id'";
//$result=mysqli_query($con,$qry);
if($con->query($qry) === TRUE) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . $con->error;
}
?>
