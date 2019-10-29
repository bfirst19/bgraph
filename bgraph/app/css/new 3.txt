
<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Bluegrap Admin - Dashboard</title>

  
 <link rel="stylesheet" href="../assets/css/shared/style.css">
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="../assets/css/demo_1/style.css">

  <!-- Custom fonts for this template-->
  <link href="../assets/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="../assets/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../css/bg-admin.css" rel="stylesheet">

   <link rel="stylesheet" href="../assets/vendors/iconfonts/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../assets/vendors/iconfonts/ionicons/css/ionicons.css">
    <link rel="stylesheet" href="../assets/vendors/iconfonts/typicons/src/font/typicons.css">
    <link rel="stylesheet" href="../assets/vendors/iconfonts/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.addons.css">

   

  <body id="page-top">
 
  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

	<a class="navbar-brand mr-1" href="../index">BlueGraph</a>
	

	   <button class="btn btn-link btn-sm text-dark order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>
    
   <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
      <div class="input-group">
<h5>	

  Welcome <?php
  echo $_SESSION['username'];	
	?>
</h5>
</div>
</form>
  
  <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
              <a class="nav-link count-indicator" id="notificationDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                <i class="mdi mdi-bell-outline"></i>
                <span class="count">7</span>
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0" aria-labelledby="notificationDropdown">
                <a class="dropdown-item py-3">
                 
                  <p class="mb-0 font-weight-medium float-left">You have 4 new notifications </p>
                  <span class="badge badge-pill badge-primary float-right">View all</span>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <img src="../assets/images/faces/man.jpg" alt="image" class="img-sm profile-pic"> </div>
                  <div class="preview-item-content flex-grow py-2">
                    <p class="preview-subject ellipsis font-weight-medium text-dark">User1</p>
                    <p class="font-weight-light small-text"> The meeting is cancelled </p>
                  </div>
                </a>
                </div>
</li>

       <li class="nav-item dropdown">
              <a class="nav-link count-indicator" id="messagesDropdown" href="#" data-toggle="dropdown">
                <i class="mdi mdi-email-outline"></i>
                <span class="count bg-success">3</span>
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0" aria-labelledby="messagesDropdown">
                <a class="dropdown-item py-3 border-bottom">
                   <p class="mb-0 font-weight-medium float-left">You have 7 unread mails </p>
                  <span class="badge badge-pill badge-primary float-right">View all</span>
                </a>
                <a class="dropdown-item preview-item py-3">
                  <div class="preview-thumbnail">
                    <i class="mdi mdi-alert m-auto text-primary"></i>
                  </div>
                  <div class="preview-item-content">
                    <h6 class="preview-subject font-weight-normal text-dark mb-1">Application Error</h6>
                    <p class="font-weight-light small-text mb-0"> Just now </p>
                  </div>
                </a>
                </div>
                </li>

                <li class="nav-item dropdown d-none d-xl-inline-block user-dropdown">
              <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                <img class="img-xs rounded-circle" src="../assets/images/faces/man.jpg" alt="Profile image"> </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                <div class="dropdown-header text-center">
                  <img class="img-md rounded-circle" src="../assets/images/faces/man.jpg" alt="Profile image">
                  <p class="mb-1 mt-3 font-weight-semibold"><?php echo $_SESSION['username']; ?></p>
                  <p class="font-weight-light text-muted mb-0">user1@bgraph.com</p>
                </div>
               <!-- <a class="dropdown-item">My Profile <span class="badge badge-pill badge-danger">1</span><i class="dropdown-item-icon ti-dashboard"></i></a>
                <a class="dropdown-item">Messages<i class="dropdown-item-icon ti-comment-alt"></i></a>
                <a class="dropdown-item">Activity<i class="dropdown-item-icon ti-location-arrow"></i></a>
                <a class="dropdown-item">FAQ<i class="dropdown-item-icon ti-help-alt"></i></a> -->
                <a class="dropdown-item" href="../user/logout">Sign Out<i class="dropdown-item-icon ti-power-off"></i></a>
              </div>
            </li>
</ul>


	  </nav>



	  <div id="wrapper">

	   <ul class="sidebar navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="../index">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-fw fa-user"></i>
          <span>Users</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
          <h6 class="dropdown-header">User Management:</h6>
          <a class="dropdown-item" href="../user/registration.php">Create user</a>
          <a class="dropdown-item" href="../user/edituser.php">Modify user</a>
          <a class="dropdown-item" href="../task/mytasks.php">Assigned tasks</a>
          <!--div class="dropdown-divider"></div>
          <h6 class="dropdown-header">Other Pages:</h6>
          <a class="dropdown-item" href="404.html">404 Page</a>
          <a class="dropdown-item" href="blank.html">Blank Page</a>
        </div-->
      </li>

       <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-fw fa-tasks"></i>
          <span>Tasks</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
          <h6 class="dropdown-header">Task Management:</h6>
          <a class="dropdown-item" href="../task/mytasks.php">My tasks</a>
          <a class="dropdown-item" href="../task/createtask.php">Create new task</a>
          <a class="dropdown-item" href="../task/uploadedtasks.php">Uploaded tasks</a>          
          <a class="dropdown-item" href="../task/completedtasks.php">Completed tasks</a>
                  
        </div-->
      </li>     
	</ul>
	

	<div id="content-wrapper">
      <div class="container-fluid">
<?php
require('../config/db.php');

if (isset($_REQUEST['username'])){
	$username = stripslashes($_REQUEST['username']);
	$username = mysqli_real_escape_string($con,$username); 
	$email = stripslashes($_REQUEST['email']);
	$email = mysqli_real_escape_string($con,$email);
	$password = stripslashes($_REQUEST['password']);
	$password = mysqli_real_escape_string($con,$password);
	$create_date = date("Y-m-d H:i:s");
        $query = "INSERT into `users` (username,password,email,create_date,user_type,first_name,last_name,is_active)
VALUES ('$username', '".md5($password)."', '$email', '$create_date','','','','')";
        $result = mysqli_query($con,$query);
        if(!$result){
        		  
			echo"Error description: " . mysqli_error($con);		
		?>
		 <input type="button" class="btn btn-dark"" VALUE="Close"
        onclick="window.location.href='../doc/dashboard'"> 
		  
<?php
        }else{
			 echo "<div class='form'>
<h3>You are registered successfully.</h3>
<br/>Click here to <a href='login'>Login</a></div>";
		}
    }else{
?>

 <div class="card-body">
                    <h4 class="card-title">Create</h4>                   
                    <form class="forms-sample" action="" method="post">
                      <div class="form-group">
                        <label for="username">Task Name</label>                        
						<input type="text" class="form-control" id="taskname" name="taskname" placeholder="Username" required />
                      </div>
                      <div class="form-group">
                        <label for="email">Email address</label>                        
						 <input type="text" class="form-control" id="email" name="email" placeholder="Email Adress">
						 
                      </div>
                      <div class="form-group">
                        <label for="password">Password</label>                        
						<input type="password" class="form-control" name="password" id="password" placeholder="Password">
                      </div>
                      <div class="form-group">
                        <label>File upload</label>
                        <!--input type="file" name="img[]" class="file-upload-default"-->
                        <div class="input-group col-xs-12">
                          <input type="text" class="form-control file-upload-info" disabled="" placeholder="Upload Image" id="profieplaceholder">
                          <span class="input-group-append">
                            <input type="file" id="selectedProfilePic" class="file-upload-browse btn btn-info" placeholder="Upload Image" style="display:none;" oninput="document.getElementById('profieplaceholder').placeholder=document.getElementById('selectedProfilePic').files.item(0).name;" >
                             <button class="file-upload-browse btn btn-info" type="button"  onclick="document.getElementById('selectedProfilePic').click();">Upload</button>
                             
                          </span>
                        </div>
                      </div>                      
                      <div class="form-group">
                        <label for="exampleTextarea1">Textarea</label>
                        <textarea class="form-control" id="exampleTextarea1" rows="2"></textarea>
                      </div>                      
					  <input type="submit" name="submitRegister" value="Register" class="btn btn-success mr-2">                     
                      <input type="button" class="btn btn-outline-dark" VALUE="Cancel"
        onclick="window.location.href='../doc/dashboard'"> 
                    </form>
                  </div>
		  

<?php }  ?>


		</div>
		</div>

		 <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>


  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="../user/login">Logout</a>
        </div>
      </div>
    </div>
  </div>

	</div>


	<!-- Bootstrap core JavaScript-->
  <script src="../assets/jquery/jquery.min.js"></script>
  <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../assets/jquery-easing/jquery.easing.min.js"></script>

  <!-- Page level plugin JavaScript-->
  <script src="../assets/chart.js/Chart.min.js"></script>
  <script src="../assets/datatables/jquery.dataTables.js"></script>
  <script src="../assets/datatables/dataTables.bootstrap4.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../js/bg-admin.min.js"></script>



  </body>

</html>
