<style>
    #sup:hover{
        font-weight:bold; !important;
    }

    #all_suppliers{
      background-color:blue;
      color:white !important;
      font-weight:bold;
      text-decoration:none;
    }
    
</style>

<?php
include("header.php");
if(isset($_SESSION['profile']))
{
	include("db.php");
	$query = "SELECT * FROM users WHERE logintype = 1 ";
	$rows = mysqli_query($db_result,$query);
	?>
	<div class="col-md-12" style="padding:20px">
	<?php
	while($row = mysqli_fetch_row($rows)){
?>

<div class="col-md-4" style="float:left;height:55%;margin-top:10px">
<div class="m-2 col-md-12"  style="border-radius:5px;padding:5px;background-color:#ffffff;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);padding:35px;height:100%;">
<img class="col-md-12" style="height:90%" src="images/<?php echo $row[1]?>.jpg"></img>
<center><b>
<a href="#" id="sup" onclick="location.href='viewsupplier.php?userid=<?php echo $row[1]; ?>';">
<?php
echo strtoupper(str_replace("_"," ",$row[1]));
?>
</b></a>
<br>
<div style="float:right">
   <a href="#" onclick="location.href='viewstocklevel.php?userid=<?php echo $row[1]; ?>'">View stock level -></a>
</div>
</center><br>
</div>
<br>
</div>

<?php
	}
?>
</div>


<?php
	
	include("footer.php");
}
else{
	header("Location: index.php");
}

?>