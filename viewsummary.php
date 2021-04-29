<?php
    include('header.php');
    if(isset($_SESSION['profile'])){
    include('db.php');
    $id = $_GET['summary'];
    $projectname = $_GET['projectname'];
    $supplier = $_GET['supplier'];
    $bearingtype = $_GET['bearingtype'];
    function getWeek($num){
    if($num == 3)
        return " On January 1st week";
    else if($num == 4)
        return " On January 2nd week";
    else if($num==5)
        return " On January 3rd week";
        else if($num==6)
        return " On January 4th week";
        else if($num==7)
        return " On February 1st week";
            else if($num==8)
        return " On February 2nd week";
            else if($num==9)
        return " On February 3rd week";
            else if($num==10)
        return " On February 4th week";
            else if($num==11)
        return " On March 1st week";
            else if($num==12)
        return " On March 2nd week";
            else if($num==13)
        return " On March 3rd week";
            else if($num==14)
        return " On March 4th week";
            else if($num==15)
        return " On April 1st week";
            else if($num==16)
        return " On April 2nd week";
            else if($num==17)
        return " On April 3rd week";
            else if($num==18)
        return " On April 4th week";
}
    $query = "SELECT * FROM week_status WHERE id='$id'";
    $rows = mysqli_query($db_result,$query);
    if($row = mysqli_fetch_row($rows)){
            $delay_count = 0;
            for($i = 3;$i<19;$i++){
            $root = $row[$i];
            if($root == 1 && ($i-3)<13){        //Yellow - Supplier (1)
                $no_delay_flag = 0;
                $yellow_count = $yellow_count + 1;
                $yellow_quantity = $yellow_count * 3000;
                $message = "DELAY DETECTED!!\nOrder Name: ".$row[2]."\nSupplier Name: ".strtoupper(str_replace("_"," ",$row[1]))."\nDelay: ".getWeek($i)."\nQuantity: 3000 X ".$yellow_count." = ".$yellow_quantity;
                $delay_count = $delay_count + 1;
                
            }
            else if($root == 2 && ($i-3)<5){        //Brown - WIP (2)
                $no_delay_flag = 0;
                $brown_count = $brown_count + 1;
                $brown_quantity = $brown_count * 4000;
                $message = "DELAY DETECTED!!\nOrder Name: ".$row[2]."\nSupplier Name: ".strtoupper(str_replace("_"," ",$row[1]))."\nDelay: ".getWeek($i)."\nQuantity: 4000 X ".$brown_count." = ".$brown_quantity;
                $delay_count = $delay_count + 1;
            }else if($root == 3 && ($i-3)<1){       //Blue - Transit (3)
                $no_delay_flag = 0;
                $blue_count = $blue_count + 1;
                $blue_quantity = $blue_count * 2000;
                $message = "DELAY DETECTED!!\nOrder Name: ".$row[2]."\nSupplier Name: ".strtoupper(str_replace("_"," ",$row[1]))."\nDelay: ".getWeek($i)."\nQuantity: 2000 X ".$blue_count." = ".$blue_quantity;
                $delay_count = $delay_count + 1;
            }
            }
            if($no_delay_flag == 1){
                $message = "NO DELAY!!\nOrder Name: ".$row[2]."\nSupplier Name: ".strtoupper(str_replace("_"," ",$row[1]));
            }
            $q = "SELECT * FROM users WHERE userid = '$row[1]'";
            $sub_rows = mysqli_query($db_result,$q);
            $sub_row = mysqli_fetch_row($sub_rows);
?>
<br>
<div class="col-md-11 container">
    <center><h3><?php echo "Order Summary"; ?></h3></center>
    <br>
    <table class="table table-bordered table-striped table-hover">
        <tr>
    <td><b>Supplier</b></td><td> <?php echo strtoupper(str_replace("_"," ",$row[1])); ?></td>
    <tr>
    <td><b>Address</b></td> <td><?php echo $sub_row[4]; ?></td>
    <tr>
        <td><b>Email</b></td><td><?php echo $sub_row[5]; ?></td>
    <tr>
    <td><b>Contact No.</b></td><td><?php echo $sub_row[6]; ?></td>
    </table>
    <br>
    <center><h4>Order Details </h4></center>
    <hr>
        <table class="table table-bordered table-striped table-hover">
                <tr>
        <td><b>Project Name</b></td><td><?php echo $projectname; ?></td>
        <tr>
    <td><b>Bearing Type</b></td> <td><?php echo "11210_TN9"; ?></td>
<tr>
    <td><b>Date of Order Placed</b></td><td><?php echo "3/3/2019" ?></td>
    <tr>
    <td><b>Cause of Delay</b></td><td><?php echo "Bad Weather. Workshop Accident." ?></td>
    <tr>
    <td><b>Probable Delay for order fulfillment</b></td><td><b><?php if($delay_count == 0){
    echo "NO DELAY";
    }
    else{
        echo "DELAY of ".$delay_count." weeks."; 
    }
    ?></b></td>
    </table>
    <div class="col-md-10 container">
    <div class="form-group col-md-12">
        <form method="get" action="viewsummarydata.php">
        <textarea name="message" class="form-control" placeholder="Message to Supplier..."></textarea>
        <br>
        <input type="submit" class="btn btn-primary col-md-12" name="SEND" value="SEND SMS">
        </form>
        <table class="table col-md-12">
            <tr>
            <td>
                   <input type="submit" class="btn btn-primary col-md-12" name="PRINT REPORT" value="PRINT REPORT"> 
            </td>
                        <td>
                            <a href="mailto:silvistershebin@gmail.com?subject=yourtitle&body=The message">
   <input type="submit" class="btn btn-primary col-md-12" name="SEND EMAIL" value="SEND EMAIL" > </a>
           </td>
        </table>
    </div>
    </div>
</div>
<?php
}else
{
    echo "Error";
}
}else{
    header('Location: index.php');
}
    include('footer.php');
?>