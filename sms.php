<?php
//$message, $mobile number



//Your authentication key
$authKey = "265630A5PrJ8SC3N5c7b80c0";

//Multiple mobiles numbers separated by comma
//$mobileNumber = "8806667543,7276898686,8793481025,7776877364";

//Sender ID,While using route4 sender id should be 6 characters long.
$senderId = "SKFCRE";

//Your message to send, Add URL encoding here.
//$message = urlencode("Hello from SKF, your shipment for 99999 Ball bearing will be dispatched shortly in 67min's.");

//Define route 
$route = "4";

//Prepare you post parameters
$postData = array(
    'authkey' => $authKey,
    'mobiles' => $mobileNumber,
    'message' => $message,
    'sender' => $senderId,
    'route' => $route
);

//API URL
$url="http://api.msg91.com/api/sendhttp.php";

// init the resource
$ch = curl_init();
curl_setopt_array($ch, array(
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => $postData
    //,CURLOPT_FOLLOWLOCATION => true
));


//Ignore SSL certificate verification
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);


//get response
$output = curl_exec($ch);

//Print error if any
if(curl_errno($ch))
{
}

curl_close($ch);

?>