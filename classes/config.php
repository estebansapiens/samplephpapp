<?php

/* @Creation Date: 10/7/2015
 * @Modification Date: 10/7/2015
 * 
 * System Configurations Class keeps the configuration
 * information as for the Database connectivity functionality.
 */

class SystemConfigurations {
	
	// App details
	public $appDetails = array(
		"appName" => "Studio7Salón",
		"appMainTitle" => "Administrador de Contenido",
		"copyright" => "Copyright 2016",
		"author" => "Esteban Arias",
		"authorURL" => "http://costaricaeasyweb.com/"
	);
	
	// Database access related data
	private $databaseconfig = array(
		"dbname" => "studio7data",
		"dbuser" => "studio7salonadcm",
		"dbpass" => "F3adQKsqzYdFcTHs",
		"dbhost" => "localhost"
	);
	
	// Connection Variable
	public $dbConnection;
	
	// Constructor function
	public function __construct() {
		$this->initializeDatabaseConnection();
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

