<?php
include('header.php');
if(isset($_SESSION['profile']))
{
	$profile = $_SESSION['profile'];
	if($profile[3]==1)
		header('Location:orders.php');
	else if($profile[3]==0)
		header('Location:dashboard.php');
}
?>


<?php

include('footer.php')
?>