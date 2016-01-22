<?php

header("Content-Type: application/javascript");

// Configuration data
include_once "../classes/config.php";

// Main class
include_once "../classes/main.php";

/* @Creation Date: 10/9/2015
 * @Modification Date: 10/9/2015
 * 
 * App404 functionality container.
 */
?>

var App404 = {
	'init': // Initializer
	function() {
		// Ajaxify new elements
		AppMain.ajaxifyElements();
	}
}

// Initialize the Dashboard
App404.init();