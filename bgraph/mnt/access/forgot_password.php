
<!DOCTYPE html>

<html>
<head>
<meta charset="utf-8">
<title>Login</title>


<link href="../css/bootstrap-4.1.3-dist/css/bootstrap.min.css"
	rel="stylesheet" id="bootstrap-css">
<script src="../js/bootstrap-4.1.3-dist/js/bootstrap.min.js"></script>
<script src="../js/jquery-3.4.1.min.js"></script>
<link href="../csss/bg-admin.css" rel="stylesheet">


</head>
<body>
<?php
if(isset($_GET['code'])) $acode = $_GET['code'];
else die("No code!");

$con=mysqli_connect("xxx","xxx","xxx","xxx");
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
} else {
    $acode = mysqli_real_escape_string($con, $acode);
    $query = mysqli_query($con,"select * from login where activation_code='$acode'")
    or die(mysqli_error($con)); 
    if(mysqli_num_rows($query) == 0) {
        echo "Wrong code";
        die();
    } elseif (mysqli_num_rows ($query)==1 && isset($_POST['pass'])) {
        $pass = mysqli_real_escape_string($con, $_POST['pass']);
        $query3 = mysqli_query($con,"update login set Password='$pass' where activation_code='$acode'")
        or die(mysqli_error($con)); 

        echo 'Password Changed';
    }
}

?>

    enter code here
    <form action="resetpass.php?code=<?php echo $_GET['code'];?>" method="POST">
    <p>New Password:</p><input type="password" name="pass" />
    <input type="submit"  name="submit" value="Signup!" />
    </form>
    
    </body>
</html>