<?php
	include('header.php');
	unset($_SESSION['supplierorderupdate']);
	if(!isset($_SESSION['suppliervieworder']))
		$_SESSION['suppliervieworder'] = $_GET['id'];
if(isset($_SESSION['profile']))
{
	include('db.php');
	$id = $_SESSION['suppliervieworder'];
	$query = "SELECT * FROM masterdb WHERE id=$id";
	$result = mysqli_query($db_result,$query);
	if($row = mysqli_fetch_row($result))
	{
?>
<br>

<br>
<div class="container" style="border-radius:5px;padding:10px;background-color:#ffffff;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);padding:25px">
<h3><?php echo $row[1] ?></h3><br>

<div class="container col-md-12"  style="height:40%">
<div class="col-md-1" style="float:left;padding:10px">
</div>
<div class="col-md-4" style="float:left;padding:10px">
<img class="col-md-12" id="main"  style="border-radius:5px;background-color:#ffffff;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);height:100%"></img>
</div>
<div class="col-md-5 container" style="float:right;padding:10px">
<img class="col-md-10" id="sub"  style="border-radius:5px;padding:10px;background-color:#ffffff;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);height:100%"></img>

</div>
<div class="col-md-2" style="float:left;padding:10px">
</div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
	var x = '<?php echo $row[2]; ?>';

		document.getElementById('main').src ="images/" + x + ".jpg";
		document.getElementById('sub').src ="images/" + x + "A.svg";
		document.getElementById('footnote').innerHTML ="<br><center><b><i>Bearing- "+x+"</i></b></center>";
	
}, false);
</script><div class="container col-md-12" id="footnote"><br><center><b><i>Bearing- 11210 TN9</i></b></center></div><br>

<table class="table table-bordered table-striped table-hover col-md-12">

<tr>
<td style="width:50%">
<b>Bearing Type</b></td><td><?php echo $row[2] ?></td>
<tr>
<td >
<b>Bearing Part</b></td><td><?php echo $row[3] ?></td>
<tr>
<td >
<b>Yearly Volume</b></td><td><?php echo $row[5] ?></td>
<tr>
<td >
<b>Frequency</b></td><td><?php echo $row[6] ?></td>
<tr>
<td >
<b>Date of Order</b></td><td><?php echo $row[26] ?></td>
<?php 
if($row[7] == 1)
{
?>
<tr>
<td >
<b>Supply Mode</b></td><td><?php echo 'A' ?></td>
<tr>
<td style="width:50%">
<b>Due date for next batch: </b></td><td><?php echo $x = date('d-m-Y', strtotime($row[26]. ' + '.($row[11]*$row[28]).' days')); ?></td>
<?php
}
else if($row[7] == 2)
{
?>

<tr>
<td >
<b>Supply Mode</b></td><td><?php echo 'B' ?></td>
<tr>
<td style="width:50%">
<b>Due date for next batch: </b></td><td><?php echo $x = date('d-m-Y', strtotime($row[26]. ' + '.($row[11]*$row[28]).' days')); ?></td>
<tr>
<td >
<b>Service Factor</b></td><td><?php echo $row[8] ?></td>
<tr>
<td >
<b>Flexibilty Factor</b></td><td><?php echo $row[9] ?></td>
<tr>
<td >
<b>Service Stock Level</b></td><td><?php echo $row[10] ?></td>
<tr>
<td >
<b>Replenishment Lead Time</b></td><td><?php echo $row[11] ?></td>
<tr>
<td >
<b>Call of LDT</b></td><td><?php echo $row[12] ?></td>
<?php
}
else
{
?>
<tr>
<td >
<b>Supply Mode</b></td><td><?php echo 'C' ?></td>
<tr>
<td style="width:50%">
<b>Due date for next batch: </b></td><td><?php echo $x = date('d-m-Y', strtotime($row[26]. ' + '.($row[11]*$row[28]).' days')); ?></td>
<tr>
<td >
<b>Average Production Lot</b></td><td><?php echo $row[13] ?></td>
<tr>
<td >
<b>Agreed Lead Time</b></td><td><?php echo $row[14] ?></td>
<?php
		}
		
		
?>
</table>
<br>
<table class="table table-bordered table-striped table-hover col-md-12">
<tr>
<td style="width:50%">
<b>Forged Ring Stock</b></td><td><?php echo $row[15] ?></td>
<script>
function textbox(x)
{
	document.getElementById(x).innerHTML="<input class='form-control' type='text' value='<?php echo $row[15] ?>'  onblur='submit('test<?php echo $id[0] ?>')'/>";
}
function submit(x)
{
	document.getElementById(x).innerHTML="<input class='form-control' type='text' value='<?php echo 1 ?> '/>";	
}
</script>
<tr>
<td >
<b>In Transit Forging</b></td><td><?php echo $row[16] ?></td>
<tr>
<td >
<b>Turning vendor WIP</b></td><td><?php echo $row[17] ?></td>
<tr>
<td >
<b>Finishing Ring Vendor</b></td><td><?php echo $row[18] ?></td>
<tr>
<td >
<b>In Transit Finishing Ring</b></td><td><?php echo $row[19] ?></td>
<tr>
<td >
<b>Finishing Ring Warehouse</b></td><td><?php echo $row[20] ?></td>
<tr>
<td >
<b>Total Stock</b></td><td><?php echo $row[21] ?></td>
<tr>
<td >
<b>Last Receipt Date</b></td><td><?php echo $row[22] ?></td>
<tr>
<td >
<b>Rlt Given</b></td><td><?php echo $row[23] ?></td>
</table>
<form method="get" action="supplierorderupdate.php">
<div class="form-group">
<input type="hidden" name="id" value="<?php echo $id ?>">
<button class="btn btn-primary container btn-block col-md-6" type="submit" name="update" value="update">Update Details</button>
</div>
</form>
<form method="get" action="updatetimeline.php">
<div class="form-group">
<input type="hidden" name="id" value="<?php echo $id ?>">
<input type="hidden" name="supplier" value="<?php echo $row[4]; ?>">
<input type="hidden" name="projectname" value="<?php echo $row[1]; ?>">
<input class="btn btn-success container btn-block col-md-6" type="submit" name="update_timeline" value="Update Timeline"></input>
</div>
</form>
<?php
}
include('footer.php');
	}

else
{
	header('Location:index.php');
}
?>
<br>