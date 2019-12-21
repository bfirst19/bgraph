<?php
require ('../config/db.php');
session_start();

if (isset($_POST['task_id'])) {

    $task_id = stripslashes($_POST['task_id']);
    $task_id = mysqli_real_escape_string($con, $task_id);

    $comment = stripslashes($_POST['comment']);
    $comment = mysqli_real_escape_string($con, $comment);

    $project_manager = stripslashes($_POST['project_manager']);
    $project_manager = mysqli_real_escape_string($con, $project_manager);

    $checklist_id = stripslashes($_POST['checklist_id']);
    $checklist_id = mysqli_real_escape_string($con, $checklist_id);

    $doc2Html = stripslashes($_POST['doc2Html']);

    echo $project_manager;

    $action = stripslashes($_POST['action']);
    if (strcmp($action, "approveTask") == 0) {
        changeTaskApproved($con, $task_id, "Completed", $comment, $checklist_id, $doc2Html);
    } elseif (strcmp($action, "rejectTask") == 0) {
        changeTaskRejected($con, $task_id, "Rejected", $comment, $checklist_id);
    } elseif (strcmp($action, "completeTask") == 0) {
        // changeTaskStatus($con,$task_id, "For Approval",$comment);
        changeApprover($con, $task_id, "For Approval", $comment, $project_manager, $checklist_id);
    }
}

/**
 *
 * @param unknown $con
 * @param unknown $id
 * @param unknown $status
 * @param unknown $comment
 * @param unknown $checklist_id
 */
function changeTaskApproved($con, $id, $status, $comment, $checklist_id, $doc2Html)
{
    $created_by = stripslashes($_SESSION['username']);
    $created_by = mysqli_real_escape_string($con, $created_by);

    $sql = "UPDATE `tasks` SET `status`='$status',`comments`='$comment' WHERE `id`='$id'";
    $create_date = date("Y-m-d H:i:s");    
    $conResult = mysqli_query($con, $sql) or die(mysqli_error($con));
    
    savePdfFile($con,$task_id,$checklist_id);
}

function savePdfFile($con,$task_id,$checklist_id){
    $location = "/home/sel/vault/checklist/";
    $milliseconds = round(microtime(true) * 1000);    
    $fname =$milliseconds.'_'.$task_id.'.pdf';
    
    if(!empty($_FILES['pdf'])){
        move_uploaded_file(
            $_FILES['pdf']['tmp_name'],
            $location .$fname
            );
        
        $filepath = $location.$fname;
        // update mnt_report
        $qry = "UPDATE `mnt_report` SET `html`='$doc2Html',`pdf`='$filepath' WHERE `checklist_id`='$checklist_id'";
        if ($con->query($qry) === TRUE) {
            echo "Record approved successfully";
        } else {
            echo "Error adding record:" . $con->error;
            ;
        }
        
        return "Pdf was successfully saved.";
    } else {
        return "No Data Sent";
    }
}

function creatWordFile($con,$id,$doc2Html,$checklist_id)
{
    $milliseconds = round(microtime(true) * 1000);
    $file_name = $milliseconds.'_'.$id.'.pdf';
    
    $vault_location = '/home/sel/vault/checklist/';
    
    require_once ('../tcpdf/tcpdf_include.php');
    // create new PDF document
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    // set document information
    /*$pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Nicola Asuni');
    $pdf->SetTitle('TCPDF Example 006');
    $pdf->SetSubject('TCPDF Tutorial');
    $pdf->SetKeywords('TCPDF, PDF, example, test, guide');*/
    // set default header data
    //$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
    // set header and footer fonts
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
    // set default monospaced font
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
    // set margins
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
    // set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
    // set image scale factor
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
    // set some language-dependent strings (optional)
    if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
        require_once(dirname(__FILE__).'/lang/eng.php');
        $pdf->setLanguageArray($l);
    }
    // ---------------------------------------------------------
    // set font
    $pdf->SetFont('dejavusans', '', 10);
    // add a page
    $pdf->AddPage();
    
    // output the HTML content
    $pdf->writeHTML($doc2Html, true, false, true, false, '');
    
    $flocation = $vault_location.$file_name;
    
    $pdf->Output($flocation, 'F');
    
   
    // update mnt_report
    $qry = "UPDATE `mnt_report` SET `html`='$doc2Html',`pdf`='$flocation' WHERE `checklist_id`='$checklist_id'";
    
    if ($con->query($qry) === TRUE) {
        echo "Record approved successfully";
    } else {
        echo "Error adding record:" . $con->error;
        ;
    }
    
   
}

function changeTaskRejected($con, $id, $status, $comment, $checklist_id)
{
    $created_by = stripslashes($_SESSION['username']);
    $created_by = mysqli_real_escape_string($con, $created_by);

    $sql = "UPDATE `tasks` SET `status`='$status',`comments`='$comment' WHERE `id`='$id'";

    $create_date = date("Y-m-d H:i:s");

    if ($con->query($sql) === TRUE) {
        echo "Record rejected successfully";
    } else {
        echo "Error rejecting record:" . $con->error;
        ;
    }
}

function changeApprover($con, $id, $status, $comment, $reassigned_to)
{
    $created_by = stripslashes($_SESSION['username']);
    $created_by = mysqli_real_escape_string($con, $created_by);

    $sql = "UPDATE `tasks` SET `status`='$status',`comments`='$comment' ,`reassigned_to`='$reassigned_to' WHERE `id`='$id'";

    $create_date = date("Y-m-d H:i:s");

    if ($con->query($sql) === TRUE) {
        echo "Record reassigned successfully";
    } else {
        echo "Error reassign record:" . $con->error;
        ;
    }
}

?>