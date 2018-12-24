<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>JIRA[ALSIE]</title>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="materialize/css/materialize.css">
	<link rel="stylesheet" href="css/gra.css">
	<link rel="stylesheet" href="css/page-center.css">

	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

</head>
<body class="cyan loaded">
		<div id="login-page" class="row">
			<div class="col s12 z-depth-4 card-panel">
				<form class="login-form" action = "php/jiracookie.php" method="post">
					<div class="row">
						<div class="input-field col s12 center">
							<img src="imgs/account.png" alt="" class="circle responsive-img valign profile-image-login">
							<p class="center login-form-text">Login</p>
						</div>
					</div>
					<div class="row margin">
						<div class="input-field col s12">
							<i class="material-icons prefix pt-5">person_outline</i>
							<input id="username" type="text" name="username">
							<label for="username" class="center-align">usuario</label>
						</div>
					</div>
					<div class="row margin">
						<div class="input-field col s12">
							<i class="material-icons prefix pt-5">lock_outline</i>
							<input id="password" type="password" name="password">
							<label for="password">Password</label>
						</div>
					</div>

					<div class="row">
						<div class="input-field col s12">
							<input class="btn waves-effect waves-light col s12 blue" type="submit" value="ENVIAR">

						</div>
					</div>
				</form>
			</div>
		</div>
		<script type="text/javascript" src="materialize/js/materialize.min.js"></script>
	</body>
	</html>