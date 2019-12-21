<?php
require ('../config/db.php');
session_start();

if ($_FILES["csvFile"]["size"] > 0) {
    $errors = array();
    $file_name = $_FILES['csvFile']['name'];
    $file_size = $_FILES['csvFile']['size'];
    $file_tmp = $_FILES['csvFile']['tmp_name'];
    $file_type = $_FILES['csvFile']['type'];
    $tmpn = explode('.', $file_name);
    $file_ext = strtolower(end($tmpn));

    $expensions = array(
        "csv"
    );

    if (in_array($file_ext, $expensions) === false) {
        $errors[] = "extension not allowed, please choose a csv file.";
    }

    if ($file_size > 2097152) {
        $errors[] = 'File size must be excately 2 MB';
    }

    if (empty($errors) == true) {
        if (($handle = fopen($file_tmp, "r")) !== FALSE) {
            while (($column = fgetcsv($handle, 1000, ",")) !== FALSE) {

                $st_id = $column[0];
                // $st_id = mysqli_real_escape_string($con,$st_id);

                $st_name = $column[1];
                // $st_name = mysqli_real_escape_string($con,$st_name);

                $created_by = stripslashes($_SESSION['username']);
                $created_by = mysqli_real_escape_string($con, $created_by);

                $st_type_id = $column[2];
                // $st_type_id = mysqli_real_escape_string($con,$st_type_id);

                $st_add = $column[3];
                // $st_add = mysqli_real_escape_string($con,$st_add);

                $st_lat = $column[4];
                // $st_lat = mysqli_real_escape_string($con,$st_lat);

                $st_lon = $column[5];
                // $st_lon = mysqli_real_escape_string($con,$st_lon);
                                
                $create_date = date("Y-m-d H:i:s");

                $qry = "INSERT INTO `stations` (`id`, `name`, `create_date`, `created_by`, `station_id`,
                 `station_address`,`station_type_id`,`lat`,`lon`) VALUES (NULL, '$st_name','$create_date', '$created_by',
                 '$st_id','$st_add', '$st_type_id','$st_lat','$st_lon')";

                //$result = mysqli_query($con, $qry);

                               
                if($con->query($qry) === TRUE) {
                    $type = "success :";
                    $message = "CSV Data Imported into the Database";
                } else {
                    $type = "error :";
                    $message = "Problem in Importing CSV Data".$con -> error;
                }
                
                echo $type.$message;
            }

            fclose($handle);
        }

       
    } else {
        print_r($errors);
    }
}
// echo "2";

?>