<?php
// Settings Start
$dirname = "/views/forms/team_members/";
$settingsfile = dirname(__FILE__).$dirname."config.php";
$settingscodehandle = fopen($settingsfile, "r");
$settingsdata = @fread($settingscodehandle, filesize($settingsfile));
eval(' ?>'.$settingsdata.'<?php ');
// Settings End
include_once('./views/forms/form-templates/create.php');
?>
