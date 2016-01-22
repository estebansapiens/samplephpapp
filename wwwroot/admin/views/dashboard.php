<link rel="stylesheet" href="//<?=$GLOBALS['maincontrol']->adminDirectory?>style/dashboard.css">
<div id="header" class="animated flipInX">
	<div class="container">
		<h1><!--Studio7Salon --><small>Panel de Administración</small></h1>
	</div>
</div>
<div class="container" id="dashboardContainer">
	<div class="jumbotron col-md-12">
		<h2>Bienvenido(a) al Panel de Administracion!</h2>
		<p>
			Desde aquí usted podrá modificar el contenido de su sitio web.
		</p>
	</div>
	<div id="errorcontainer" class="col-md-12">
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
	<div class="col-md-12 panel panel-default" id="dashboardstats">
		<ul class="nav nav-pills panel">
		  <li role="presentation" class="active"><a data-toggle="tab" href="#promotions">Promociones</a></li>
		  <li role="presentation"><a data-toggle="tab" href="#team">Equipo</a></li>
		  <li role="presentation"><a data-toggle="tab" href="#hours_of_service">Horarios de Atención</a></li>
		  <li role="presentation"><a data-toggle="tab" href="#testimonial">Testimonios</a></li>
		  <li role="presentation"><a data-toggle="tab" href="#gallery">Galeria</a></li>
		  <li role="presentation"><a data-toggle="tab" href="#advanced-config">Config. Avanzada</a></li>
		</ul>
		
		<div class="tab-content">
			<div class="tab-pane fade in active col-md-12" id="promotions">
				<?php
				// Promotions Section
				include_once "./views/dashboard/sections/promotions.php";
				?>
			</div>
			<div class="tab-pane fade col-md-12" id="team">
				<?php
				// Team Section
				include_once "./views/dashboard/sections/team.php";
				?>
			</div>
			<div class="tab-pane fade col-md-12" id="hours_of_service">
				<?php
				// Hours of Service Section
				include_once "./views/dashboard/sections/hours_of_service.php";
				?>
			</div>
			<div class="tab-pane fade col-md-12" id="testimonial">
				<?php
				// Testimonial Section
				include_once "./views/dashboard/sections/testimonial.php";
				?>
			</div>
			<div class="tab-pane fade col-md-12" id="gallery">
				<?php
				// Gallery Section
				include_once "./views/dashboard/sections/gallery.php";
				?>
			</div>
			<div class="tab-pane fade col-md-12" id="advanced-config">
				<?php
				// Advanced Settings Section
				include_once "./views/dashboard/sections/advanced-configurations.php";
				?>
			</div>
		</div>
		
	</div>
</div>

<script src="//<?=$GLOBALS['maincontrol']->adminDirectory?>scripts/dashboard.php"></script>
