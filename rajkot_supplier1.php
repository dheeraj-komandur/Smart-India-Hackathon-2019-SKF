<?php
    include('header.php');
    if(isset($_SESSION['profile'])){
        include('db.php');
               function insert(){
            include('db.php');
            $mobileNumber = "7776877364,9284847643";
            //9145029115,9975553194";
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
        $query = "SELECT * FROM week_status WHERE supplier = 'rajkot_supplier'";
        $rows = mysqli_query($db_result,$query);
?>
<div class="col-md-10 container">
    <br>

    <div class="col-md-12">
        <div class="form-group">
            <h5><label>Supplier1_order list: </label></h5>
         <select class="form-control col-md-6">
               <option name="supplier" value="def">Bearing Type</option>
  <option name="supplier" value="Supplier 1">11210_TN9 IR</option>
    <option name="supplier" value="Pune">11210_TN9 OR</option>

</select>       
        </div>
    </div>
    <br>
   <h3> Order Details_Rajkot Supplier 1</h3><br>
<table class="table table-striped table-bordered">
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
while($row = mysqli_fetch_row($rows)){
?>
        <tr>
   <td >
       <?php echo $row[2]; ?>
   </td> 
      <td style="padding:10px;background-color:<?php echo getColour($row[3]); ?>">
   </td> 
      <td style="padding:10px;background-color:<?php echo getColour($row[4]); ?>">
   </td> 
      <td style="padding:10px;background-color:<?php echo getColour($row[5]); ?>">
   </td> 
      <td style="padding:10px;background-color:<?php echo getColour($row[6]); ?>">
   </td> 
      <td style="padding:10px;background-color:<?php echo getColour($row[7]); ?>">
   </td> 
      <td style="padding:10px;background-color:<?php echo getColour($row[8]); ?>">
   </td> 
      <td style="padding:10px;background-color:<?php echo getColour($row[9]); ?>">
   </td> 
      <td style="padding:10px;background-color:<?php echo getColour($row[10]); ?>">
   </td> 
      <td style="padding:10px;background-color:<?php echo getColour($row); ?>">
   </td> 
      <td style="padding:10px;background-color:<?php echo getColour($row[12]); ?>">
   </td> 
      <td style="padding:10px;background-color:<?php echo getColour($row[13]); ?>">
   </td> 
      <td style="padding:10px;background-color:<?php echo getColour($row[14]); ?>">
   </td> 
      <td style="padding:10px;background-color:<?php echo getColour($row[15]); ?>">
   </td> 
      <td style="padding:10px;background-color:<?php echo getColour($row[16]); ?>">
   </td> 
      <td style="padding:10px;background-color:<?php echo getColour($row[17]); ?>">
   </td> 
         <td style="padding:10px;background-color:<?php echo getColour($row[18]); ?>">
   </td> 
   <td>
       <form method="get">
       <button type="submit" name="check" id="check" value="<?php echo $row[0] ?>" class="btn btn-primary">CHECK</button>
       </form>
   </td>
   <td style="width:5%">
         <form method="get" action="viewsummary.php?summary=<?php echo $row[0]; ?>">
             <input type="hidden" name = "supplier" value="<?php echo $row[1] ?>">
             <input type="hidden" name = "projectname" value = "<?php echo $row[19] ?>">
             <input type="hidden" name="bearingtype" value = "<?php echo $row[2] ?>">
       <button type="submit" name="summary" id="summary" value="<?php echo $row[0] ?>" class="btn btn-primary">SUMMARY</button>
       </form>     
   </td>
<?php
}

?>
</table>
</div>
<?php
}else{
    header("Location: index.php");
}
    include('footer.php');
?>