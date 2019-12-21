<!DOCTYPE html>

<html>
<head>
<meta charset="utf-8">
<title>Login</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="../css/bootstrap-material-design.min.css" rel="stylesheet">
<script src="../js/jquery-3.4.1.min.js"></script>
<script src="../js/bootstrap-4.1.3-dist/js/bootstrap.min.js"></script>

</head>
<body>
<?php
session_start();
require ('../config/db.php');

if (isset($_POST['username'])) {
    $username = stripslashes($_REQUEST['username']);
    $username = mysqli_real_escape_string($con, $username);
    $password = stripslashes($_REQUEST['password']);
    $password = mysqli_real_escape_string($con, $password);
    $query = "SELECT * FROM `users` WHERE username='$username'
and password='" . md5($password) . "'";
    $result = mysqli_query($con, $query) or die(mysqli_error($con));
    $rows = mysqli_num_rows($result);
    if ($rows == 1) {
        while ($row = mysqli_fetch_array($result)) {
            $_SESSION['email'] = $row['email'];
            $role_id = $row['roles_id'];
            $query_r = "select * from roles where id ='$role_id'";
            $result_r = mysqli_query($con, $query_r) or die(mysqli_error($con));
            $row_r = mysqli_fetch_assoc($result_r);
            $_SESSION['user_role']=$row_r['name'];
        }

        $_SESSION['username'] = $username;
        $_SESSION['auth'] = "OKAY";
        header("Location: ../doc/dashboard.php");
    } else {
        echo "
<div class='container' style='margin-top: 10vh;'>
        <div class='row align-self-center w-100'>
            <div class='col-6 mx-auto'>
<div class='card'>
                    <div class='card-header'>Login</div><div class='card-body'>
<h6>Username/password is incorrect.</h6>
<br/><h6>Click here to <a href='login.php'>Login</a></div></h6>
 </div></div>
</div></div></div>";
    }
} else {
    ?>

    <div class="cotainer" style="margin-top: 10vh;">
		<div class="row justify-content-center">
			<div class="col-md-6">
				<div class="card">
					<div class="card-header" style="font-size: 2rem;">Login</div>
					<div class="card-body">
						<form action="" method="post" name="login">
							<div class="form-group row">
								<label for="username"
									class="col-md-4 col-form-label text-md-right">Username</label>
								<div class="col-md-6">
									<input type="text" id="username" class="form-control"
										name="username" required autofocus>
								</div>
							</div>

							<div class="form-group row">
								<label for="password"
									class="col-md-4 col-form-label text-md-right">Password</label>
								<div class="col-md-6">
									<input type="password" id="password" class="form-control"
										name="password" required>
								</div>
							</div>


							<div class="col-md-6 offset-md-4">
								<input type="submit" value="Login" name="submit"
									class="btn btn-primary"> <a href="./forgot_password"
									class="btn btn-link"> Forgot Your Password? </a>
							</div>

						</form>
					</div>
				</div>
			</div>
		</div>

	</div>

<?php } ?>
</body>
</html>
