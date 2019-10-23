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

	<a class="navbar-brand mr-1" href="../doc/dashboard">Bluegraph</a>
	

	   <button class="btn btn-link btn-sm text-dark order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>
    
   <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
      <div class="input-group">
<h5>	

  Welcome  <?php
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
                  <p class="font-weight-light text-muted mb-0">sample@gmail.com</p>
                </div>
               <!-- <a class="dropdown-item">My Profile <span class="badge badge-pill badge-danger">1</span><i class="dropdown-item-icon ti-dashboard"></i></a>
                <a class="dropdown-item">Messages<i class="dropdown-item-icon ti-comment-alt"></i></a>
                <a class="dropdown-item">Activity<i class="dropdown-item-icon ti-location-arrow"></i></a>
                <a class="dropdown-item">FAQ<i class="dropdown-item-icon ti-help-alt"></i></a> -->
                <!--a class="dropdown-item" href="../user/logout">Sign Out<i class="dropdown-item-icon ti-power-off"></i></a-->
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#settingsModal">Settings<i class="dropdown-item-icon ti-power-off"></i></a>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Sign out<i class="dropdown-item-icon ti-power-off"></i></a>
              </div>
            </li>
</ul>


	  </nav>



	  <div id="wrapper">

	   <ul class="sidebar navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="../doc/dashboard.php">
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
          <a class="dropdown-item" href="../user/edituser.php">Modify user access</a>
          <a class="dropdown-item" href="../task/mytasks.php">Assigned tasks</a>
          <!--div class="dropdown-divider"></div-->
          <!--h6 class="dropdown-header">Other Pages:</h6-->
          <!--a class="dropdown-item" href="404.html">404 Page</a-->
          <!--a class="dropdown-item" href="blank.html">Blank Page</a-->
        </div>
      </li>

       <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-fw fa-tasks"></i>
          <span>Tasks</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
          <h6 class="dropdown-header">Task Management:</h6>
          <a class="dropdown-item" href="../task/mytasks.php">My tasks</a>
          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#myModal">Create new task2<i class="dropdown-item-icon ti-power-off"></i></a>
          <!--a href="#" onClick="MyWindow=window.open('../task/newTask.php','MyWindow','width=600,height=300'); return false;">Click Here</a-->                  
         <a class="dropdown-item" href="../task/createtask.php">Create new task</a>
          <a class="dropdown-item" href="../task/uploadedtasks.php">Uploaded tasks</a>          
          <a class="dropdown-item" href="../task/completedtasks.php">Completed tasks</a>
        </div>
      </li>     
	</ul>
	

	<div id="content-wrapper">

      <div class="container-fluid">