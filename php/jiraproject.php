<?php
require_once dirname(__FILE__) . '/src/Unirest.php';
require_once dirname(__FILE__) . '/constants.php';
echo "<pre>";
$url = "https://alsiemodulo4.atlassian.net/";
$servicio = "/rest/api/3/project/type";

$usr= "e3gan.root";
$pass = "qwerty123";
$token = "VkgbM34UdWGrVOixH14CA0";

echo "<br>++++++++++++++++++++++++++++++  BOARDS  +++++++++++++++++++++++++++++++<br>";
Unirest\Request::auth($usr, $pass);
$headers = array( 'Accept' => 'application/json' );
$response = Unirest\Request::get( $url.'/rest/agile/1.0/board', $headers );
foreach($response->body->values as $v)
{
	print_r($v);
	echo "<br>";
}
echo "<br>++++++++++++++++++++++++++++++  WORKLOG  +++++++++++++++++++++++++++++++<br>";
$response = Unirest\Request::get( $url.'/rest/agile/1.0/board/1/issue',	$headers);
print_r($response->body->issues);
foreach($response->body->issues as $v)
{
	echo "<h2>".$v->fields->summary."</h2>";
	echo $v->fields->project->key." - ".$v->fields->description ." -> ".(($v->fields->timeoriginalestimate / 60)/60) ."hrs";
	echo "<br> PROGRESS: ".$v->fields->progress->percent." % - Hrs: ".(($v->fields->timeoriginalestimate / 60)/60);
	echo "<br>";
	echo $v->fields->timetracking->originalEstimate;
	echo "<br>";
	echo $v->fields->timetracking->remainingEstimate;
	echo "<br>===================================================== <br>";
}

echo "<br>++++++++++++++++++++++++++++ DETALLE ISSUE +++++++++++++++++++++++++++++++++++++<br>";
$servic_issue = "/rest/api/3/issue/TAR-2";
$headers = array(
  'Accept' => 'application/json',
  'Bearer' => $_COOKIE['cloud_session_token']
);
$response = Unirest\Request::get(
  $url.$servic_issue,
  $headers
);
$issue = $response->body->fields;


if($issue->progress->progress == $issue->progress->total)
{
	echo "****************** ERROR DE TIEMPOS *******************";
}
else{
	echo "<br>++++++++++++++++++++++++++++++  ADD TIME  +++++++++++++++++++++++++++++++<br>";
	$service5 = "/rest/api/3/issue/TAR-1/worklog";


	$headers = array(
	  'Accept' => 'application/json',
	  'Content-Type' => 'application/json',
	  'Bearer' => $_COOKIE['cloud_session_token']
	);
	$body = json_encode(array('timeSpentSeconds' => 18000));
	$response = Unirest\Request::post(
	  $url.$service5,
	  $headers,
	  $body
	);
	//var_dump($response);
}
