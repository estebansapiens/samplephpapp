<?php
// Settings Start
$dirname = "/views/forms/testimonial/";
$settingsfile = dirname(__FILE__).$dirname."config.php";
$settingscodehandle = fopen($settingsfile, "r");
$settingsdata = @fread($settingscodehandle, filesize($settingsfile));
eval(' ?>'.$settingsdata.'<?php ');
// Settings End
include_once('./views/forms/form-templates/update.php');
?>