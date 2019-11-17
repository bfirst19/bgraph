<?php
if (! isset($_SESSION))
    session_start();
if (! isset($_SESSION['username'])) {
    header("Location: ../access/login");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport"
	content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">

<title>Bluegrap Admin - Dashboard</title>

<!-- bootstrap  -->
<!-- link href="../css/bootstrap-4.1.3-dist/css/bootstrap.min.css"
	rel="stylesheet" id="bootstrap-css"-->
<!-- link href='../js/fullcalendar/packages/bootstrap/bootstrap.min.css' rel='stylesheet' /-->

<link href="../css/excel-bootstrap-table-filter-style.css"
	rel="stylesheet">
	
<link rel="stylesheet" href="../css/flatpickr.min.css">

<link rel="stylesheet" href="../assets/css/shared/style.css">
<!-- Layout styles -->
<link rel="stylesheet" href="../assets/css/demo_1/style.css">

<!-- dataTable css -->
<link rel="stylesheet"
	href="../css/buttons/fixedColumns.dataTables.min.css" rel="stylesheet">
<link href="../assets/datatables/dataTables.bootstrap4.css"
rel="stylesheet">
<link rel="stylesheet" href="../css/buttons/select.dataTables.min.css"
	rel="stylesheet">
<link href="../css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="../js/jquery-ui-1.12.1/jquery-ui.min.css">

<!-- Custom fonts for this template-->
<link href="../assets/fontawesome-free/css/all.min.css" rel="stylesheet"
	type="text/css">
	

	
<!-- Custom styles for this template-->
<link href="../css/bg-admin.css" rel="stylesheet">
<link href="../css/bootstrap.flatly.min.css" rel="stylesheet">


</head>
 
<body id="page-top">

	<nav class="navbar navbar-expand navbar-light bg-light static-top">

		<a class="navbar-brand mr-1" href="../doc/dashboard">Bluegraph</a>


		<button class="btn btn-link btn-sm text-dark order-1 order-sm-0"
			id="sidebarToggle" href="#">
			<i class="fas fa-bars"></i>
		</button>

		<form
			class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
			<div class="input-group">
				<h5>	

  Welcome  <?php
echo $_SESSION['username'];
?>
</h5>
			</div>
		</form>

		<ul class="navbar-nav ml-auto">


			<li class="nav-item dropdown no-arrow"><a
				class="nav-link dropdown-toggle" href="#" id="userDropdown"
				role="button" data-toggle="dropdown" aria-haspopup="true"
				aria-expanded="false"> <img class="img-md rounded-circle"
					src="../assets/images/faces/man.jpg" alt="Profile image">
			</a>
				<div class="dropdown-menu dropdown-menu-right navbar-dropdown"
					aria-labelledby="UserDropdown">
					<div class="dropdown-header text-center">
						<img class="img-md rounded-circle"
							src="../assets/images/faces/man.jpg" alt="Profile image">
						<p class="mb-1 mt-3 font-weight-semibold"><?php echo $_SESSION['username']; ?></p>
						<p class="font-weight-light text-muted mb-0"><?php echo $_SESSION['email']; ?></p>
					</div>
					<a class="dropdown-item" href="#" data-toggle="modal"
						data-target="#logoutModal">Sign out<i
						class="dropdown-item-icon ti-power-off"></i></a>
				</div></li>
		</ul>

	</nav>



	<div id="wrapper">

		<ul class="sidebar navbar-nav bg-dark toggled">
			<li class="nav-item active"><a class="nav-link"
				href="../doc/dashboard"> <i class="fas fa-fw fa-tachometer-alt"></i>
					<span>Dashboard</span>
			</a></li>
			
			<li class="nav-item"><a class="nav-link" href="../prm/roles"> <i
					class="fas fa-fw fa-user-tag"></i> <span class="menu-title">Roles</span>
			</a></li>
			<li class="nav-item"><a class="nav-link" href="../prm/orgs"> <i
					class="fas fa-fw fa-sitemap"></i> <span class="menu-title">Organizations</span>
			</a></li>
			
			<li class="nav-item"><a class="nav-link" href="../prm/stations"> <i
					class="fas fa-train"></i> <span class="menu-title">Stations</span>

			</a></li>
			
			<li class="nav-item"><a class="nav-link" href="../tasks/task_list"> <i
					class="fas fa-fw fa-tasks"></i> <span class="menu-title">Task
						Management</span>
			</a></li>
			<li class="nav-item"><a class="nav-link" href="../users/user_list"> <i
					class="fas fa-fw fa-users"></i> <span class="menu-title">User
						Management</span>
			</a></li>

			<li class="nav-item"><a class="nav-link" href="../prm/projects"> <i
					class="fas fa-project-diagram"></i> <span class="menu-title">Project
						Management</span>
			</a></li>

			<li class="nav-item"><a class="nav-link" href="../tpl/checklists"> <i
					class="fas fa-clipboard-list"></i> <span class="menu-title">Checklists</span>
			</a></li>

			

		</ul>


		<div id="content-wrapper">

			<div class="container-fluid">