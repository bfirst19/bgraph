<?php
if (!isset($_SESSION)) session_start();
session_regenerate_id(true);

if (isset($_SESSION['username'])){
    header("Location: ./doc/dashboard");
    exit();
}else{
    header("Location: ../mnt/access/login");
    exit();
}
?>
