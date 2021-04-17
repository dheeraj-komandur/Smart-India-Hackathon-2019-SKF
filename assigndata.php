<?php
	session_start();
	date_default_timezone_set("Asia/Kolkata");
	include('db.php');
	if(isset($_SESSION['profile']))
	{
	$projectname = $_GET['project_name'];
	$bearingtype = $_GET['bearing_type'];
	$bearingpart = $_GET['bearing_part'];
	$supplier = $_GET['supplier'];
	$yearlyvolume = $_GET['yearly_volume'];
	$frequency = $_GET['frequency'];
	$mode = $_GET['mode'];
	$dateoforder = $_GET['dateoforder'];
	$confirmed = 0;
	$ssl = $yearlyvolume / $frequency;
	/*$forgedringstock = $_GET['forged_ring_stock'];
	$intransitforging = $_GET['intransitforging'];
	$turningvendorwip = $_GET['turningvendorwip'];
	$finishingringvendor = $_GET['finishingringvendor'];
	$intransitfinishingring = $_GET['intransitfinishingring'];
	$finishringwh = $_GET['totalstock'];
	$lastreceiptdate = $_GET['lastreceiptdate'];
	$rltgiven = $_GET['rltgiven'];
	$status = $_GET['status'];
	$updateddate = $_GET['updateddate'];*/
	if($mode==1)
	{
		$servicefactor = 0;
		$flexibilityfactor = 0;
		$servicestocklevel = $ssl; //check
		$replenishmentleadtime = 25;    //check
		$callofldt = 0;
		$averageproductionlot = 0;
		$agreedleadtime = 0;
	}
	else if($mode==2)
	{	
		$servicefactor = $_GET['service_factor'];
		$flexibilityfactor = $_GET['flexibility_factor'];
		$servicestocklevel = $_GET['service_stock_level'];
		$replenishmentleadtime = $_GET['replenishment_lead_time'];
		$callofldt = $_GET['call_of_ldt'];
		
		$averageproductionlot = 0;
		$agreedleadtime = 0;	
	}
	else
	{
		$servicefactor = 0;
		$flexibilityfactor = 0;
		$servicestocklevel = $ssl;
		$replenishmentleadtime = 25;    //check
		$callofldt = 0;
		
		$averageproductionlot = $_GET['average_production_lot'];
		$agreedleadtime = $_GET['agreed_lead_time'];
	}
	$query = "INSERT INTO masterdb(projectname,bearingtype,bearingpart,supplier,yearlyvolume,frequency,mode1,servicefactor,flexibilityfactor,servicestocklevel,replenishmentleadtime,callofldt,averageproductionlot,agreedleadtime,forgedringstock,intransitforging,turningvendorwip,finishingringvendor,intransitfinishingring,finishringwh,totalstock,lastreceiptdate,rltgiven,status1,updateddate,dateoforder,confirmed) values('$projectname','$bearingtype','$bearingpart','$supplier',$yearlyvolume,$frequency,$mode,$servicefactor,$flexibilityfactor,$servicestocklevel,$replenishmentleadtime,$callofldt,$averageproductionlot,$agreedleadtime,0,0,0,0,0,0,0,'','','','','$dateoforder',$confirmed);";
	
	try{	
	$result = mysqli_query($db_result,$query);
	if($result){
	    $getsupquery = "SELECT * FROM users WHERE userid = '$supplier'";
	    $supresult = mysqli_query($db_result, $getsupquery);
	    $sup_result_row = mysqli_fetch_row($supresult);
	    ini_set('display errors', 1);
	    error_reporting( E_ALL );
	    $from = "skf@creationdevs.in";
	    $to = "$sup_result_row[5]";
	    $subject = "New order from SKF!";
	    $message = "Hello ".str_replace("_"," ",ucwords($supplier)).", \nYou have received a new order from SKF.\n\nFollowing are the details:\nBearing Type:\t".$bearingtype."\nBearing Part:\t".$bearingpart."\nYearly Volume:\t".$yearlyvolume."\n\nClick to visit https://skf.creationdevs.in";
        $header = "From: ".$from;
        mail($to,$subject,$message,$header);
        $message = "Hello ".str_replace("_"," ",ucwords($supplier)).", \nYou have received a new order from SKF.\n\nFollowing are the details:\nBearing Type:\t".$bearingtype."\nBearing Part:\t".$bearingpart."\nYearly Volume:\t".$yearlyvolume."\n\nClick to visit https://skf.creationdevs.in";
        $mobileNumber = $sup_result_row[6];
        include('sms.php');
	}
	else{
	    echo "failure";
	}
	}
	catch(Exception $e)
	{
		echo $e->getMessage();
	}
	//if($result)
		//echo "<script type='text/javascript'>alert('Job assigned');</script>";
	header('Location:assigned.php');
	}
	else
	{
		header('Location:index.php');
	}
	
	//INSERT INTO masterdb(projectname,bearingtype,bearingpart,supplier,yearlyvolume,frequency,mode,servicefactor,flexibilityfactor,servicestocklevel,replenishmentleadtime,callofldt,averageproductionlot,agreedleadtime,forgedringstock,intransitforging,turningvendorwip,finishingringvendor,intransitfinishingring,finishringwh,totalstock,lastreceiptdate,rltgiven,status,updateddate) values('','','','',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'','','','')
?>