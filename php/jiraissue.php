<?php
session_start();
require_once dirname(__FILE__) . '/src/Unirest.php';
require_once dirname(__FILE__) . '/constants.php';

$respuesta = array("result" => 0, "mensajes"=>'');
$horas = 0;
$min = 0;

if(isset($_POST['horas']) && $_POST['horas'] != '')
	$horas = $_POST['horas']*60*60;
if(isset($_POST['min']) && $_POST['min'] != '')
	$min = $_POST['min']*60;

$tiempo_en_segundos = $horas + $min;
$uri = $url.$issue_detail.$_POST['id'];
$headers = array(
  'Accept' => 'application/json',
  'Bearer' => $_COOKIE['cloud_session_token']
);
$response = Unirest\Request::get(
  $uri,
  $headers
);
$issue = $response->body->fields;
/* CONDICIONES */
$bandera = $issue->timetracking->originalEstimateSeconds - $issue->timetracking->timeSpentSeconds;
$holgura_seg = ($issue->timetracking->originalEstimateSeconds * $porcentaje_holgura )/100;
$estimado_mas_holgura = $issue->timetracking->originalEstimateSeconds + $holgura_seg;
$tiempo_a_enviar = $issue->timetracking->timeSpentSeconds + $tiempo_en_segundos;
/* END CONDICIONES */

if($estimado_mas_holgura < $tiempo_a_enviar )
{
	$respuesta = array("result" => 0, "mensajes"=>"ELEMENTO ".$_POST['id']." NO FUE ACTUALIZADO, EL TIEMPO ES MAYOR AL $porcentaje_holgura % PERMITIDO");
}
else{
	$service5 = "/rest/api/3/issue/".$_POST['id']."/worklog";
	$headers = array(
	  'Accept' => 'application/json',
	  'Content-Type' => 'application/json',
	  'Bearer' => $_COOKIE['cloud_session_token']
	);
	$body = json_encode(array('timeSpentSeconds' => $tiempo_en_segundos));
	$response = Unirest\Request::post(
	  $url.$service5,
	  $headers,
	  $body
	);
	$respuesta = array("result" => 1, "mensajes"=>'EL ELEMENTO '.$_POST['id'].' FUE ACTUALIZADO SATISFACTORIAMENTE');
}
echo json_encode($respuesta);