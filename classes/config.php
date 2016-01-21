<?php

/* @Creation Date: 10/7/2015
 * @Modification Date: 21/1/2016
 * 
 * System Configurations Class keeps the configuration
 * information as for the Database connectivity functionality.
 */

class SystemConfigurations {
	
	// App details
	public $appDetails = array(
		"appName" => "Studio7Salón", // The name of the Custom App
		"appMainTitle" => "Administrador de Contenido", // The title of the page (comes after the App name)
		"copyright" => "Copyright 2016", // The copyright for the footer
		"authorNote" => true, // Set to true if you want to display your credits on the footer (false if not)
		"author" => "Esteban Arias", // The name of the author of the custom App (your name)
		"authorURL" => "http://costaricaeasyweb.com/", // The URL for the footer Author hyperlink
		"appFolder" => "admin", // The folder in which the App is located (if it's in the home, leave it blank)
		"appVersion" => "0.5b", // The version of the App, use b suffix for beta / a for alpha / no suffix for release
	);
	
	// Pointer
	public $appDirectory;
	
	// Database access related data
	private $databaseconfig = array(
		"dbname" => "studio7data", // Database Name
		"dbuser" => "studio7salonadcm", // Database Username
		"dbpass" => "F3adQKsqzYdFcTHs", // Database Password
		"dbhost" => "localhost" // Database host (if it's on another server, put the IP)
	);
	
	// Connection Variable
	public $dbConnection;
	
	// Constructor function
	public function __construct() {
		$this->initializeDatabaseConnection();
		$this->appDirectory = $_SERVER['SERVER_NAME']."/".($this->appDetails['appFolder']!="")?$this->appDetails['appFolder']."/":"";
	}
	
	// Connection declaration private function
	private function initializeDatabaseConnection() {
		// Attempt to establish the connection
		$this->dbConnection = @mysqli_connect($this->databaseconfig['dbhost'], 
									   $this->databaseconfig['dbuser'], 
									   $this->databaseconfig['dbpass'], 
									   $this->databaseconfig['dbname']);
		mysqli_set_charset($this->dbConnection,'utf8');
		// Check if there was an error connecting
		if (mysqli_connect_errno()) {
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
			exit;
		}
	}
	
}

// Initialize System Configurations Class
$GLOBALS['systemconfigs'] = new SystemConfigurations();

