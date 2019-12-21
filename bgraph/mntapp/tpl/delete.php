<?php
require ('../config/db.php');

echo ($_POST);
$id = stripslashes($_POST['1']);
$id = mysqli_real_escape_string($con,$id);

// echo $music_number;
$qry = "DELETE FROM checklist_template WHERE id ='$id'";
// $result=mysqli_query($con,$qry);
if ($con->query($qry) === TRUE) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . $con->error;
}
?>


s