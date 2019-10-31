<?php 
require('../config/db.php');

$roleid = $_POST['del_id'];
//echo $music_number;
$qry = "DELETE FROM roles WHERE id ='$roleid'";
$result=mysqli_query($con,$qry);
if($con->query($qry) === TRUE) {    
    echo "Record deleted successfully";
} else {
    echo  "Error deleting record:".$con->error;;   
}
?>
