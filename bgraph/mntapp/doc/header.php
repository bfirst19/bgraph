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
<style>
@
viewport {
	width: device-width;
	zoom: 1.0;
}

@
-ms-viewport {
	width: device-width;
}
</style>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<meta name="viewport" content="width=device-width, initial-scale=1">



<meta name="description" content="">
<meta name="author" content="">

<link rel="shortcut icon" href="../favicon/favicon.ico">
<link rel="icon" type="image/gif"
	href="../favicon/animated_favicon1.gif">


<title>Blugraph Admin - Dashboard</title>

<!-- bootstrap  -->
<!-- link href="../css/bootstrap.min.css"
	rel="stylesheet" id="bootstrap-css"-->
<!-- link href='../js/fullcalendar/packages/bootstrap/bootstrap.min.css' rel='stylesheet' /-->

<link href="../css/excel-bootstrap-table-filter-style.css"
	rel="stylesheet">

<link rel="stylesheet" href="../DataTables/datatables.min.css">
<link rel="stylesheet" href="../css/flatpickr.min.css">
<link rel="stylesheet"
	href="../css/excel-bootstrap-table-filter-style.css">

<link type="text/css" rel="stylesheet"
	hr­ef="../css/jquery.autocomplete.css" />

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



<link href="../css/datepicker.css" rel="stylesheet">
<!-- Custom styles for this template-->
<link href="../css/font-awesome.min.css" rel="stylesheet">
<link href="../css/bg-admin.css" rel="stylesheet">
<link href="../css/bootstrap.materia.min.css" rel="stylesheet">




<link rel="stylesheet" media="screen, print"
	href="../css/vendors.bundle.css">
<link rel="stylesheet" media="screen, print"
	href="../css/theme-demo.css">


<script src="../js/popper.min.js"></script>

</head>

<body id="page-top">

	<nav class="navbar navbar-expand navbar-dark bg-dark static-top">

		<a class="navbar-brand mr-1" href="../doc/dashboard">Blugraph</a>


		<button class="btn btn-link btn-sm text-light order-1 order-sm-0"
			id="sidebarToggle" href="#">
			<i class="fas fa-bars"></i>
		</button>

<?php
$u_name = $_SESSION['username'];
$u_email = $_SESSION['email'];
$role_name = $_SESSION['user_role'];
$role_id = preg_replace('/\s+/', '_', $role_name);
$role_id = strtolower($role_id);
?>
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

			<li><a class="btn btn-outline-info" href="../access/login">Sign out</a></li>
		</ul>

	</nav>



	<div id="wrapper">

<?php
if (strcmp($role_id, "maintenance_user") != 0) {
    ?>

		<ul class="sidebar navbar-nav navbar-dark bg-light toggled">
			<li class="nav-item active"><a class="nav-link"
				href="../doc/dashboard"> <i class="fas fa-envelope"></i> <span>
						Inbox</span>
			</a></li>
<?php }?>
		
		<?php

if (strcmp($role_id, "super_administrator") == 0) {

    ?>
		
			<li class="nav-item"><a class="nav-link" href="../prm/roles"> <i
					class="fas fa-fw fa-user-tag"></i> <span class="menu-title">Roles</span>
			</a></li>
			<li class="nav-item"><a class="nav-link" href="../prm/orgs"> <i
					class="fas fa-fw fa-sitemap"></i> <span class="menu-title">Organizations</span>
			</a></li>

			<li class="nav-item"><a class="nav-link" href="../users/user_list"> <i
					class="fas fa-fw fa-users"></i> <span class="menu-title">User
						Management</span>
			</a></li>
			
			<?php
} else if (strcmp($role_id, "organization_administrator") == 0) {

    ?>
			
			<li class="nav-item"><a class="nav-link" href="../users/user_list"> <i
					class="fas fa-fw fa-users"></i> <span class="menu-title">User
						Management</span>
			</a></li>

			<li class="nav-item"><a class="nav-link" href="../prm/projects"> <i
					class="fas fa-project-diagram"></i> <span class="menu-title">Project
						Management</span>
			</a></li>
			<?php
} else if (strcmp($role_id, "project_manager") == 0) {
    ?>
    		<li class="nav-item"><a class="nav-link" href="../prm/projects_pm">
					<i class="fas fa-project-diagram"></i> <span class="menu-title">Project
						Management</span>
			</a></li>

			<li class="nav-item"><a class="nav-link" href="../prm/stations"> <i
					class="fas fa-train"></i> <span class="menu-title">Stations</span>

			</a></li>

			<li class="nav-item"><a class="nav-link"
				href="../tpl/checklist_designer"> <i class="fas fa-fw fa-file-code"></i>
					<span class="menu-title">Checklist Designer</span>
			</a></li>

			<li class="nav-item"><a class="nav-link" href="../tpl/templates"> <i
					class="fas fa-list-alt"></i> <span class="menu-title">Checklist
						Templates</span>
			</a></li>

			<li class="nav-item"><a class="nav-link" href="../tasks/task_list"> <i
					class="fas fa-fw fa-tasks"></i> <span class="menu-title">Task
						Management</span>
			</a></li>
			<li class="nav-item"><a class="nav-link"
				href="../reports/queryReport"> <i class="fas fa-clipboard-list"></i>
					<span class="menu-title">Report Managemnet</span>
			</a></li>
<?php
} else if (strcmp($u_name, 'system') == 0 && strcmp($role_id, 'system') == 0) {

    ?>
    
    		<li class="nav-item"><a class="nav-link" href="../prm/roles"> <i
					class="fas fa-fw fa-user-tag"></i> <span class="menu-title">Roles</span>
			</a></li>
			<li class="nav-item"><a class="nav-link" href="../prm/orgs"> <i
					class="fas fa-fw fa-sitemap"></i> <span class="menu-title">Organizations</span>
			</a></li>

			<li class="nav-item"><a class="nav-link" href="../users/user_list"> <i
					class="fas fa-fw fa-users"></i> <span class="menu-title">User
						Management</span>
			</a></li>

			<li class="nav-item"><a class="nav-link" href="../prm/projects"> <i
					class="fas fa-project-diagram"></i> <span class="menu-title">Project
						Management</span>
			</a></li>

			<li class="nav-item"><a class="nav-link" href="../prm/stations"> <i
					class="fas fa-train"></i> <span class="menu-title">Stations</span>

			</a></li>

			<li class="nav-item"><a class="nav-link"
				href="../tpl/checklist_designer"> <i class="fas fa-fw fa-file-code"></i>
					<span class="menu-title">Checklist Designer</span>
			</a></li>

			<li class="nav-item"><a class="nav-link" href="../tpl/templates"> <i
					class="fas fa-list-alt"></i> <span class="menu-title">Checklist
						Templates</span>
			</a></li>

			<li class="nav-item"><a class="nav-link" href="../tasks/task_list"> <i
					class="fas fa-fw fa-tasks"></i> <span class="menu-title">Task
						Management</span>
			</a></li>
			<li class="nav-item"><a class="nav-link"
				href="../reports/queryReport"> <i class="fas fa-clipboard-list"></i>
					<span class="menu-title">Report Managemnet</span>
			</a></li>
			
			
	<?php }?>
	

		</ul>


		<div id="content-wrapper">

			<div class="container-fluid">