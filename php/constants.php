<?php

/* CONFIG HEADERS*/
$headers = array( 'Accept' => 'application/json' );
$porcentaje_holgura = 10;
/* END HEADERS */

//$url = "https://fernandovargasquiroz.atlassian.net";
// pass dominio: smm6)BHZP3YlqB8PT#l6
// jira-et.000webhostapp.com
//ZHuGcMxHkQcDu6sdl#(r

$url = "https://alsiemodulo4.atlassian.net";
$login = "/rest/auth/1/session";
$issue_detail = "/rest/api/3/issue/";
if(isset($_SESSION) && $_SESSION['user'] != '')
	Unirest\Request::auth($_SESSION['user'], $_SESSION['pass']);