<?php

/* @Creation Date: 11/7/2015
 * @Modification Date: 11/7/2015
 * @Author: Esteban Arias Gonzalez (earias@sapiens.co.cr)
 * 
 * System Main Control class mantains general functionality.
 */

class SystemMainControl {
	
	// Pointer
	public $adminDirectory;
	
	// Constructor function
	public function __construct() {
		$this->adminDirectory = $_SERVER['SERVER_NAME']."/admin/";
	}
	
	// Logger
	public function logMessage($message) {
		$userip = "";
		// Check for IP Falsification
		if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
		    $userip = $_SERVER['HTTP_CLIENT_IP'];
		} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		    $userip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
		    $userip = $_SERVER['REMOTE_ADDR'];
		}
		$username = (isset($_SESSION['username']))?$_SESSION['username']:"Anonymous";
		$insertlogquery = "
			insert into admin_logs (user, message, user_ip) 
			values (?, ?, ?)
		";
		$insertlog = $GLOBALS['systemconfigs']->dbConnection->prepare($insertlogquery);
		$insertlog->bind_param('sss', $username, $message, $userip);
		$insertlog->execute();
		$insertlog->close();
	}
	
}

// Initialize the Session Class
$GLOBALS['maincontrol'] = new SystemMainControl();
