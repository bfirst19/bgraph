<?php
if (!isset($_SESSION)) session_start();
session_regenerate_id(true);

if (isset($_SESSION['username'])){
    header("Location: ./user/login");
    exit();
}else{
    header("Location: ../doc/dashboard");
    exit();
}
?>
