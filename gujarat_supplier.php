<?php
    include('header.php');
    if(isset($_SESSION['profile'])){
        include('db.php');
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
?>
<br>
<div class="col-md-11 container">
    <script>
    function test(){
   window.location  = "https://creationdevs.in/skf/rajkot_supplier1.php";
    }
</script>
    <div class="col-md-12">
        <div class="form-group">
            <h5><label>Rajkot Region Supplier List: </label></h5>
         <select class="form-control col-md-6"  onchange="test()">
               <option name="supplier" value="def">All</option>
  <option name="supplier" value="Supplier 1">Supplier 1</option>
    <option name="supplier" value="Pune">Supplier 2</option>
      <option name="supplier" value="Belgaum">Supplier 3</option>
  <option name="supplier" value="Jaipur">Supplier 4</option>
    <option name="supplier" value="Jharkhand">Supplier 5</option>
      <option name="supplier" value="Mumbai">Supplier 6</option>

</select>       
        </div>
    </div>
    <br>
    <div class="col-md-8" style="float:right">
        <h5>Dominant delays:</h5>
        <table class="table table-bordered table-striped col-md-12">
            <tr>
            <td style="background-color:green"></td>
            <td style="background-color:blue"></td>
            <td style="background-color:brown"></td>
            <td style="background-color:yellow"></td>
            <td style="background-color:red"></td>
            <tr>
            <td><b>No Delays</b></td>
            <td><b>Transit Delays</b></td>
            <td><b>Production Delays</b></td>
            <td><b>Raw Material not Ordered</b></td>
            <td><b>Not planned delays</b></td>
        </table>
    </div>
    <br>
    <table class="table table-striped table-bordered">
        <tr>
            <td>
                <b>Rajkot Suppliers List</b>
            </td>
                    <td>
                <b>January</b>
            </td>
                        <td>
                <b>February</b>
            </td>
                        <td>
                <b>March  </b>
            </td>
                        <td>
                <b>April  </b>
            </td>
                        <td>
                <b>May  </b>
            </td>
                        <td>
                <b>June  </b>
            </td>
        </tr>
        <tr>
<?php
    $query = "SELECT * FROM gujrat_suppliers";
    $rows = mysqli_query($db_result,$query);
    while($row = mysqli_fetch_row($rows)){
?>
<tr><td><a href="rajkot_supplier1.php"><?php echo $row[1]; ?></a></td>
<td style="background-color:<?php echo getColour($row[2]); ?>"></td>
<td style="background-color:<?php echo getColour($row[3]); ?>"></td>
<td style="background-color:<?php echo getColour($row[4]); ?>"></td>
<td style="background-color:<?php echo getColour($row[5]); ?>"></td>
<td style="background-color:<?php echo getColour($row[6]); ?>"></td>
<td style="background-color:<?php echo getColour($row[7]); ?>"></td>
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