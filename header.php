<?php 
	session_start();
//	date_default_timezone_set("Asia/Kolkata");
?>
<html>
<head>
    <link rel="icon" href="logoA.jpg">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>
SKF
</title>
<style type="text/css"> 
input[type="date"]:before {
    content: attr(placeholder) !important;
    color: #aaa;
    margin-right: 0.5em;
  }
  input[type="date"]:focus:before,
  input[type="date"]:valid:before {
    content: "";
  }
  a:hover{
      background-color:blue;
      color:white !important;
      font-weight:bold;
      text-decoration:none;
  }
    li{
        margin:3px;
    }
  
@media only screen and (max-width: 768px) {


}

  .mobileShow {display: inline;} 

  /* Smartphone Portrait and Landscape */ 
  @media only screen 
    and (min-device-width : 320px) 
    and (max-device-width : 480px){ 
      .mobileShow {display: none;}
  }
</style>
				<link rel="stylesheet" href="css/font-awesome.min.css" />
<!--
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
				-->
<link rel="stylesheet" href="css/bootstrap.min.css">

</head>
<body><b>
<nav class="navbar navbar-expand-lg navbar-light bg-light" style="border-bottom:1px solid #5500ff">
  <a class="navbar-brand" href="homepage.php"><b style="color:blue;background-color:white">
SKF</b></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
  <?php
  if(isset($_SESSION['profile']))
  {$profile = $_SESSION['profile'];
	if($profile[3]==0)
	{
  ?>
      <li class="nav-item">
        <a class="nav-link" href="assign.php" style="border-radius:8px" id="assign">Assign new order</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="assigned.php" style="border-radius:8px" id="assigned">Assigned orders</a>
      </li>
      	  <li class="nav-item">
        <a class="nav-link" href="supplierlist.php" style="border-radius:8px" id="all_suppliers">All Suppliers</a>
      </li>
            	  <li class="nav-item">
        <a class="nav-link" href="supplierstats.php" style="border-radius:8px" id="supplier_stats">Timeline</a>
      </li>
<?php
	}
	else
	{
	?>
		  <li class="nav-item">
        <a class="nav-link" id="ordernotification" href="orders.php" style="border-radius:8px" id="orders">Orders</a>
      </li>
	  <?php
	}
	?>
      <li class="nav-item">
        <a class="nav-link" href="logout.php" style="border-radius:8px" id="logout">Logout</a>
      </li>


    </ul><div class="mobileShow">
		<span class="form-inline my-2 my-lg-0" style="float:right;color:blue">
       <b>Logged in as <?php echo $profile[1]; ?></b>
      </span>
	  </div>
	  
		<?php
  }
	?>
    <!-- <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
	-->
  </div>
</nav>
</b>