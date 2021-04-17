<?php
date_default_timezone_set("Asia/Kolkata");
$ip = $_SERVER['REMOTE_ADDR'];
$data = "$name\t\t".$ip."\t\t: ".date("d-m-Y") . " " . date("h:i:sa");
$fo = fopen("ip_logout.txt", "a");
$fw = fwrite($fo, "$data\n");
fclose($fo);
?>
