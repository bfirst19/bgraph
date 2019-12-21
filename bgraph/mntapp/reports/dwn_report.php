<?php 
session_start();
require ('../config/db.php');
if (isset($_POST['starts_at'])||isset($_POST['ends_at'])) {   
    $filepath = '/home/sel/vault/checklist/1576430487577_0001823.pdf';
    
    /*if(file_exists($filepath)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.basename($filepath).'"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filepath));
        flush(); // Flush system output buffer
        readfile($filepath);
        exit;
    }*/
    $fp = @fopen($filepath, 'rb');
    
    if (strstr($_SERVER['HTTP_USER_AGENT'], "MSIE"))
    {
        header('Content-Type: "application/octet-stream"');
        header('Content-Disposition: attachment; filename="'.basename($filepath).'"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header("Content-Transfer-Encoding: binary");
        header('Pragma: public');
        header("Content-Length: ".filesize($filepath));
    }
    else
    {
        header('Content-Type: "application/octet-stream"');
        header('Content-Disposition: attachment; filename="'.basename($filepath).'"');
        header("Content-Transfer-Encoding: binary");
        header('Expires: 0');
        header('Pragma: no-cache');
        header("Content-Length: ".filesize($filepath));
    }
    
    fpassthru($fp);
    fclose($fp);
}

?>