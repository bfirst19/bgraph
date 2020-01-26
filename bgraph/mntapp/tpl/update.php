   <?php
require ('../config/db.php');
session_start();

// file_put_contents('/home/sel/php_debug.log',$_POST["created_by"]);
if (isset($_GET['chkl_id'])) {
    $id = stripslashes($_GET['chkl_id']);
    $id = mysqli_real_escape_string($con, $id);
    
    $name = stripslashes($_POST['template_name']);
    $name = mysqli_real_escape_string($con, $name);

    $jsondata = $_POST['jsonData'];
    $jsondata = mysqli_real_escape_string($con, $jsondata);

    $created_by = stripslashes($_SESSION['username']);
    $created_by = mysqli_real_escape_string($con, $created_by);

    $stationType = stripslashes($_POST['stationType']);
    $stationType = mysqli_real_escape_string($con, $stationType);

    $create_date = date("Y-m-d H:i:s");
    
    echo $id;
    echo $jsondata;
    $qry = "update `checklist_template` set `template_content`='$jsondata', where `id`='$id'";
    // echo $jsondata;
    // $result = mysqli_query($con,$query);
    if ($con->query($qry) === TRUE) {
        echo "Record created successfully";
    } else {
        echo "Error creating record: " . $con->error;
    }
}
?>

