<?php

require ('../config/db.php');
session_start();

$target_dir = "/opt/mnt/vault/images/";
$milliseconds = round(microtime(true) * 1000);

$uploadOk = 1;



function getQueryParameter($url, $param) {
    $parsedUrl = parse_url($url);
    if (array_key_exists('query', $parsedUrl)) {
        parse_str($parsedUrl['query'], $queryParameters);
        if (array_key_exists($param, $queryParameters)) {
            return $queryParameters[$param];
        }
    }
}

$referer_url =  $_SERVER['HTTP_REFERER'];

$task_id=getQueryParameter($referer_url,'id');

$query = "select * from tasks where id ='$task_id'";
$result = mysqli_query($con, $query) or die(mysqli_error($con));
$row = mysqli_fetch_assoc($result);

$st_id = $row["stations_id"];
$st_id = mysqli_real_escape_string($con, $st_id);

$status = $row['status'];
$status = mysqli_real_escape_string($con, $status);

$task_name=$row['name'];
$task_name = mysqli_real_escape_string($con, $task_name);

$main_time=$row['start_date'];

$checklist_id = $row['checklist_id'];
$checklist_id = (int)mysqli_real_escape_string($con,$checklist_id);


if(!empty($_FILES['beforeMaintenance'])){   
    $check = getimagesize($_FILES["beforeMaintenance"]["tmp_name"]);
    $target_file = $target_dir . basename($_FILES["beforeMaintenance"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
      
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        
    echo $target_file;
       
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["beforeMaintenance"]["tmp_name"], $target_file)) {
            echo "The file ". basename( $_FILES["beforeMaintenance"]["name"]). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
    echo  $target_file;
    // update mnt_report
    $prep_stmt = "SELECT * from mnt_report WHERE checklist_id='$checklist_id'";
    // execute query
    $result = mysqli_query($con, $prep_stmt) or die(mysqli_error($con));
    $count = mysqli_num_rows($result);
    
    
    if($count==0){
        $qry = "INSERT INTO `mnt_report` (`id`, `name`, `json`, `html`, `pdf`, `docx`, `maintenance_date`,`before_image`,`after_image`, `checklist_id`)
            VALUES (NULL, '$task_name',NULL,NULL,NULL,NULL,'$main_time','$target_file',NULL,'$checklist_id')";
    }else {
        $qry="UPDATE `mnt_report` SET `before_image`='$target_file' WHERE `checklist_id`='$checklist_id'";
    }
    
   //$qry = "UPDATE `mnt_report` SET `before_image`='$target_file' WHERE `checklist_id`='$checklist_id'";
    if ($con->query($qry) === TRUE) {
        echo "Record approved successfully";
    } else {
        echo "Error adding record:" . $con->error;
    }
    
    return "Image was successfully saved.";
} elseif(!empty($_FILES['afterMaintenance'])){    
    $check = getimagesize($_FILES["afterMaintenance"]["tmp_name"]);
    $target_file = $target_dir . basename($_FILES["afterMaintenance"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        
        echo $target_file;
        
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["afterMaintenance"]["tmp_name"], $target_file)) {
                echo "The file ". basename( $_FILES["afterMaintenance"]["name"]). " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
        echo  $target_file;
        
        // update mnt_report
        $prep_stmt = "SELECT * from mnt_report WHERE checklist_id='$checklist_id'";
        // execute query
        $result = mysqli_query($con, $prep_stmt) or die(mysqli_error($con));
        $count = mysqli_num_rows($result);
        
        
        if($count==0){
            $qry = "INSERT INTO `mnt_report` (`id`, `name`, `json`, `html`, `pdf`, `docx`, `maintenance_date`,`before_image`,`after_image`, `checklist_id`)
            VALUES (NULL, NULL,NULL,NULL,NULL,NULL,'$main_time',NULL,'$target_file','$checklist_id')";
        }else {
            $qry="UPDATE `mnt_report` SET `after_image`='$target_file' WHERE `checklist_id`='$checklist_id'";
        }
        
        //$qry = "UPDATE `mnt_report` SET `before_image`='$target_file' WHERE `checklist_id`='$checklist_id'";
        if ($con->query($qry) === TRUE) {
            echo "Record approved successfully";
        } else {
            echo "Error adding record:" . $con->error;
        }
        
        return "Image was successfully saved.";
} else {
    return "No Data Sent";
}

?>
