<?php
session_start();
require_once dirname(__FILE__) . '/php/src/Unirest.php';
require_once dirname(__FILE__) . '/php/constants.php';
$response = Unirest\Request::get( $url.'/rest/agile/1.0/board/1/issue',	$headers);
?>
	<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>JIRA[ALSIE]</title>
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<link rel="stylesheet" href="materialize/css/materialize.css">
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<style>

			.modal {
			  left: 0;
			  right: 0;
			  background-color: #e1f5fe;
			  padding: 0;
			  max-height: 40%;
			  width: 35%;
			  will-change: top, opacity;
			}
			.modal .modal-footer {
			  border-radius: 0 0 2px 2px;
			  background-color: #01579b;
			  padding: 4px 6px;
			  height: 60px;
			  width: 100%;
			  text-align: right;
			}
		</style>
	</head>
	<body>

		<nav>
			<div class="nav-wrapper purple">
				<a href="#!" class="brand-logo"><i class="material-icons">cloud</i>JIRA[ALSIE]</a>
				<ul class="right hide-on-med-and-down">
					<li><a href="sass.html"><i class="material-icons">close</i></a></li>
				</ul>
			</div>
		</nav>
		<ul id="slide-out" class="sidenav">
			<li><div class="user-view">
				<div class="background">
					<img src="imgs/office.jpg">
				</div>
				<a href="#user"><img class="circle" src="imgs/yuna.jpg"></a>
				<a href="#name"><span class="white-text name">Elsa Brosso</span></a>
				<a href="#email"><span class="white-text email">eresun@mari.com</span></a>
			</div></li>
			<li><a href="#!"><i class="material-icons">cloud</i>1</a></li>
			<li><a href="#!">2</a></li>
			<li><div class="divider"></div></li>
			<li><a class="subheader">3</a></li>
			<li><a class="waves-effect" href="#!">4</a></li>
		</ul>
		<a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>

		<div class="container">
			<h2>ISSUES</h2>
			<ul class="collapsible">
			<?php foreach($response->body->issues as $v): ?>
				<li>
					<div class="collapsible-header"><i class="material-icons">whatshot</i><?php echo " [".$v->key."]".$v->fields->summary;?>
					<span class="new badge green">
						<?php if(isset($v->fields->timetracking)):
									echo "Estimado: ".$v->fields->timetracking->originalEstimate."  - registrado: ".$v->fields->timetracking->timeSpent;
								else:	echo "-";
								endif;	?>
					</span></div>
					<div class="collapsible-body">
						<div class="card-panel">
						    <span class="purple lighten-3 text-white-2"><?php echo $v->fields->project->key." - ".$v->fields->description ." -> ".(($v->fields->timeoriginalestimate / 60)/60) ."hrs"; ?></span>
					  	</div>
						<div class="input-field col s4">
							<input placeholder="horas" id="horas" type="number" class="validate" name="horas<?php echo $v->key;?>">
							<label for="horas">Horas</label>
				        </div>

				        <div class="input-field col s4">
							<input placeholder="minutos" id="minutos" type="number" class="validate" name="minutos<?php echo $v->key;?>">
							<label for="minutos">Minutos</label>
				        </div>

						<button class="btnbtn btn waves-effect waves-light" data-id="<?php echo $v->key; ?>" type="submit" name="action">Enviar
							<i class="material-icons right">send</i>
						</button>

					</div>
				</li>
			<?php endforeach; ?>
			</ul>

		</div>

		<!-- Modal Structure -->
		<div id="modalNOK" class="modal">

				<div class="card-panel pink darken-2  col s12">
					<h4 >ERROR</h4>
					<p id="mensaje_rest">...</p>
					<a href="#!" class="modal-action modal-close waves-effect waves-red btn red darken-3">OK</a>
				</div>
		</div>

		<!-- MODAL OK -->
		<div id="modalOK" class="modal">
			<div class="card-panel green accent-3  col s12">
				<h4>SATISFACTORIO</h4>
				<p id="mensaje_rest_ok">...</p>
				<a href="#!" class="modal-action modal-close waves-effect waves-red btn green darken-3">OK</a>
			</div>

		</div>

		<script src="vendors/jquery/dist/jquery.min.js"></script>
		<script type="text/javascript" src="materialize/js/materialize.min.js"></script>
		<script type="text/javascript" src="js/app.js"></script>
		<script>

			$(document).ready(function(){
				$('.collapsible').collapsible();
				$('.sidenav').sidenav();
			});
		</script>
	</body>
	</html>