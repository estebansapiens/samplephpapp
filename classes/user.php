<?php

/* @Creation Date: 10/19/2015
 * @Modification Date: 10/19/2015
 * @Author: Esteban Arias Gonzalez (earias@sapiens.co.cr)
 * 
 * User Handler for the PicMail Administrative and App-sided
 * useage. Here we can find the user related actions.
 */

class SystemUserHandler {
	
	
	
	// User Creating functionality
	public function createUser($usertype, $userdata) {
		/* Db Sided Account Type
		 * Possible values:
		 * 0 : disabled
		 * 1 : admin
		 * 2 : gmailuser
		 */
		$account_status = 0;
		$username = $userdata['username'];
		$password = sha1($userdata['password']);
		$nickname = $userdata['nickname'];
		switch ($usertype) {
			case 'admin':
				$account_status = 1;
				break;
			
			case 'appgmail':
				$account_status = 2;
				break;
			
			default:
				$account_status = 0;
				break;
		}
		$createuserquery = "
			INSERT INTO users (username, password, account_status, nickname)
			VALUES (?, ?, ?, ?)
		";
		$createuser = $GLOBALS['systemconfigs']->dbConnection->prepare($createuserquery);
		$createuser->bind_param('ssss', $username, $password, $account_status, $nickname);
		$createuser->execute();
		// Close the sql connection
		$createuser->close();
	}
	
}

// Initialize the User Class
$GLOBALS['usercontrol'] = new SystemUserHandler();
