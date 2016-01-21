<?php
// Settings Start
$tablename = "hours_of_service";
$id_field = "service_id";
$nodename = "Horario de Atención";
$formid = "service-edit";
$formcreateaction = "//".$GLOBALS['maincontrol']->adminDirectory."forms/".$tablename."/create.php";
$formupdateaction = "//".$GLOBALS['maincontrol']->adminDirectory."forms/".$tablename."/update.php";
/* Order stuff */
$orderenabled = false;
$ordercolumn = "";
$ordermax = 10;
/* Types: s = string, i = integer, d = double,  b = blob */
$tablecolumns = array(
	"service_start_time"=>array(
		"data-type"	=>	"s",
		"input-type"	=>	"text",
		"label"	=>	"Hora de Inicio",
		"placeholder"	=>	"Ingrese la hora en la que el salón abre",
		"input-class"	=>	"form-control"
	),
	"service_end_time"=>array(
		"data-type"	=>	"s",
		"input-type"	=>	"text",
		"label"	=>	"Hora de Cierre",
		"placeholder"	=>	"Ingrese la hora en la que el salón cierra",
		"input-class"	=>	"form-control"
	)
);
/* Extra Select arrays */
$selectgroups = array(
	
);
// Settings End
?>