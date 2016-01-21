<?php

/* @Creation Date: 10/7/2015
 * @Modification Date: 10/19/2015
 * @Author: Esteban Arias Gonzalez (earias@sapiens.co.cr)
 * 
 * System Session Handler class controls and secures 
 * the functionality of Sessions in PicMail Admin.
 */

class SystemSessionHandler {
	
	// User Credentials Data
	public $isloggedin;
	private $currentuser;
	private $sessionID;
	
	// User Validation Data
	public $usernameMinLength = 5;
	public $usernameMaxLength = 35;
	public $passwordMinLength = 5;
	public $passwordMaxLength = 25;
	public $validationErrors = array();
	
	// Login variables
	private $successfulLogin = false;
	private $username;
	private $password;
	public $usernickname;
	private $userip;
	private $accesstype;
	public $loginuserid;
	
	// App Simulator variables
	public $admintype = "admin";
	
	// Session Expiration Time in Minutes
	private $sessiontimeout = 300;
	
	// Destroy sessions with same user on different machines
	private $uniqueusersession = true;
	
	// Constructor function
	public function __construct() {
		$this->initializeSession();
	}
	
	// Session Initializer and Securer
	private function initializeSession() {
		// Enclose the functionality in a Try block
		try {
			if (isset($_POST['ssid'])) session_id($_POST['ssid']);
			// Check if the user is logging out
			session_start();
			if (isset($_GET['logout']) && isset($_SESSION['username'])) {
				// Log the logout
				$memo = "Logged out from the Admin.";
				$GLOBALS['maincontrol']->logMessage($memo);
				$this->killSession();
			}
			if (!isset($_SESSION['username'])) {
				// User is not logged in
				$this->currentuser = 'anonymous';
				$this->sessionID = 'none';
				$this->isloggedin = false;
				// Check if the user is attempting to login
				if (isset($_POST['username']) || isset($_POST['password'])) {
					$this->validateLogin();
				}
			} else {
				// Validate User Session
				$this->validateSession();
			}
			
		} catch (Exception $e) {
			// There was an error processing the request..lets save it on the database
			$errormemo = "Hubo un error inicializando la sesion del usuario: ".$e->getMessage().". Archivo: ".$e->getFile()." linea ".$e->getLine().".";
			$GLOBALS['maincontrol']->logMessage($errormemo);
		}
	}
	
	// Kill the User Session
	private function killSession() {
		// Enclose the functionality in a Try block
		try {
			if (isset($_SESSION['username'])) {
				$deletesessionquery = "
					delete from session_handle 
					where username = ? and session_id = ?
				";
				$deletesession = $GLOBALS['systemconfigs']->dbConnection->prepare($deletesessionquery);
				$sessionid = session_id();
				$deletesession->bind_param('ss', $_SESSION['username'], $sessionid);
				$deletesession->execute();
				$deletesession->close();
			} else {
				$deletesessionquery = "
					delete from session_handle 
					where session_id = ?
				";
				$deletesession = $GLOBALS['systemconfigs']->dbConnection->prepare($deletesessionquery);
				$deletesession->bind_param('s', session_id());
				$deletesession->execute();
				$deletesession->close();
			}
			
			$this->currentuser = 'anonymous';
			$this->sessionID = 'none';
			$this->isloggedin = false;
			session_destroy();
			session_start();
			
		} catch (Exception $e) {
			// There was an error processing the request
			$errormemo = "Hubo un error al intentar terminar la sesion de un usuario: ".$e->getMessage().". Archivo: ".$e->getFile()." linea ".$e->getLine().".";
			$GLOBALS['maincontrol']->logMessage($errormemo);
			// Kill the session anyways
			$this->currentuser = 'anonymous';
			$this->sessionID = 'none';
			$this->isloggedin = false;
			session_destroy();
			session_start();
		}
	}
	
	// Validate Existing Session via Database Tables
	private function validateSession() {
		// Enclose the functionality in a Try block
		try {
			// Validate session existence in DB
			$validatesessionquery = "
				SELECT timeout from session_handle where username = ? and session_id = ?
			";
			$sessiondata = $GLOBALS['systemconfigs']->dbConnection->prepare($validatesessionquery);
			$sessionid = session_id();
			$sessiondata->bind_param('ss', $_SESSION['username'], $sessionid);
			$sessiondata->execute();
			$sessiontimeout = "";
			$sessiondata->bind_result($sessiontimeout);
			$sessiondata->store_result();
			if ($sessiondata->num_rows==1) {
				// Store the timeout
				while ($row = $sessiondata->fetch()) { }
				// Check if the session has timed out
				if (strtotime($sessiontimeout) >= time()) {
					// Session not Timed Out
					$this->currentuser = $_SESSION['username'];
					$this->sessionID = session_id();
					$this->isloggedin = true;
					// Update timeout on the database
					$newtimeout = date("Y-m-d H:i:s",time() + ($this->sessiontimeout * 60));
					$updatetimeoutquery = "
						update session_handle 
						set timeout = ? 
						where username = ? and session_id = ?
					";
					$refreshsessiontoken = $GLOBALS['systemconfigs']->dbConnection->prepare($updatetimeoutquery);
					$sessionid = session_id();
					$refreshsessiontoken->bind_param('sss', $newtimeout, $_SESSION['username'], $sessionid);
					$refreshsessiontoken->execute();
					$refreshsessiontoken->close();
				} else {
					// Log the successful login
					$memo = "Desconectado por inactividad de la sesion.";
					$GLOBALS['maincontrol']->logMessage($memo);
					// Session Timed Out
					$this->killSession();
				}
			} else {
				// The session requested doesn't exist in the system anymore
				$this->currentuser = 'anonymous';
				$this->sessionID = 'none';
				$this->isloggedin = false;
				session_destroy();
				session_start();
			}
			// Clear Results set
			$sessiondata->close();
			
		} catch (Exception $e) {
			// There was an error processing the request
			$errormemo = "Hubo un error al intentar validar la sesion del usuario: ".$e->getMessage().". Archivo: ".$e->getFile()." linea ".$e->getLine().".";
			$GLOBALS['maincontrol']->logMessage($errormemo);
			// Kill the session to prevent the error to repeat itself
			$this->currentuser = 'anonymous';
			$this->sessionID = 'none';
			$this->isloggedin = false;
			session_destroy();
			session_start();
		}
	}
	
	// Validate User Login based on submitted Username and Password
	private function validateLogin() {
		// Enclose the functionality in a Try block
		try {
			$errors = array();
			// Validate Username input
			if (isset($_POST['username'])) {
				$this->username = mysqli_real_escape_string($GLOBALS['systemconfigs']->dbConnection, $_POST['username']);
				// Validate username length
				if (strlen($this->username) < $this->usernameMinLength || strlen($this->username) > $this->usernameMaxLength) {
					$errors[] = "El correo electronico debe de tener por lo menos {$this->usernameMinLength} y un maximo de {$this->usernameMaxLength} caracteres.";
				} else {
					// Validate username email format
					if (filter_var($this->username, FILTER_VALIDATE_EMAIL) === false) {
						// The user email address is not valid
						$errors[] = "Por favor ingrese un correo electronico.";
					}
				}
			} else {
				// Username not sent in the request
				$errors[] = "Por favor ingrese el correo electronico relacionado a su cuenta.";
			}
			// Validate Password input
			if (isset($_POST['password'])) {
				$this->password = $_POST['password'];
				// Check if the password length is right
				if (strlen($_POST['password']) < $this->passwordMinLength || strlen($_POST['password']) > $this->passwordMaxLength) {
					$errors[] = "La contraseña debe de tener por lo menos {$this->passwordMinLength} y un maximo de {$this->passwordMaxLength} caracteres.";
				}
			} else {
				// The password is not sent in the request
				$errors[] = "Por favor ingrese la contraseña relacionada a su cuenta.";
			}
			// Initialize User Validation if there were no errors encountered
			if (count($errors)==0) {
				$this->performUserLogin();
			} else {
				// Errors encountered on validation
				$this->validationErrors = $errors;
			}
			
		} catch (Exception $e) {
			// There was an error processing the request
			$errormemo = "Hubo un error validando los credenciales de un usuario: ".$e->getMessage().". Archivo: ".$e->getFile()." linea ".$e->getLine().".";
			$GLOBALS['maincontrol']->logMessage($errormemo);
		}
	}
	
	// Function to login a user once the input has been validated
	private function performUserLogin() {
		// Enclose the functionality in a Try block
		try {
			// Error Array for handling unsuccessful login messages
			$errors = array();
			// Access type
			$loginmemo = "";
			if (isset($_POST['logintype'])) {
				switch ($_POST['logintype']) {
						
					case 'admin':
						$this->accesstype = "admin";
						$loginmemo = "Inicio sesión exitosamente en el panel de administración.";
						break;
					
					default:
						$this->accesstype = "unset";
						break;
				}
			}
			// Construct the Query for verifying the user information
			$validateloginquery = "";
			switch ($this->accesstype) {
				case 'admin':
					// Initialize Administrative Login
					$this->password = sha1($this->password);
					$validateloginquery = "
						SELECT nickname, userid from users where username = ? and password = ? and account_status = 1 
					";
					$logindata = $GLOBALS['systemconfigs']->dbConnection->prepare($validateloginquery);
					$logindata->bind_param('ss', $this->username, $this->password);
					$logindata->execute();
					$logindata->bind_result($this->usernickname, $this->loginuserid);
					$logindata->store_result();
					if ($logindata->num_rows==1) {
						// User Data has been matched with requested parameters
						$this->successfulLogin = true;
						// Store the nickname
						while ($row = $logindata->fetch()) { }
					} else {
						// No user data matched with the requested parameters
						$this->successfulLogin = false;
					}
					// Close the sql connection
					$logindata->close();
					break;
				
				default:
					
					break;
			}
			// Check if the Username and Password resulted in a match in the database
			if ($this->successfulLogin) {
				// Username and Password match
				$this->currentuser = $this->username;
				$this->sessionID = session_id();
				$this->isloggedin = true;
				$_SESSION['username'] = $this->username;
				$_SESSION['userid'] = $this->loginuserid;
				$_SESSION['nickname'] = $this->usernickname;
				$_SESSION['accesstype'] = $this->accesstype;
				// Fetch the IP of the user
				// Check for IP Falsification
				if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
				    $this->userip = $_SERVER['HTTP_CLIENT_IP'];
				} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
				    $this->userip = $_SERVER['HTTP_X_FORWARDED_FOR'];
				} else {
				    $this->userip = $_SERVER['REMOTE_ADDR'];
				}
				// Destroy sessions with same username on different machines
				if ($this->uniqueusersession) {
					$deletesessionquery = "
						delete from session_handle 
						where username = ? 
					";
					$deletesession = $GLOBALS['systemconfigs']->dbConnection->prepare($deletesessionquery);
					$deletesession->bind_param('s', $this->username);
					$deletesession->execute();
					$deletesession->close();
				}
				// Insert new Session Data onto Session Handle table
				$newtimeout = date("Y-m-d H:i:s",time() + ($this->sessiontimeout * 60));
				$insertsessionquery = "
					insert into session_handle (session_id, timeout, username, userIP, access_type, user_id) 
					values (?, ?, ?, ?, ?, ?)
				";
				$insertsession = $GLOBALS['systemconfigs']->dbConnection->prepare($insertsessionquery);
				$insertsession->bind_param('ssssss', $this->sessionID, $newtimeout, $this->username, $this->userip, $this->accesstype, $this->loginuserid);
				$insertsession->execute();
				$insertsession->close();
				// Log the successful login
				$GLOBALS['maincontrol']->logMessage($loginmemo);
				// Return the result of the successful login
				//if ($this->is_ajax()) {
					$result = array(
						"status"=>"success",
						"message"=>"Bienvenido(a) de vuelta {$this->usernickname}!",
						"ssid"=>session_id());
					$return = json_encode($result);
					header('Content-Type: application/json');
					echo $return;
					exit;
				//}
			} else {
				// There was no match found on the database
				$errors[] = "El correo y contraseña proporcionados no corresponden a ninguna cuenta, por favor intente denuevo.";
				// Log Failed Login
				$this->logFailedLogin();
				// Return the result of the successful login
				if ($this->is_ajax()) {
					$result = array(
						"status"=>"authentication-error",
						"message"=>"Credenciales equivocados, por favor intente denuevo.");
					$return = json_encode($result);
					header('Content-Type: application/json');
					echo $return;
					exit;
				}
			}
			if (count($errors)>0) {
				$this->validationErrors = $errors;
				// Return the result of the successful login
				if ($this->is_ajax()) {
					$result = array(
						"status"=>"validation-error",
						"message"=>"Por favor corrija los siguientes errores:",
						"errors"=>$errors);
					$return = json_encode($result);
					header('Content-Type: application/json');
					echo $return;
					exit;
				}
			}
		} catch (Exception $e) {
			// There was an error processing the request
			$errormemo = "Hubo un error al intentar iniciar la sesion de un usuario: ".$e->getMessage().". Archivo: ".$e->getFile()." linea ".$e->getLine().".";
			$GLOBALS['maincontrol']->logMessage($errormemo);
		}
	}
	
	private function is_ajax() {
		return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
	}
	
	private function logFailedLogin() {
		if ($this->accesstype == "admin") {
			// Check for IP Falsification
			if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
			    $this->userip = $_SERVER['HTTP_CLIENT_IP'];
			} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			    $this->userip = $_SERVER['HTTP_X_FORWARDED_FOR'];
			} else {
			    $this->userip = $_SERVER['REMOTE_ADDR'];
			}
			$insertfailloginquery = "
				insert into login_attempts (username, userIP) 
				values (?, ?)
			";
			$insertfaillogin = $GLOBALS['systemconfigs']->dbConnection->prepare($insertfailloginquery);
			$insertfaillogin->bind_param('ss', $this->username, $this->userip);
			$insertfaillogin->execute();
			$insertfaillogin->close();
			$memo = "Inicio de sesion equivocado para el usuario: {$this->username}.";
			$GLOBALS['maincontrol']->logMessage($memo);
		}
	}
	
}

// Initialize the Session Class
$GLOBALS['sessioncontrol'] = new SystemSessionHandler();
