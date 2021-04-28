<?php
    include('header.php');
    if(isset($_SESSION['profile'])){
        include('db.php');
        $id = $_GET['id'];
        $supplier = $_GET['supplier'];
        $projectname = $_GET['projectname'];
        $query = "SELECT * FROM masterdb WHERE id='$id'";
        $rows = mysqli_query($db_result,$query);
        $row = mysqli_fetch_row($rows);
?>
<style>
    label{
        font-weight:bold;
    }
</style>
<br>
<div class="col-md-11 container">
    <div class="col-md-12" style="height:20%">
    <div class="col-md-6 col-sm-12" style="float:right">
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
    <br>
    <div class="col-md-10 container">
    <form method="get" action="updatetimelinedata.php">
        <input type="hidden" name="supplier" value="<?php echo $supplier; ?>">
        <input type="hidden" name="projectname" value="<?php echo $projectname ?>">
        <div class="form-group">
            <label>In Transit Batch Size</label>
            <input type="number" name="intransitbatchsize" class="form-control" name="intransitbatchsize" placeholder="In Transit Batch Size">
        </div>
        <div class="form-group">
            <label>WIP Batch Size</label>
            <input type="number" name="wipbatchsize" class="form-control" name="wipbatchsize" placeholder="WIP Batch Size">
        </div>
        <div class="form-group">
            <label>Raw Material Batch Size</label>
            <input type="number" name="rawbatchsize" class="form-control" name="rawbatchsize" placeholder="Raw Material Batch Size">
        </div> 
                <div class="form-group">
            <label>Maximum Warehouse Capacity</label>
            <input type="number" name="maxwhcapacity" class="form-control" name="maxwhcapacity" placeholder="Maximum Warehouse Capacity">
        </div>
        <div class="form-group">
            <label>At warehouse</label>
            <input type="hidden" name="atwarehouse" value=<?php echo $row[20] ?>>
            <input type="number" class="form-control" value=<?php echo $row[20] ?> disabled>
        </div> 
                <div class="form-group">
            <label>In Transit</label>
            <input type="hidden" name="intransit" value=<?php echo $row[19]; ?>>
            <input type="number" class="form-control" value=<?php echo $row[19] ?> disabled>
        </div> 
            <div class="form-group">
            <label>WIP</label>
            <input type="number" value=<?php echo $row[17]+$row[18] ?> class="form-control" disabled>
            <input type="hidden" name="wip" value=<?php echo $row[17]+$row[18] ?>>
        </div> 
            <div class="form-group">
            <label>Raw Material</label>
            <input type="number" value=<?php echo $row[15]+$row[16] ?> class="form-control" disabled>
            <input type="hidden" name="rawmaterial" value=<?php echo $row[15]+$row[16] ?>>
        </div> 
        <div class="form-group">
            <input type="submit" class="form-control btn btn-success" name="Update Timeline" value="Update Timeline">
        </div>
        
    </form>
    </div>
    
    
    
    
    
    
    
    </div>
<?php
        
    }else{
        header('Location: index.php');
    }

    include('footer.php');
?>