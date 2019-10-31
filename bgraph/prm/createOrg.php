<?php 
require('../config/db.php');


//file_put_contents('/home/sel/php_debug.log',$_POST["created_by"]);

if (isset($_POST['org_name'])){
    $orgname = stripslashes($_POST['org_name']);
    $orgname = mysqli_real_escape_string($con,$orgname);
      
    $created_by  = stripslashes($_POST['created_by']);
    $created_by = mysqli_real_escape_string($con,$created_by);
    
    $create_date = date("Y-m-d H:i:s");
    $query = "INSERT into `organizations` (name,create_date,created_by)
VALUES ('$orgname', '$create_date','$created_by')";
    $result = mysqli_query($con,$query);
    if(!$result){
        
        echo"Error description: " . mysqli_error($con);
        ?>
		 <input type="button" class="btn btn-dark"" VALUE="Close"
        onclick="window.location.href='../index'"> 
		  
<?php
        }
    }
?>