<div class="col-md-3">
	<ul class="nav nav-pills nav-stacked">
		<li role="presentation" class="active">
			<a data-toggle="tab" href="#site-settings">Configuraciones Generales</a>
		</li>
		<li role="presentation">
			<a data-toggle="tab" href="#site-js">JavaScripts del Sistema</a>
		</li>
		<li role="presentation">
			<a data-toggle="tab" href="#site-css">CSS del Sistema</a>
		</li>
	</ul>
</div>
<div class="col-md-9">
	<div class="tab-content">
		<div class="tab-pane fade in active col-md-12" id="site-settings">
			
		</div>
		<div class="tab-pane fade col-md-12" id="site-js">
			<?php
			// Promotions Section
			include_once "settings/admin-js.php";
			?>
		</div>
		<div class="tab-pane fade col-md-12" id="site-css">
			
		</div>
	</div>
</div>