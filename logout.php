<?php
session_start();
$name = $_SESSION['profile'][1];
include('ip_logout.php');
session_destroy();

?>
	<meta http-equiv="refresh" content="1;url=index.php" /> 
