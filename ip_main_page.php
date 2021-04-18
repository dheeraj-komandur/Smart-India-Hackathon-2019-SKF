<?php
date_default_timezone_set("Asia/Kolkata");
$ip = $_SERVER['REMOTE_ADDR'];
$data = $ip."\t\t: ".date("d-m-Y") . " " . date("h:i:sa");
$fo = fopen("ip_main_page.txt", "a");
$fw = fwrite($fo, "$data\n");
fclose($fo);
?>
