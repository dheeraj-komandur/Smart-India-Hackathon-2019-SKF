<?php
include("header.php");
if(isset($_SESSION['profile']))
{
    include('db.php');
	$supplier = $_GET['userid'];
	$query="SELECT * FROM supplierprofile WHERE supplier= '$supplier'";
	$rows = mysqli_query($db_result,$query);
	$row = mysqli_fetch_row($rows)
?>
<style>
@media only screen and (min-width: 768px) {
   #card{
       margin-top:15px;
       border-radius:10px;
       background-color:#ffffff;
       box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
       padding:15px;
   } 
}
</style>
<div class="col-md-12">
 <div class="col-md-9 container" id="card">
    <br>
    <div class="col-md-12" style="height:30%;">
        <div class="col-md-3" style="float:left">
    <img class="col-md-12" style="height:100%;margin-top:-25px" src="images/<?php echo $row[1]?>.jpg"></img>
    </div>
    <div class="col-md-9" style="float:right;margin-top:15px">
    <h1 style="margin-left:30px"><strong><?php echo strtoupper(str_replace("_"," ",$row[1])); ?></strong></h1>
    <br>
    <h5 style="margin-left:30px"><b>ADDRESS: </b> <?php echo $row[2];  ?></h5>
    </div>
    </div>
<hr><br>
    <div class="col-md-12" style="height:225">
        <div class="col-md-6" style="float:left;height:40%">
            <table class="table table-bordered table-striped table-hover col-md-12">
                <tr>
                <td style="width:70%">
                <b>Total Orders Completed: </b></td><td><?php echo $row[3] ?></td>
                <tr>
                <td style="width:70%">
                <b>Orders Completed with delay:</b></td><td><?php echo $row[4] ?></td>
                <tr>
                <td style="width:70%">
                <b>Orders Completed without delay:</b></td><td><?php echo $row[5] ?></td>
                <tr>
                <td style="width:70%">
                <b>Live Orders:</b></td><td><?php echo $row[6] ?></td>
            </table>
            
        </div>
<?php
    $efficiency = $row[5]/$row[3];
?>
<style>
.checked {
  color: orange;
}
</style>
<div class="col-md-1">
    
</div>
        <div class="col-md-5" style="float:right;height:40%">
           <!--  <h3 style="margin-left:35px"> -->
           <h3>Ratings: <b><?php echo $efficiency*5 ?>/5</b></h3>
          <!--  <span style="margin-left:35px"> -->
          <span>
<?php 
        $rating = $efficiency*5;
        $r = $rating;
        $u = 5 - $r;
        while($r > 0){
            $r = $r -1;
?>
            <span class="fa fa-2x fa-star checked"></span>
<?php 
        }
        while($u>0){
            $u = $u -1;
?>
            <span class="fa fa-2x fa-star"></span>
<?php 
        }
?>
</span>
<br><br>

    <!-- <h3 style="margin-left:35px"> -->
    <h3>
        Efficiency: <b><?php echo $efficiency*100 ?>%</b>
    </h3>
        </div>
    </div>
    <div class="col-md-12" style="height:300">
        <div class="col-md-6" style="float:left">

        <h4>Reasons for delay: <h5><i><?php echo $row[7]; ?></i></h5></h4>
    </div>
    <div class="col-md-6" style="float:right">
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.js"></script>
 <canvas id="myChart" width="400" height="300"></canvas>

<script>

var ctx = document.getElementById("myChart").getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ["Orders w/o delay", "Orders with delay", "Live orders"],
        datasets: [{
            label: 'Orders',
            data: [<?php echo $row[5] ?>, <?php echo $row[4] ?>, <?php echo $row[6] ?>],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});
</script>
<!--
<canvas id="myBar" width="400" height="300"></canvas>
<script>
var ctx = document.getElementById("myBar").getContext('2d');
var myBar = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ["Total Orders", "No Delay", "Delay"],
        datasets: [{
            label: 'Orders',
            data: [<?php echo $row[5] ?>, <?php echo $row[4] ?>, <?php echo $row[6] ?>],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)'
            ],
            borderWidth: 1
        }]
    },
    
-->  
</script>

    </div>
    </div>
    <br>
    </div>
    
    </div>

<br>
<?php
	include("footer.php");
}
else{
	header("Location:index.php");
}
?>