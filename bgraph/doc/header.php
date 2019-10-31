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
    
    <link rel="stylesheet" href="../css/buttons/buttons.dataTables.scss" rel="stylesheet">
    <link rel="stylesheet" href="../css/buttons/buttons.jqueryui.scss" rel="stylesheet">
    <link rel="stylesheet" href="../css/buttons/buttons.bootstrap4.scss" rel="stylesheet">

<link rel="stylesheet" href="../css/buttons/fixedColumns.dataTables.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../css/buttons/select.dataTables.min.css" rel="stylesheet">
       


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
                <li class="nav-item dropdown d-none d-xl-inline-block user-dropdown">
              <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                <img class="img-xs rounded-circle" src="../assets/images/faces/man.jpg" alt="Profile image"> </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                <div class="dropdown-header text-center">
                  <img class="img-md rounded-circle" src="../assets/images/faces/man.jpg" alt="Profile image">
                  <p class="mb-1 mt-3 font-weight-semibold"><?php echo $_SESSION['username']; ?></p>
                  <p class="font-weight-light text-muted mb-0"><?php echo $_SESSION['email']; ?></p>
                </div>
               <!-- <a class="dropdown-item">My Profile <span class="badge badge-pill badge-danger">1</span><i class="dropdown-item-icon ti-dashboard"></i></a>
                <a class="dropdown-item">Messages<i class="dropdown-item-icon ti-comment-alt"></i></a>
                <a class="dropdown-item">Activity<i class="dropdown-item-icon ti-location-arrow"></i></a>
                <a class="dropdown-item">FAQ<i class="dropdown-item-icon ti-help-alt"></i></a> -->
                <!--a class="dropdown-item" href="../user/logout">Sign Out<i class="dropdown-item-icon ti-power-off"></i></a-->
                <!-- a class="dropdown-item" href="#" data-toggle="modal" data-target="#settingsModal">Settings<i class="dropdown-item-icon ti-power-off"></i></a -->
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Sign out<i class="dropdown-item-icon ti-power-off"></i></a>
              </div>
            </li>
</ul>


	  </nav>



	  <div id="wrapper">

	   <ul class="sidebar navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="../doc/dashboard">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span>
        </a>
      </li>
       <li class="nav-item">
              <a class="nav-link" href="../task/mytasks">
                <i class="fas fa-fw fa-check"></i>
                <span class="menu-title">Task box</span>
              </a>
       </li>
       <li class="nav-item">
              <a class="nav-link" href="../users/user_list">
                <i class="fas fa-fw fa-users"></i>
                <span class="menu-title">User Management</span>
              </a>
       </li>
       
       <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-fw fa-tasks"></i>
          <span>Project Management</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
          <h6 class="dropdown-header">Project Management:</h6>
          <a class="dropdown-item" href="../prm/projects"><i class="fas fa-project-diagram"></i>Projects</a>          
          <a class="dropdown-item" href="../prm/checklists"><i class="fas fa-clipboard-list"></i>Checklists</a>
          <a class="dropdown-item" href="../prm/stations"><i class="fas fa-train"></i>Stations</a>
          <!--div class="dropdown-divider"></div-->
          <!--h6 class="dropdown-header">Other Pages:</h6-->
          <!--a class="dropdown-item" href="404.html">404 Page</a-->
          <!--a class="dropdown-item" href="blank.html">Blank Page</a-->
        </div>
      </li>
       
       <li class="nav-item">
              <a class="nav-link" href="../prm/roles">
                <i class="fas fa-fw fa-user-tag"></i>
                <span class="menu-title">Roles</span>
              </a>
       </li>
        <li class="nav-item">
              <a class="nav-link" href="../prm/orgs">
                <i class="fas fa-fw fa-sitemap"></i>
                <span class="menu-title">Organizations</span>
              </a>
       </li>

       
	</ul>
	

	<div id="content-wrapper">

      <div class="container-fluid">
