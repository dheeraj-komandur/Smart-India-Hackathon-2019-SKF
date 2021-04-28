<?php
include('header.php');
include('db.php');
unset($_SESSION["vieworder"]);
if(isset($_SESSION['profile']) && ($_SESSION['profile'])[3]==0)
{
	?>
<style>

    #assigned{
      background-color:blue;
      color:white !important;
      font-weight:bold;
      text-decoration:none;
    }
    #grad {
    background-image: linear-gradient(to bottom right, aqua, blue);
        }
</style>
<br>
<div class="container col-md-12" style="border-radius:5px;padding:10px;background-color:#ffffff;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);padding:20px">

<h3><i>ALL ORDERS:</i></h3>
<br>
<?php 
	$query = "SELECT DISTINCT projectname FROM masterdb";
	$rows = mysqli_query($db_result,$query);
	while($row = mysqli_fetch_row($rows)){
?>
<div class="">
<div class="container col-md-12" style="border-radius:5px;padding:10px;background-color:#ffffff;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);padding:20px;margin:10px;overflow-x:auto">
<center style="font-size:30px">
<strong>
<b>
<?php
	echo $row[0];
?>
</b>
</strong>
</center>
<br>
<table class="table table-bordered table-striped table-hover">
<tr>
<td><span><b>Supplier</b></span></td>
<td><span><b>Bearing Type</b></span></td>
<td><span><b>Bearing Part</b></span></td>
<td><span><b>Date of Order</b></span></td>
<td style="width:4%"><center><b>Status</b></center></td>
<td></td>
</tr>
<?php
	$query_sub = "SELECT * FROM masterdb WHERE projectname='$row[0]'";
	$sub_projects = mysqli_query($db_result,$query_sub);
	while($sub_project = mysqli_fetch_row($sub_projects)){
?>
<tr>
<td><?php
	echo ucwords(str_replace('_',' ',$sub_project[4]));
	?></td>
<td><?php
	echo $sub_project[2];
	?></span></td>
<td><?php
	echo $sub_project[3];
	?></td>
<td><?php
	echo $sub_project[26];
	?></td>
<?php
		$x = date('Y-m-d', strtotime($sub_project[26]. ' + '.($sub_project[11]*$sub_project[28]).' days'));
		
			$date1 = new DateTime($x);
			$date2 = new DateTime(date('Y-m-d'));
			$days  = $date2->diff($date1)->format('%a');
	$r = ($days)/$sub_project[11];
//	echo $r;
    $text = 'black';
/*	if($r < 0.3){
		$color = 'red';
		$text = 'white';
	}
	else if($r < 0.7)
		$color = 'yellow';
	else{
		$color = 'green';
	    $text = 'white';
	}
	if($sub_project[27] == 0){
	    $color = 'white';
	    $text = 'black';
	}
	*/
?><td>
<div style="background-color:white<?php //echo $color; ?>;color:<?php echo $text; ?>;padding:10px;border-radius:2px"><b><center>
    <?php
      /*  if($sub_project[27] == 0)
            echo "ORDER NOT YET ACCEPTED";
        else if($color == 'green')
            echo "NO DELAY";
        else if($color == 'yellow')
            echo "POSSIBLE DELAY";
        else
            echo "DELAY"; 
            */
    ?></b></center>
</div>	
</td>	
	<td>
<form action="vieworder.php" method="get">
<input type="hidden" name="id" value="<?php echo $sub_project[0] ?>">
<?php 
if($sub_project[27]==1)
{
$x = "btn-primary";
}
else
{
	$x="btn-danger";
}?>
<button type="submit" class="btn <?php echo $x ?> btn-block">
View
</button>
</form></td>
</tr>
<?php
	}
?>
</table>
</div>
</div>

<?php
	}
?>
</div>
<br>
<?php

}
include('footer.php');
?>