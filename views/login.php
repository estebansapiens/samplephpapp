<link rel="stylesheet" href="//<?=$GLOBALS['maincontrol']->adminDirectory?>style/login.css">

<div id="header" class="animated flipInX">
	<div class="container">
		<div class="page-header">
			<h1><?=$GLOBALS['systemconfigs']->appDetails['appName']?> <small>Inicio de Sesión</small></h1>
		</div>
	</div>
</div>

<div class="container">
	<div id="errorcontainer">
		<?php
		foreach ($GLOBALS['sessioncontrol']->validationErrors as $key => $value) {
		?>
		<div class="alert alert-danger animated flipInX" role="alert">
		  <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
		  <span class="sr-only">Error:</span>
		  <?=$value?>
		</div>
		<?php
		}
		?>
	</div>
	<div id="login-form-container" class="card card-container animated zoomInLeft">
		<img id="profile-img" class="profile-img-card" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png" />
		<p id="profile-name" class="profile-name-card"></p>
		<form class="form-signin" action="/" method="post" id="login-form">
			<span id="reauth-email" class="reauth-email"></span>
			<input type="hidden" name="logintype" value="admin" id="logintype">
			<input type="hidden" name="adminlogin" value="1">
			<input name="username" pattern=".{<?=$GLOBALS['sessioncontrol']->usernameMinLength?>,<?=$GLOBALS['sessioncontrol']->usernameMaxLength?>}" required title="<?=$GLOBALS['sessioncontrol']->usernameMinLength?> to <?=$GLOBALS['sessioncontrol']->usernameMaxLength?> characters" type="email" id="inputEmail" class="form-control" placeholder="Correo Electrónico" value="<?=(isset($_POST['username']))?$_POST['username']:""?>" required autofocus>
			<input name="password" pattern=".{<?=$GLOBALS['sessioncontrol']->passwordMinLength?>,<?=$GLOBALS['sessioncontrol']->passwordMaxLength?>}" required title="<?=$GLOBALS['sessioncontrol']->passwordMinLength?> to <?=$GLOBALS['sessioncontrol']->passwordMaxLength?> characters" type="password" id="inputPassword" class="form-control" placeholder="Contraseña" value="<?=(isset($_POST['password']))?$_POST['password']:""?>" required>
			<div class="form-group">
				<button id="appAdmin" class="btn btn-lg btn-primary btn-block btn-signin" type="button">
					Iniciar Sesion
				</button>
			</div>
		</form>
	</div>
</div>

<script src="//<?=$GLOBALS['maincontrol']->adminDirectory?>scripts/login.php"></script>