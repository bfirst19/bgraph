<?php
require('../config/db.php');
session_start();

$roleid = stripslashes($_POST['1']);
$roleid = mysqli_real_escape_string($con,$roleid);

//echo $music_number;
echo $roleid;
$qry = "DELETE FROM roles WHERE id ='$roleid'";
//$result=mysqli_query($con,$qry);
if($con->query($qry) === TRUE) {
    echo  "Record deleted successfully";
} else {
    echo  "Error deleting record:".$con->error;;
}
?>
