<?php 


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
}
?>