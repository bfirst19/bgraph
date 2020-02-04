
<?php
session_start();
$u_name = $_SESSION['username'];
$u_email = $_SESSION['email'];
$role_name = $_SESSION['user_role'];
$role_id = preg_replace('/\s+/', '_', $role_name);
$role_id = strtolower($role_id);


switch( $role_id ){
    
    case 'super_administrator':
        header("Location: ../doc/adashboard.php");
        exit();
        
    case 'maintenance_user':
        header("Location: ../doc/udashboard.php");
        exit();
    
    case 'system':
        header("Location: ../doc/adashboard.php");
        exit();
        
    case 'project_manager':
        header("Location: ../doc/adashboard.php");
        exit();
        
    default:
        header("Location: ../doc/udashboard.php");
        exit();
}

?>
 
