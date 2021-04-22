<?php
    include('header.php');
    if(isset($_SESSION['profile'])){
                include('db.php');
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
        function insert(){
            include('db.php');
            $mobileNumber = "7776877364";
            $yellow_count = 0;
            $brown_count = 0;
            $blue_count = 0;
            $no_delay_flag = 1;
            $yellow_quantity = 0;
            $brown_quantity = 0;
            $blue_quantity = 0;
            $n = $_GET['check'];
            $query="SELECT * FROM week_status WHERE id=$n";
            $rows = mysqli_query($db_result, $query);
            $row = mysqli_fetch_row($rows);
            for($i = 3;$i<19;$i++){
            $root = $row[$i];
            if($root == 1 && ($i-3)<13){        //Yellow - Supplier (1)
                $no_delay_flag = 0;
                $yellow_count = $yellow_count + 1;
                $yellow_quantity = $yellow_count * 3000;
                $message = "DELAY DETECTED!!\nOrder Name: ".$row[2]."\nSupplier Name: ".strtoupper(str_replace("_"," ",$row[1]))."\nDelay: ".getWeek($i)."\nQuantity: 3000 X ".$yellow_count." = ".$yellow_quantity;
                include('sms.php');
            }
            else if($root == 2 && ($i-3)<5){        //Brown - WIP (2)
                $no_delay_flag = 0;
                $brown_count = $brown_count + 1;
                $brown_quantity = $brown_count * 4000;
                $message = "DELAY DETECTED!!\nOrder Name: ".$row[2]."\nSupplier Name: ".strtoupper(str_replace("_"," ",$row[1]))."\nDelay: ".getWeek($i)."\nQuantity: 4000 X ".$brown_count." = ".$brown_quantity;
                include('sms.php');
            }else if($root == 3 && ($i-3)<1){       //Blue - Transit (3)
                $no_delay_flag = 0;
                $blue_count = $blue_count + 1;
                $blue_quantity = $blue_count * 2000;
                $message = "DELAY DETECTED!!\nOrder Name: ".$row[2]."\nSupplier Name: ".strtoupper(str_replace("_"," ",$row[1]))."\nDelay: ".getWeek($i)."\nQuantity: 2000 X ".$blue_count." = ".$blue_quantity;
                include('sms.php');
            }
            }
            if($no_delay_flag == 1){
                $message = "NO DELAY!!\nOrder Name: ".$row[2]."\nSupplier Name: ".strtoupper(str_replace("_"," ",$row[1]));
                include('sms.php');
            }
        }
    if(isset($_GET['check'])){
        insert();
    }
        $query = "SELECT * FROM users WHERE logintype=1";
        $rows = mysqli_query($db_result,$query);
        function getColour($num) {
            if($num == '0')
                return "red";
            else if($num == '1')
                return "yellow";
            else if($num == '2')
                return "brown";
            else if($num == '3')
                return "blue";
            else
                return "green";
}
$sup = array("Rajkot Supplier1", "Rajkot Supplier 2", "Rajkot Supplier 3","Rajkot Supplier 4");
$count = 0;
?>
<style>
    #supplier_stats{
              background-color:blue;
      color:white !important;
      font-weight:bold;
      text-decoration:none;
    }
</style>
<div class="col-md-11 container"><br>
    <h1><strong>TIMELINE:</strong></h1><br>
    <div class="col-md-12" style="height:30%">
    <div class="col-md-6">
    
    </div>
    <div class="col-md-6" style="float:right">
        <h5>LEGEND:</h5>
        <table class="table table-bordered table-striped col-md-12">
            <tr>
            <td style="background-color:green"></td>
            <td style="background-color:blue"></td>
            <td style="background-color:brown"></td>
            <td style="background-color:yellow"></td>
            <td style="background-color:red"></td>
            <tr>
            <td><b>At Warehouse</b></td>
            <td><b>In Transit</b></td>
            <td><b>WIP@Supplier</b></td>
            <td><b>Raw Material Ordered</b></td>
            <td><b>No plan</b></td>
        </table>
    </div>
    </div>
<?php
        while($row=mysqli_fetch_row($rows)){
        $name =  $row[1];
            $q = "SELECT * FROM week_status WHERE supplier = '$name'";
            $sub_rows = mysqli_query($db_result,$q);
?>
<br>
<h3><?php echo $sup[$count];
    $count = $count + 1;
?></h3>
<table class="table table-bordered table-striped col-md-12">
    <tr>
        <td>
        </td>
        <td colspan="4"><center>
            January</center>
        </td>
                <td colspan="4"><center>
            February</center>
        </td>
                <td colspan="4"><center>
            March</center>
        </td>
                <td colspan="4"><center>
            April</center>
        </td>
        <td></td>
        <td></td>
    </tr>
    <tr>
    <td>
        Bearing Type
    </td>
    <td>
        J1
    </td>
        <td>
        J2
    </td>
        <td>
        J3
    </td>
        <td>
        J4
    </td>
        <td>
        F1
    </td>
        <td>
        F2
    </td>
        <td>
        F3
    </td>
        <td>
        F4
    </td>
        <td>
        M1
    </td>
        <td>
        M2
    </td>
        <td>
        M3
    </td>
        <td>
        M4
    </td>
        <td>
        A1
    </td>
        <td>
        A2
    </td>
        <td>
        A3
    </td>
        <td>
        A4
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
<?php

            while($sub_row = mysqli_fetch_row($sub_rows)){
        ?>
        <tr>
   <td >
       <?php echo $sub_row[2]; ?>
   </td> 
      <td style="padding:10px;background-color:<?php echo getColour($sub_row[3]); ?>">
   </td> 
      <td style="padding:10px;background-color:<?php echo getColour($sub_row[4]); ?>">
   </td> 
      <td style="padding:10px;background-color:<?php echo getColour($sub_row[5]); ?>">
   </td> 
      <td style="padding:10px;background-color:<?php echo getColour($sub_row[6]); ?>">
   </td> 
      <td style="padding:10px;background-color:<?php echo getColour($sub_row[7]); ?>">
   </td> 
      <td style="padding:10px;background-color:<?php echo getColour($sub_row[8]); ?>">
   </td> 
      <td style="padding:10px;background-color:<?php echo getColour($sub_row[9]); ?>">
   </td> 
      <td style="padding:10px;background-color:<?php echo getColour($sub_row[10]); ?>">
   </td> 
      <td style="padding:10px;background-color:<?php echo getColour($sub_row[11]); ?>">
   </td> 
      <td style="padding:10px;background-color:<?php echo getColour($sub_row[12]); ?>">
   </td> 
      <td style="padding:10px;background-color:<?php echo getColour($sub_row[13]); ?>">
   </td> 
      <td style="padding:10px;background-color:<?php echo getColour($sub_row[14]); ?>">
   </td> 
      <td style="padding:10px;background-color:<?php echo getColour($sub_row[15]); ?>">
   </td> 
      <td style="padding:10px;background-color:<?php echo getColour($sub_row[16]); ?>">
   </td> 
      <td style="padding:10px;background-color:<?php echo getColour($sub_row[17]); ?>">
   </td> 
         <td style="padding:10px;background-color:<?php echo getColour($sub_row[18]); ?>">
   </td> 
   <td>
       <form method="get">
       <button type="submit" name="check" id="check" value="<?php echo $sub_row[0] ?>" class="btn btn-primary">CHECK</button>
       </form>
   </td>
   <td style="width:5%">
         <form method="get" action="viewsummary.php?summary=<?php echo $sub_row[0]; ?>">
             <input type="hidden" name = "supplier" value="<?php echo $sub_row[1] ?>">
             <input type="hidden" name = "projectname" value = "<?php echo $sub_row[19] ?>">
             <input type="hidden" name="bearingtype" value = "<?php echo $sub_row[2] ?>">
       <button type="submit" name="summary" id="summary" value="<?php echo $sub_row[0] ?>" class="btn btn-primary">SUMMARY</button>
       </form>     
   </td>
<?php 
}

?>
</table>
<br>
<?php
}
}
?>
</div>
<?php
    include('footer.php');
?>