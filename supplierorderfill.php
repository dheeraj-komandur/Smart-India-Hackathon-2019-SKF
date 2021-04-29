<?php
	include('header.php');
	include('db.php');
	if(!isset($_SESSION['order']))
		$_SESSION['order'] = $_GET['id'];
	
	if(isset($_SESSION['profile']))
	{
	$profile = $_SESSION['profile'];
	$userid = $profile[1];
	
	$id = $_SESSION['order'];
		$query = "SELECT * FROM masterdb WHERE id=$id";
		$rows = mysqli_query($db_result,$query);
		if($row = mysqli_fetch_row($rows))
		{
			
?>
<br>

<br>
<div class="container" style="border-radius:5px;padding:10px;background-color:#ffffff;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);padding:20px">
<h3><?php echo $row[1] ?></h3> <br>

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
<b>Bearing Type: </b></td><td><?php echo $row[2] ?></td>
<tr>
<td >
<b>Bearing Part: </b></td><td><?php echo $row[3] ?></td>
<tr>
<td >
<b>Yearly Volume: </b></td><td><?php echo $row[5] ?></td>
<tr>
<td >
<b>Frequency: </b></td><td><?php echo $row[6] ?></td>
<?php 
if($row[7] == 1)
{
?>
<tr>
<td >
<b>Supply Mode: </b></td><td><?php echo 'A' ?></td>
<?php
}
else if($row[7] == 2)
{
?>
<tr>
<td >
<b>Supply Mode: </b></td><td><?php echo 'B' ?></td>
<tr>
<td >
<b>Service Factor: </b></td><td><?php echo $row[8] ?></td>
<tr>
<td >
<b>Flexibilty Factor: </b></td><td><?php echo $row[9] ?></td>
<tr>
<td >
<b>Service Stock Level: </b></td><td><?php echo $row[10] ?></td>
<tr>
<td >
<b>Replenishment Lead Time: </b></td><td><?php echo $row[11] ?></td>
<tr>
<td >
<b>Call of LDT: </b></td><td><?php echo $row[12] ?></td>
<?php
}
else
{
?>
<tr>
<td >
<b>Supply Mode: </b></td><td><?php echo 'C' ?></td>
<tr>
<td >
<b>Average Production Lot: </b></td><td><?php echo $row[13] ?></td>
<tr>
<td >
<b>Agreed Lead Time: </b></td><td><?php echo $row[14] ?></td>
<?php
}
?>
</table>

<br><br>


<h3>Supplier form fill:</h3><br>
<form method="get" action="supplierorderfilldata.php">
<input type="hidden" name="id" value="<?php echo $row[0] ?>">
<input type="hidden" name="ssl" value="<?php echo $row[10] ?>">
<div class="form-group">
<label><b>Forged Ring Stock(Finish):</b></label>
<input type="number" class="form-control" name="forgedringstock" placeholder="Forged Ring Stock(Finish)" required>
</div>
<div class="form-group">
<label><b>In Transit Forging:</b></label>
<input type="number" class="form-control" name="intransitforging" placeholder="In Transit Forging" required>
</div>
<div class="form-group">
<label><b>Turning Vendor WIP:</b></label>
<input type="number" class="form-control" name="turningvendorwip" placeholder="Turning Vendor WIP" required>
</div>
<div class="form-group">
<label><b>Finish Ring @ Vendor:</b></label>
<input type="number" class="form-control" name="finishingringvendor" id="finishingringvendor" placeholder="Finish Ring @ Vendor" required>
</div>
<div class="form-group">
<label><b>In Transit Finish Rings:</b></label>
<input type="number" class="form-control" name="intransitfinishring" id="intransitfinishring" placeholder="In Transit Finish Rings" required>
</div>
<div class="form-group">
<label><b>Finish Ring @ W/H:</b></label>
<input type="number" class="form-control" name="finishringwh" id="finishringwh" placeholder="Finish Ring @ W/H" required>
</div>
<div class="form-group">
<label><b>Total Stock:</b></label>
<input type="number" id="new" onclick="setNewStock()" class="form-control" name="totalstock" placeholder="Total Stock" required>
</div>
<script>
    function setNewStock(){
    var frv = parseFloat(document.getElementById('finishingringvendor').value);
	var itf = parseFloat(document.getElementById('intransitfinishring').value);
	var fr = parseFloat(document.getElementById('finishringwh').value);
	var n = frv + itf + fr;
	document.getElementById('new').value = n;
    }
</script>
<div class="form-group">
<label><b>Last Receipt Date:</b></label>
<input type="date" class="form-control" name="lastreceiptdate" placeholder="Last Receipt Date" required>
</div>

<div class="form-group">
<button type="submit" class="btn btn-primary btn-block" name="orderfill">Fill Order</button>
</div>


</form>
</div>
<br><br>
<?php
	}
	/*else
	{
		
		
************

unset($_SESSION["products"])

************
		?>
				<meta http-equiv="refresh" content="1;url=orders.php" /> 
		<?php
	}
	*/
	}
	include('footer.php');
?>