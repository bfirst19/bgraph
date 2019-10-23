<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
/*
Tested working with PHP5.4 and above (including PHP 7 )

 */

require_once '../config/db.php';



if (isset($_REQUEST['taskname'])){
	$taskname = stripslashes($_REQUEST['taskname']);
	$taskname = mysqli_real_escape_string($con,$taskname); 
	$task_desc = stripslashes($_REQUEST['task_desc']);
	$task_desc = mysqli_real_escape_string($con,$task_desc);
	$location = stripslashes($_REQUEST['location']);
	$location = mysqli_real_escape_string($con,$location);
  $create_date = date("Y-m-d H:i:s");
  $scheduled_date = date("Y-m-d H:i:s");
  /*
  INSERT INTO `tasks` (`id`, `name`, `title`, `description`, `location`, `status`, `completed_by`, 
  `assigned_to`, `scheduled_date`, `user_id`) VALUES (NULL, '', '', '', '', '', '', '', CURRENT_TIMESTAMP, '')*/
/*
  INSERT INTO `users` (`id`, `username`, `email`, `password`, `create_date`, `user_type`, `first_name`, `last_name`, `is_active`) VALUES (NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL)
*/
        $query = "INSERT into `tasks` (name,title,description,location,scheduled_date)
VALUES ('$taskname', 'test title','$task_desc', '$location', '$scheduled_date')";
        $result = mysqli_query($con,$query);
        if(!$result){
        		  
      echo"Error description: " . mysqli_error($con);		
        }else{
echo"Created Task ..";
        }
}
/*use FormGuide\Handlx\FormHandler;


$pp = new FormHandler();

$validator = $pp->getValidator();
$validator->fields(['name','email'])->areRequired()->maxLength(50);
$validator->field('email')->isEmail();
$validator->field('message')->maxLength(6000);




$pp->sendEmailTo('someone@gmail.com'); // ← Your email here

echo $pp->process($_POST);*/