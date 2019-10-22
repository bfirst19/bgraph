<?php
include("./config/auth.php");
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Welcome</title>
<link rel="stylesheet" href="style.css" />
</head>
<body>
<div class="form">
<h1 >	
	Welcome <?php 
	header("Location: ./user/login");
	?>!
</h1>

</div>
</body>
</html>
