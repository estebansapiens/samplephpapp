<?php
// Turn off all error reporting
//error_reporting(0);

// Configuration data
include_once "../classes/config.php";

// Main class
include_once "../classes/main.php";

// User Mantainer
include_once "../classes/user.php";

// Session Mantainer
include_once "../classes/session.php";

// Page Controller
include_once "../classes/scriptcontrol.php";

// JS Header
header("Content-Type: application/javascript");

// Output Script data
eval(' ?>'.$GLOBALS['scriptcontrol']->currentScriptCode.'<?php ');