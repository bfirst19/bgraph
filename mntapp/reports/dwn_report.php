<?php
session_start();
require ('../config/db.php');

if (isset($_POST['starts_at'])) {    
   // $filepath = '/home/sel/vault/checklist/1576901162677_0001829.pdf';

    /*
     * if(file_exists($filepath)) {
     * header('Content-Description: File Transfer');
     * header('Content-Type: application/octet-stream');
     * header('Content-Disposition: attachment; filename="'.basename($filepath).'"');
     * header('Expires: 0');
     * header('Cache-Control: must-revalidate');
     * header('Pragma: public');
     * header('Content-Length: ' . filesize($filepath));
     * flush(); // Flush system output buffer
     * readfile($filepath);
     * exit;
     * }
     */

    
    /*
     * $fp = @fopen($filepath, 'rb');
     *
     * if (strstr($_SERVER['HTTP_USER_AGENT'], "MSIE"))
     * {
     * header('Content-Type: "application/octet-stream"');
     * header('Content-Disposition: attachment; filename="'.basename($filepath).'"');
     * header('Expires: 0');
     * header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
     * header("Content-Transfer-Encoding: binary");
     * header('Pragma: public');
     * header("Content-Length: ".filesize($filepath));
     * }
     * else
     * {
     * header('Content-Type: "application/octet-stream"');
     * header('Content-Disposition: attachment; filename="'.basename($filepath).'"');
     * header("Content-Transfer-Encoding: binary");
     * header('Expires: 0');
     * header('Pragma: no-cache');
     * header("Content-Length: ".filesize($filepath));
     * }
     *
     * fpassthru($fp);
     * fclose($fp);
     */

    /*
     * // Use basename() function to return the base name of file
     * $file_name = basename($filepath);
     *
     * // Use file_get_contents() function to get the file
     * // from url and use file_put_contents() function to
     * // save the file by using base name
     * if(file_put_contents($file_name,file_get_contents($filepath))) {
     * echo "File downloaded successfully";
     * }
     * else {
     * echo "File downloading failed.";
     * }
     */

    $start_date = $_POST['starts_at'];
    $report_type = $_POST['report_type'];

    // SELECT * FROM objects WHERE Date LIKE '$_POST[period]-%';

    $period = explode('-', $start_date);

   // echo $period;
    $yr = $period[0];
    $mo = $period[1];
    $prep_stmt = "select *from mnt_report where YEAR(maintenance_date) = '$yr' AND MONTH(maintenance_date) = '$mo'";    
    $result = mysqli_query($con, $prep_stmt) or die(mysqli_error($con));
    $row = mysqli_fetch_assoc($result);
    $filepath =  $row["pdf"];
        

    if (file_exists($filepath)) {
        header('Content-Description: File Transfer');
       // header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="' . basename($filepath) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filepath));
        flush(); // Flush system output buffer
        readfile($filepath);
        exit();
    }else{   
       // $referer_url =  $_SERVER['HTTP_REFERER'];
        header('Location: ./queryReport');
    }
}

?>