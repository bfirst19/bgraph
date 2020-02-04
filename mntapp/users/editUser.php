<?php 
require('../config/db.php');
session_start();

//file_put_contents('/home/sel/php_debug.log',$_POST['username']);

if (isset($_POST['1'])){
    $euser_id = stripslashes($_POST['1']);
    $euser_id = mysqli_real_escape_string($con,$euser_id);
    
    $firstname = stripslashes($_POST['4']);
    $firstname = mysqli_real_escape_string($con,$firstname);
    $lastname = stripslashes($_POST['5']);
    $lastname = mysqli_real_escape_string($con,$lastname);
    
    $username = stripslashes($_POST['2']);
    $username = mysqli_real_escape_string($con,$username);
    $email = stripslashes($_POST['3']);
    $email = mysqli_real_escape_string($con,$email);
    $password = stripslashes($_POST['6']);
    $password = mysqli_real_escape_string($con,$password);
    
    $user_role = stripslashes($_POST['7']);
    $user_role = mysqli_real_escape_string($con,$user_role);
    $user_org = stripslashes($_POST['8']);
    $user_org = mysqli_real_escape_string($con,$user_org);
    
    $project_id = stripslashes($_POST['9']);
    $project_id = mysqli_real_escape_string($con,$project_id);
    
    
    //query role
    $roleQry = "SELECT * FROM roles WHERE name='$user_role' LIMIT 1";
    $resultRole = mysqli_query($con,$roleQry);
    $row1 = mysqli_fetch_assoc($resultRole);
    $user_role = $row1["id"];
    echo $user_role;
    //query organization
    $orgQry = "SELECT * FROM organizations WHERE name='$user_org' LIMIT 1";
    $resultOrg = mysqli_query($con,$orgQry);
    $row2 = mysqli_fetch_assoc($resultOrg);
    $user_org = $row2['id'];
    
    //query project
    $prQry = "SELECT * FROM projects WHERE number='$project_id' LIMIT 1";
    $resultPr = mysqli_query($con,$prQry);
    $row3 = mysqli_fetch_assoc($resultPr);
    $project_id = $row3['id'];
    
    
    $create_date = date("Y-m-d H:i:s");
    
    if(isset($password)){
    	$qry = "UPDATE `users` SET `username` = '$username', `email` = '$email',
 		`password` = '".md5($password)."', `create_date` ='$create_date', `first_name` = '$firstname', 
		`last_name` = '$lastname', `is_active` = '', `organizations_id` = '$user_org',`projects_id`='$project_id', 
			`roles_id` = '$user_role' WHERE `id` = '$euser_id'";
    }else{
    	$qry = "UPDATE `users` SET `username` = '$username', `email` = '$email', `create_date` ='$create_date', `first_name` = '$firstname', 
    	`last_name` = '$lastname', `is_active` = '', `organizations_id` = '$user_org',`projects_id`='$project_id', 
		`roles_id` = '$user_role' WHERE `id` = '$euser_id'";
    }
    
    
    
    //$result = mysqli_query($con,$query);
    if($con->query($qry) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $con->error;
    }
}
?>