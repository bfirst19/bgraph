<?php
require('../config/db.php');


$stid = stripslashes($_POST['1']);
$stid = mysqli_real_escape_string($con,$stid);

//echo $music_number;
$qry = "DELETE FROM station_type WHERE id ='$stid'"; echo $qry;
//$result=mysqli_query($con,$qry);
if($con->query($qry) === TRUE) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . $con->error;
}
?>
