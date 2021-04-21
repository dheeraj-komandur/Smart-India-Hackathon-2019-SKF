<?php
session_start();
date_default_timezone_set("Asia/Kolkata");
if(isset($_SESSION['profile']))
{	
		include('db.php');
		$id = $_GET['id'];
		$sup = $_GET['sup'];
		$forgedringstock = $_GET['forgedringstock'];
		$intransitforging = $_GET['intransitforging'];
		$turningvendorwip = $_GET['turningvendorwip'];
		$finishringvendor = $_GET['finishingringvendor'];
		$intransitfinishingring = $_GET['intransitfinishring'];
		$finishringwh = $_GET['finishringwh'];
		$totalstock = $_GET['totalstock'];
		$newstock = $_GET['newstock'];
		$dateoforder = $_GET['dateoforder'];
		$ssl = $_GET['ssl'];
		$currentbatch = $totalstock/$ssl + 1;
		$totalstock = $totalstock + $newstock;
		$lastreceiptdate = $_GET['lastreceiptdate'];
		$rlt = $_GET['rlt'];
		$projectname = $_GET['projectname'];
		$query = "UPDATE masterdb SET forgedringstock=$forgedringstock,intransitforging=$intransitforging,turningvendorwip=$turningvendorwip,finishingringvendor=$finishringvendor,intransitfinishingring=$intransitfinishingring,finishringwh=$finishringwh,totalstock=$totalstock,lastreceiptdate='$lastreceiptdate',confirmed=1,currentbatch='$currentbatch' WHERE id=$id";
		$result = mysqli_query($db_result,$query);
		if($result){
            $mail_query = "SELECT * FROM users WHERE userid = '$sup'";
            $mail_result = mysqli_query($db_result, $mail_query);
            $row = mysqli_fetch_row($mail_result);
            
            
            $x = date('Y-m-d', strtotime($dateoforder. ' + '.($rlt*$currentbatch).' days'));
			$date1 = new DateTime($x);
			$date2 = new DateTime(date('Y-m-d'));
			$days  = $date2->diff($date1)->format('%a');
        	$r = ($days)/$rlt;
	        if($r>=0.7){
	            ini_set('display errors', 1);
	            error_reporting( E_ALL );
	            $from = $row[5];
	            $to = "skf@creationdevs.in";
	            $subject = $projectname." order on time!";
	            $message = "Hello SKF,\nYour order from ".ucwords(str_replace("_"," ",$row[1]))." is on time.\nClick here to view the order https://skf.creationdevs.in";
	            $header = "From: ".$from;
	            mail($to,$subject,$message,$header);
	            header('Location:suppliervieworder.php');
	            $message = "Hello SKF,\nYour order from ".ucwords(str_replace("_"," ",$row[1]))." is on time.\nClick here to view the order https://skf.creationdevs.in";
	            $mobileNumber = "7776877364";
	            include('sms.php');
	        }
	
		}
		else
			echo "There was an error";
}
?>