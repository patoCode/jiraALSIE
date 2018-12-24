<?php
session_start();
require_once dirname(__FILE__) . '/src/Unirest.php';
require_once dirname(__FILE__) . '/constants.php';

$usr= $_POST['username'];//"e3gan.root@gmail.com";
$pass = $_POST['password'];//"qwerty123";

$headers = array(
  'Accept' => 'application/json',
  'Content-Type' => 'application/json'
);
$body = json_encode(array('username' => $usr, "password"=> $pass));
$response = Unirest\Request::post(
								  $url.$login,
								  $headers,
								  $body
								);
$body_rest = $response->body;

if(isset($body_rest->session))
{
	$_SESSION['user'] = $usr;
	$_SESSION['pass'] = $pass;
	header("Location: ../dash.php");
}else{
	echo $body_rest->errorMessages[0];
}
