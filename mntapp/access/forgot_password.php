
<!DOCTYPE html>

<html>
<head>
<meta charset="utf-8">
<title>Login</title>


<link href="../css/bootstrap-4.1.3-dist/css/bootstrap.min.css"
	rel="stylesheet" id="bootstrap-css">
<script src="../js/bootstrap-4.1.3-dist/js/bootstrap.min.js"></script>
<script src="../js/jquery-3.4.1.min.js"></script>
<link href="../css/bg-admin.css" rel="stylesheet">

<link rel="stylesheet" media="screen, print"
	href="../css/vendors.bundle.css">
<link rel="stylesheet" media="screen, print"
	href="../css/theme-demo.css">
</head>

<?php
session_start();
require ('../config/db.php');

if(isset($_POST['submit']))
{
    $user_id = $_POST['username'];
    $result = mysqli_query($conn,"SELECT * FROM users where username='" . $_POST['username'] . "'");
    $row = mysqli_fetch_assoc($result);
    $fetch_user_id=$row['username'];
    $email_id=$row['email'];
    $password=$row['password'];
    if($user_id==$fetch_user_id) {
        $to = $email_id;
        $subject = "Password";
        $txt = "Your password is : $password.";
        $headers = "From: mrpselv@gmail.com" . "\r\n" ;            
        mail($to,$subject,$txt,$headers);
        
        header("Location: ../access/login.php");
    }
    else{
        echo 'invalid userid';
    }
}
?>

<body>
	<div class="cotainer" style="margin-top: 10vh;">
		<div class="row justify-content-center">
			<div class="col-md-6">
				<div class="card">
					<div class="card-header" style="font-size: 1.5rem;">Forgot password</div>
					<div class="card-body">
						<form>
							<div class="form-group">
								<label class="form-label" for="username">User id</label> <input
									type="text" id="username" name="username" class="form-control">
							</div>

							<div class="form-group">
								<button type="submit" name="sendMail" id="sendMail"
									class="btn btn-info btn-sm mr-1">Send me password in email</button>
							</div>

						</form>
					</div>
				</div>
			</div>
		</div>

	</div>
</body>
</html>