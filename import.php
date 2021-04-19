<?php
    include("csv.php");
    $csv = new csv();
    if(isset($_POST['sub'])){
        $csv -> import($_FILES['file']['tmp_name']);
    }
?>
<html>
<head>
    <title>CSV</title>
</head>
<body>
    <h1>Click on choose File to upload your file</h1>
    <form method="post" enctype="multipart/form-data">
        <input type="file" name="file">
        <input type="submit" name="sub" value="Import" onclick="myFunction()">
    </form>
    <script>
function myFunction() {
  alert("File Sucessfully uploaded");
}
</script>
</body>
</html>
