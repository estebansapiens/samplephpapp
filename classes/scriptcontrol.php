<?php

/* @Creation Date: 10/7/2015
 * @Modification Date: 10/7/2015
 * @Author: Esteban Arias Gonzalez (earias@sapiens.co.cr)
 * 
 * Page Control Class implements logic based on existing views 
 * and renders the page being requested by the user as long as 
 * he is authorized by the system.
 */

class ScriptControlHandler {
	
	// Main Variables
	public $currentScriptName = "";
	public $currentScriptCode = "";
	
	// Constructor function
	public function __construct() {
		$this->processScript();
	}
	
	private function processScript() {
		// Check if the page being requested is not the index
		$requestedscript = "";
		if (isset($_GET['script'])) {
			$requestedscript = $_GET['script'];
			// Add the php termination if not existing
			if (!strpos($requestedscript, ".js")) {
				$requestedscript.=".js";
			}
		} else {
			$requestedscript = "undefined.js";
		}
		// Check if the user is logged in
		/*if (!$GLOBALS['sessioncontrol']->isloggedin) {
			$requestedscript = "notloggedin.js";
		}*/
		// Clean requestedscript variable
		$requestedscript = $databasedata = $GLOBALS['systemconfigs']->dbConnection->real_escape_string($requestedscript);
		// Check if the requested script exists
		// Fetch the Script element and its data
		$databasequery = "
			select js_id,
			js_content,
			js_filename,
			js_service
			from admin_js 
			where js_filename = '".$requestedscript."' 
			and js_service = 1
		";
		$databasedata = $GLOBALS['systemconfigs']->dbConnection->query($databasequery);
		$dbdataresult = array();
		while ($dbdata = $databasedata->fetch_assoc()) {
			$dbdataresult[] = $dbdata;
		}
		if (count($dbdataresult)>0) {
			$this->currentScriptName = $requestedscript;
			$this->currentScriptCode = $dbdataresult[0]['js_content'];
		} else {
			// The script requested doesn't exist
			$this->currentScriptName = "notfound.js";
			$this->currentScriptCode = "";
		}
	}
	
}

// Initialize the Page Control Class
$GLOBALS['scriptcontrol'] = new ScriptControlHandler();
