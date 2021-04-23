<?php
    session_start();
    if(isset($_SESSION['profile'])){
        $message = $_GET['message'];
        $mobileNumber = "7776877364";
        include('sms.php');
        header("Location: supplierstats.php");
    }else{
        header("Location: index.php");
    }
?>