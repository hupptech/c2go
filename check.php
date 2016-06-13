<?php
error_reporting(1);

// CHECK SESSION
$url = 'https://demo.c2gocard.com/rest/user/checkSession';

$token = trim($_REQUEST['token']);

if($token == ''){
	header("Location:login.php");
} else {

$data['token'] = $token;

$ch = curl_init();    
curl_setopt($ch, CURLOPT_URL, $url); // set url
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

echo $session_result = curl_exec($ch);

//close connection
curl_close($ch);

$session_result = json_decode($session_result);
print_r($session_result);
$error_code =  $session_result->errorCode;

if($error_code == 6) {
	header("Location:login.php");
} else {
	header("Location:pay.php");
}

}
?>
