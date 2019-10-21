<?php
session_start();
if(!isset($_SESSION["username"])){
header("Location: user/login.php");
exit(); }
?>
