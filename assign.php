<?php
include('header.php');
include('db.php');
date_default_timezone_set("Asia/Kolkata");
if(isset($_SESSION['profile']))
{
?>
<!-- <script>
if(document.getElementById('mode1').checked)
{
	document.getElementById('supplyB').style.display = "none";
	document.getElementById('supplyC').style.display = "none";
}
else if(document.getElementById('mode2').checked)
{
	document.getElementById('supplyB').style.display = "block";
	document.getElementById('supplyC').style.display = "none";
}
else
{
	document.getElementById('supplyB').style.display = "none";
	document.getElementById('supplyC').style.display = "block";
}
</script>	-->
<style>
    #assign{
      background-color:blue;
      color:white !important;
      font-weight:bold;
      text-decoration:none;
    }

</style>
<div class="container col-md-8">
<p><br><h4>NEW ORDER:</h4></p>
<form method="get" action="assigndata.php">
<br>
<div class="form-group">
<div class="col-md-6" style="float:left">
<input type="radio" onclick="newProject()" name="project" value=1 checked></input><label>&nbsp Create a new project</label>
</div>
<div class="col-md-6" style="float:right">
<input type="radio" onclick="subProject()" name="project" value=2></input><label>&nbsp Add to existing project</label>
</div>
</div>
<script>
function newProject(){
	document.getElementById('new_project').disabled = false;
	document.getElementById('sub_project').disabled = true;
	document.getElementById('new').style.display = "block";
	document.getElementById('sub').style.display = "none";	
}
function subProject(){
	document.getElementById('new_project').disabled = true;
	document.getElementById('sub_project').disabled = false;
	document.getElementById('new').style.display = "none";
	document.getElementById('sub').style.display = "block";
}
</script>
<br>
<div class="form-group" id="new">
<label>Project Name</label><input type="text" id="new_project" name="project_name" class="form-control" placeholder="Project Name" >
</div>
<div class="form-group" id="sub" style="display:none">
<label>Select Project:</label>
<select name="project_name" id="sub_project" class="form-control" disabled>
<?php
	$query = "SELECT DISTINCT projectname FROM masterdb";
	$rows = mysqli_query($db_result,$query);
	while($row = mysqli_fetch_row($rows)){
 ?>

  <option name="project_name" value="<?php echo $row[0]; ?>"><?php echo $row[0]; ?></option>
  <?php
	}
  ?>
</select>
</div>
<label>Supplier</label>&nbsp 
<!-- <select class="form-control">
  <option name="supplier" value="Rajkot">Rajkot</option>
  <option name="supplier" value="Jaipur">Jaipur</option>
  <option name="supplier" value="Belgaum">Belgaum</option>
  <option name="supplier" value="Pune">Pune</option>
</select> -->
<select name="supplier" class="form-control" required>
<?php
$query = "SELECT * FROM users WHERE logintype=1";
$rows = mysqli_query($db_result,$query);
while($row=mysqli_fetch_row($rows))
{if($row[0]!=1)
	{
?>

  <option name="supplier" value="<?php echo $row[1] ?>"><?php echo ucwords(str_replace("_"," ",$row[1])); ?></option>

<?php
	}
}
?>
</select>
<br>
<div class="form-group">
<label>Bearing type</label>&nbsp
<select onchange="displayImage(this)" name="bearing_type" class="form-control" required>
  <option name="bearing_type" value="11210_TN9">11210 TN9</option>
  <option name="bearing_type" value="10071">10071</option>
  <option name="bearing_type" value="1169110">1169110</option>
  <option name="bearing_type" value="108_TN9">108 TN9</option>
  <option name="bearing_type" value="12907">12907</option>
</select>
</div>
<script>
function displayImage(a){
	var x = a.value;
		document.getElementById('main').src ="images/" + x + ".jpg";
		document.getElementById('subp').src ="images/" + x + "A.svg";
		document.getElementById('footnote').innerHTML ="<br><center><b><i>Bearing- "+x+"</i></b></center>";
	
}
</script>
<div class="container col-md-12"  style="height:42%">
<div class="col-md-5" style="float:left;padding:10px">
<img class="col-md-12" id="main" src="images/11210_TN9.jpg" style="border-radius:5px;background-color:#ffffff;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);height:100%"></img>
</div>
<div class="col-md-5" style="float:right;padding:10px">
<img class="col-md-12" id="subp" src="images/11210_TN9A.svg" style="border-radius:5px;padding:10px;background-color:#ffffff;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);height:100%"></img>
</div>
</div>
<div class="form-group">
<div class="container col-md-12" id="footnote"><br><center><b><i>Bearing- 11210 TN9</i></b></center></div>
<label class="col-md-12" style="margin-left:-11px"><br>Bearing part</label>&nbsp <select name="bearing_part" class="form-control" required>
  <option value="Inner Ring">Inner Ring</option>
  <option value="Outer Ring">Outer Ring</option>
  <option value="Ball">Ball</option>
  <option value="Seal">Seal</option>
  <option value="Cage">Cage</option>
</select>
</div>

<div class="form-group">
<label>Yearly Volume</label> &nbsp <input id="yearly_volume" onblur="setYearlyVolume()" name="yearly_volume" placeholder="Yearly Volume" class="form-control" type="number" required>
</div>

<div class="form-group">
<label>Frequency</label> &nbsp <input id="frequency" onblur="setFrequency()" class="form-control" name="frequency" placeholder="Frequency" type="number" required>
</div>
<div class="form-group">
    <label>Date of Order: </label><input type="text" class="form-control" value="<?php echo date("m/d/y"); ?>" disabled>
</div>
<script>
function setFrequency()
{
	frequency = parseFloat(document.getElementById('frequency').value);
	var t1 = parseFloat(document.getElementById('yearly_volume').value);
	var t2 = parseFloat(document.getElementById('frequency').value);
	var t3 = parseFloat(document.getElementById('service_factor').value);
	if(t1>0 && t2>0 && t3>0)
	{
		calculateServiceStockLevel();
	}
	else
		setNullServiceStockLevel();
	var t4 = parseFloat(document.getElementById('flexibility_factor').value);
	var t5 = parseFloat(document.getElementById('frequency').value);
	if(t4>0 && t5>0)
	{
		calculateReplenishmentLeadTime();
	}
	else
		setNullReplenishmentLeadTime();
}
function setYearlyVolume()
{
	yearly_volume = parseFloat(document.getElementById('yearly_volume').value);
	var t1 = parseFloat(document.getElementById('yearly_volume').value);
	var t2 = parseFloat(document.getElementById('frequency').value);
	var t3 = parseFloat(document.getElementById('service_factor').value);
	if(t1>0 && t2>0 && t3>0)
	{
		calculateServiceStockLevel();
	}
	else
		setNullServiceStockLevel();
}
function setServiceFactor()
{
	service_factor = parseFloat(document.getElementById('service_factor').value);
	var t1 = parseFloat(document.getElementById('yearly_volume').value);
	var t2 = parseFloat(document.getElementById('frequency').value);
	var t3 = parseFloat(document.getElementById('service_factor').value);
	if(t1>0 && t2>0 && t3>0)
	{
		calculateServiceStockLevel();
	}
	else
		setNullServiceStockLevel();

}
function calculateServiceStockLevel()
{
	var service_stock_level = (yearly_volume/frequency)*service_factor;
	service_stock_level = service_stock_level.toFixed(2);
	document.getElementById('service_stock_level').value = service_stock_level;
}
function setNullServiceStockLevel()
{
	document.getElementById('service_stock_level').value = "";
}
function setNullReplenishmentLeadTime()
{
	document.getElementById('replenishment_lead_time').value = "";
}
function setFlexibilityFactor()
{
	flexibility_factor = parseFloat(document.getElementById('flexibility_factor').value);
	var t1 = parseFloat(document.getElementById('flexibility_factor').value);
	var t2 = parseFloat(document.getElementById('frequency').value);
	if(t1>0 && t2>0)
	{
		calculateReplenishmentLeadTime();
	}
	else
		setNullReplenishmentLeadTime();
}
function calculateReplenishmentLeadTime()
{
	var val = 360/(flexibility_factor*frequency);
	val = val.toFixed(2);
	document.getElementById('replenishment_lead_time').value = val;
}

<!-- onblur="setServiceStockLevel()" -->
function setReplenishmentLeadTime()
{
	var t1 = parseFloat(document.getElementById('flexibility_factor').value);
	var t2 = parseFloat(document.getElementById('frequency').value);
	if(t1>0 && t2>0)
	{
		calculateReplenishmentLeadTime();
	}
	else
		setNullReplenishmentLeadTime();
}
<!-- onblur="setReplenishmentLeadTime()" -->
function setServiceStockLevel()
{
	var t1 = parseFloat(document.getElementById('yearly_volume').value);
	var t2 = parseFloat(document.getElementById('frequency').value);
	var t3 = parseFloat(document.getElementById('service_factor').value);
	if(t1>0 && t2>0 && t3>0)
	{
		calculateServiceStockLevel();
	}
	else
		setNullServiceStockLevel();
}

</script>

<div class="form-group">
<label>Supply Mode: </label> &nbsp 
  <input onclick="supplyA()" type="radio" id="mode1" name="mode" value=1 checked required> A
  <input onclick="supplyB()" type="radio" id="mode2" name="mode" value=2 required> B
  <input onclick="supplyC()" type="radio" id="mode3" name="mode" value=3 required> C

</div><br>
  <div id="supplyB" style="display:none" class="col-md-12">
	<div class="form-group">
	<label>Service Factor:</label> &nbsp <input id="service_factor" onblur="setServiceFactor()" step=".01" name="service_factor" type="number" class="form-control">
	</div>
	<div class="form-group">
	<label>Flexibility Factor:</label> &nbsp <input id="flexibility_factor" onblur="setFlexibilityFactor()" step=".01" name="flexibility_factor" type="number" class="form-control">
	</div>
	<div class="form-group">
	<label>Service Stock Level:</label> &nbsp <input onblur="setServiceStockLevel()" step=".01" id="service_stock_level" name="service_stock_level" type="number" class="form-control">
	</div>
	<div class="form-group">
	<label>Replenishment Lead Time:</label> &nbsp <input onblur="setReplenishmentLeadTime()" step=".01" id="replenishment_lead_time" name="replenishment_lead_time" type="number" class="form-control">
	</div>
	<div class="form-group">
	<label>Call of Idt:</label> &nbsp <input name="call_of_ldt" type="number" class="form-control">
	</div>
</div>
<div id="supplyC" style="display:none" class="col-md-12">
	<div class="form-group">
	<label>Average production lot:</label> &nbsp <input name="average_production_lot" class="form-control" type="number">
	</div>
	<div class="form-group">
	<label>Agreed Lead Time </label> &nbsp <input class="form-control" name="agreed_lead_time" type="number">
	</div>

</div>
  <div class="form-group">
	<button type="submit" class="btn btn-primary btn-block">
	Submit
	</button>
  
  </div>
  
  		<input type="hidden" name="dateoforder" value="<?php echo date("d-m-Y"); ?>">
</form>
</div>
<br>
<br>
		<script>
			function supplyB()
			{
				document.getElementById('supplyB').style.display="block";
				document.getElementById('supplyC').style.display="none";
			}
			function supplyC()
			{
				document.getElementById('supplyC').style.display="block";
				document.getElementById('supplyB').style.display="none";
			}
			function supplyA()
			{
				document.getElementById('supplyC').style.display="none";
				document.getElementById('supplyB').style.display="none";
			}
		</script>
<?php
}
else
{
	?>
		<meta http-equiv="refresh" content="1;url=index.php" /> 
	<?php
}
include('footer.php')
?>
