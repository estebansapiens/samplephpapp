<?php

/* @Creation Date: 10/7/2015
 * @Modification Date: 10/7/2015
 * @Author: Esteban Arias Gonzalez (earias@sapiens.co.cr)
 * 
 * Page Control Class implements logic based on existing views 
 * and renders the page being requested by the user as long as 
 * he is authorized by the system.
 */

class PageControlHandler {
	
	// Main Variables
	public $currentPageName = "";
	public $currentPageCode = "";
	
	// Views directory
	private $viewsdirectory = "../admin/views/";
	
	// Constructor function
	public function __construct() {
		$this->processPage();
	}
	
	private function processPage() {
		// Check if the page being requested is not the index
		$requestedpage = "";
		if (isset($_GET['path'])) {
			$requestedpage = $_GET['path'];
			// Add the php termination if not existing
			if (!strpos($requestedpage, ".php")) {
				$requestedpage.=".php";
			}
		} else {
			$requestedpage = "dashboard.php";
		}
		// Check if the user is logged in
		if (!$GLOBALS['sessioncontrol']->isloggedin) {
			$requestedpage = "login.php";
		}
		// Get the method of request
		$method = $_SERVER['REQUEST_METHOD'];
		// Check if the requested page exists
		if (file_exists($this->viewsdirectory.$requestedpage)) {
			$this->currentPageName = $requestedpage;
			$pagecodehandle = fopen($this->viewsdirectory.$requestedpage, "r");
			$this->currentPageCode = @fread($pagecodehandle, filesize($this->viewsdirectory.$requestedpage));
		} else {
			// The page requested doesn't exist
			$this->currentPageName = "404.php";
			$pagecodehandle = fopen($this->viewsdirectory."404.php", "r");
			$this->currentPageCode = @fread($pagecodehandle, filesize($this->viewsdirectory."404.php"));
		}
	}
	
}

// Initialize the Page Control Class
$GLOBALS['pagecontrol'] = new PageControlHandler();
