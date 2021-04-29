<?php 
    include('header.php');
    if(isset($_SESSION['profile'])){
    include('db.php');
    $userid = $_GET['userid'];
    $query = "SELECT * FROM stocklevel WHERE supplier = '$userid'";
    $rows = mysqli_query($db_result, $query);
    ?><div class="col-md-12">
    <div class="col-md-10 container">
        <br>
        <h3><?php echo strtoupper(str_replace("_"," ",$userid)); ?></h3>
    <table class="table table-responsive table-striped table-bordered table-hover">
        
        <tr>
            <td>
               <b>Bearing Type</b>
            </td>
                        <td>
               <b>Bearing Part</b> 
            </td>
                        <td>
               <b>Inwards Stock</b> 
            </td>
                        <td>
                <b>Sale</b>
            </td>
                        <td>
                <b>Warehouse balance stock</b>
            </td>
                        <td>
                <b>Rate</b>
            </td>
                        <td>
                <b>Warehouse value</b>
            </td>
                        <td>
                <b>Sales Value</b>
            </td>
                        <td>
                <b>Unit Weight</b>
            </td>
                        <td>
                <b>Warehouse weight</b>
            </td>
        </tr>
    <?php
    while($row = mysqli_fetch_row($rows))
    {
?>
<tr>
    <td><?php echo $row[2]; ?></td>
        <td><?php echo $row[3]; ?></td>
    <td><?php echo $row[4]; ?></td>
    <td><?php echo $row[5]; ?></td>
    <td><?php echo $row[6]; ?></td>
    <td><?php echo $row[7]; ?></td>
    <td><?php echo $row[8]; ?></td>
    <td><?php echo $row[9]; ?></td>
    <td><?php echo $row[10]; ?></td>
    <td><?php echo $row[11]; ?></td>
</tr>
<?php
    }
?>
</table>
    </div>
</div>
<?php
}else{
    header('Location: index.php');
}
    include('footer.php');
?>