<?php 

require ('../config/db.php');
session_start();
/*

$pdf = $_FILES['data'];
 echo 'datta'.$pdf;
if(isset($pdf)){
	$location = "/home/sel/vault/";
	//move_uploaded_file($pdf, $location.'random-name.pdf');
	$data = $_POST['data'];
	$data = base64_decode($data);
	$fname = "test.pdf"; // name the file
	$file = fopen($location.$fname, 'w'); // open the file path
	fwrite($file, $data); //save data
	fclose($file);
	echo "Bell Quote saved";   
}else{
    echo $pdf."Bell Quote no saved";   
}*/

$location = "/home/sel/vault/checklist/";
$task_id=$_POST['task_id'];
$checklist_id=$_POST['checklist_id'];
$milliseconds = round(microtime(true) * 1000);

$comment = stripslashes($_POST['comment']);
$comment = mysqli_real_escape_string($con, $comment);

$status = "Completed";

$fname =$milliseconds.'_'.$task_id.'.pdf';

if(!empty($_FILES['pdf'])){
    move_uploaded_file(
        $_FILES['pdf']['tmp_name'],
        $location .$fname
        );
    
    $filepath = $location.$fname;   
    
    $sql = "UPDATE `tasks` SET `status`='$status',`comments`='$comment' WHERE `id`='$task_id'";
    $create_date = date("Y-m-d H:i:s");
    $conResult = mysqli_query($con, $sql) or die(mysqli_error($con));
    
    // update mnt_report
    $qry = "UPDATE `mnt_report` SET `html`='$doc2Html',`pdf`='$filepath' WHERE `checklist_id`='$checklist_id'";
    if ($con->query($qry) === TRUE) {
        echo "Record approved successfully";
    } else {
        echo "Error adding record:" . $con->error;        
    }
    
    return "Pdf was successfully saved.";
} else {
    return "No Data Sent";
}

?>

