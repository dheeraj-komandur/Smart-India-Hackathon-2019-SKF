<link rel="icon" href="logoA.jpg">
<div id="grad" style="height:100%;padding:20px">
<div style="display:none">
    <style>
        #grad {
    background-image: linear-gradient(to bottom right, aqua, blue);
        }
    </style>
<?php
include('header.php');
if(!isset($_SESSION['profile']))
{
    include('ip_main_page.php');

?>
</div>
<br>
<br><br>
<div class="mx-auto col-md-4" style="border-radius:5px;padding:10px;background-color:#ffffff;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);padding:20px">
<div class="container">
<img src="logo.svg.png" class="col-md-12"></img>
</div>
<br>
<hr>
<?php 
if(isset($_SESSION['incorrect'])){
?>
<div>
<p style="color:red">*The username or password was incorrect</p>
</div>
<?php
	unset($_SESSION['incorrect']);
}
?>
<form action="logindata.php" method="get">

	<div class="form-group">
	<label><b>UserId:</b></label>
	<input class="form-control" type="text" name="userid" placeholder="Enter your UserID.">
	</div>
	<br>
	<div class="form-group">
	<label><b>Password:</b></label>
	<input class="form-control" type="password" name="password" placeholder="Enter your account password.">
	</div>
	<br>
	<div class="form-group">
	<button class="btn btn-primary btn-block" style="background-color:#0000ff;border:1px solid black" type="submit" name="login" value="login">Login</button>
	</div>
</form>
</div> 
<br>

</div>
<?php
}
else
{
	?>
	<meta http-equiv="refresh" content="1;url=http://creationdevs.in/skf/dashboard.php" /> -->
	<?php
}
include('footer.php')
?>