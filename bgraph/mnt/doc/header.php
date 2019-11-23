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
<!-- link href="../css/bootstrap.min.css"
	rel="stylesheet" id="bootstrap-css"-->
<!-- link href='../js/fullcalendar/packages/bootstrap/bootstrap.min.css' rel='stylesheet' /-->

<link href="../css/excel-bootstrap-table-filter-style.css"
	rel="stylesheet">

<link rel="stylesheet" href="../css/flatpickr.min.css">


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
<link href="../css/font-awesome.min.css" rel="stylesheet">
<link href="../css/bg-admin.css" rel="stylesheet">
<link href="../css/bootstrap.flatly.min.css" rel="stylesheet">


  <script src="../js/popper.min.js"></script>

</head>

<body id="page-top">

	<nav class="navbar navbar-expand navbar-dark bg-dark static-top">

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
$u_name = $_SESSION['username'];
$u_email = $_SESSION['email'];
?>
</h5>
			</div>
		</form>

		<ul class="navbar-nav ml-auto">


			<li class="nav-item dropdown d-none d-xl-inline-block user-dropdown"><a
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
						<p class="mb-1 mt-3 font-weight-semibold"><?php echo $u_name; ?></p>
						<p class="font-weight-light text-muted mb-0"><?php echo $u_email;  ?></p>
					</div>
					<a class="dropdown-item" href="#" data-toggle="modal"
						data-target="#logoutModal">Sign out<i
						class="dropdown-item-icon ti-power-off"></i></a>
				</div></li>

		</ul>

	</nav>



	<div id="wrapper">

		<ul class="sidebar navbar-nav navbar-dark bg-light">
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
		

			<li class="nav-item dropdown"><a class="nav-link dropdown-toggle"
				href="#" id="pagesDropdown" role="button" data-toggle="dropdown"
				aria-haspopup="true" aria-expanded="false"> <i
					class="fas fa-fw fa-folder"></i> <span class="menu-title">Checklist Management</span>
			</a>
				<div class="dropdown-menu" aria-labelledby="pagesDropdown">
					<!-- h6 class="dropdown-header">Checklist Manager</h6-->
					<a class="dropdown-item" href="../tpl/checklist_designer">Checklist
						Designer</a>
					<div class="dropdown-divider"></div>
					<a class="dropdown-item" href="../tpl/templates">Checklist Templates</a>
				</div></li>


			<li class="nav-item"><a class="nav-link" href="../tpl/checklists"> <i
					class="fas fa-clipboard-list"></i> <span class="menu-title">Report
						Managemnet</span>
			</a></li>



		</ul>


		<div id="content-wrapper">

			<div class="container-fluid">