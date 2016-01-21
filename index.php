<?php
// Turn off all error reporting
//error_reporting(0);

// Configuration data
include_once "./classes/config.php";

// Main class
include_once "./classes/main.php";

// Session Mantainer
include_once "./classes/session.php";

// Page Controller
include_once "./classes/pagecontrol.php";

// Output body only for AJAX Requests
if ((isset($_SERVER['HTTP_X_REQUESTED_WITH']) 
&& strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
|| isset($_GET['postrequest'])) {
	eval(' ?>'.$GLOBALS['pagecontrol']->currentPageCode.'<?php ');
	exit;
}

?><!DOCTYPE HTML>
<html>
<?php
// Page Head
include_once "./sections/head.php";
?>
<body>
	
	<!-- Page Content Container -->
	<div id="pageContent" class="animated">
		<?=eval(' ?>'.$GLOBALS['pagecontrol']->currentPageCode.'<?php ')?>
	</div>

	<?php
	// Page Footer
	include_once "./sections/footer.php";
	?>
	
	<!-- Loading Animation Container -->
	<div id="loading" class="animated" style="display:none;">
		<div class="sk-folding-cube">
		  <div class="sk-cube1 sk-cube"></div>
		  <div class="sk-cube2 sk-cube"></div>
		  <div class="sk-cube4 sk-cube"></div>
		  <div class="sk-cube3 sk-cube"></div>
		</div>
	</div>

</body>
</html>