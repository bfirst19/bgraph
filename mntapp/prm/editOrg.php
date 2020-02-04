<?php
require('../config/db.php');
session_start();

//file_put_contents('/home/sel/php_debug.log',$_POST['username']);

if (isset($_POST['1'])){
    $orgname = stripslashes($_POST['2']);
    $orgname = mysqli_real_escape_string($con,$orgname);
    
    $orgid = stripslashes($_POST['1']);
    $orgid = mysqli_real_escape_string($con,$orgid);
    
    $created_by  = stripslashes($_SESSION['username']);
    $created_by = mysqli_real_escape_string($con,$created_by);
    
    $create_date = date("Y-m-d H:i:s");
    //$qry = "UPDATE  `orgs` set `name`=$orgname WHERE `id`=$orgid";
    $qry  = "UPDATE `organizations` SET `name`='$orgname' WHERE id='$orgid'";
   
    //$result = mysqli_query($con,$query);
    if($con->query($qry) === TRUE) {
        echo "Record edited successfully";
    } else {
        echo "Error editing record:".$con->error;;
    }
}
?>