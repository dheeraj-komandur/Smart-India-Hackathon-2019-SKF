<?php
include("cssv.php");
$cssv = new cssv();
if(isset($_POST['sub'])){
   $cssv->import($_FILES['file']['tmp_name']);
    
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>CSV</title>
    </head>
    <body>
        <form method="post" enctype ="multipart/part-data">
            <input type = "file" name = "file">
            <input type = "submit" name = "sub" value=  "Import"> 
        </form>
    </body>
</html>


























