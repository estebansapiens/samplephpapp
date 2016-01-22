<?php
// Settings Start
$tablename = "promotions";
$id_field = "promotion_id";
$nodename = "Promoción";
$formid = "promotion-create";
$formcreateaction = "//".$GLOBALS['maincontrol']->adminDirectory."forms/".$tablename."/create.php";
$formupdateaction = "//".$GLOBALS['maincontrol']->adminDirectory."forms/".$tablename."/update.php";
/* Order stuff */
$orderenabled = true;
$ordercolumn = "promotion_order";
$ordermax = 10;
/* Types: s = string, i = integer, d = double,  b = blob */
$tablecolumns = array(
	"promotion_title"=>array(
		"data-type"	=>	"s",
		"input-type"	=>	"text",
		"label"	=>	"Titulo",
		"placeholder"	=>	"Ingrese el titulo de la promoción",
		"input-class"	=>	"form-control"
	),
	"promotion_description"=>array(
		"data-type"	=>	"s",
		"input-type"	=>	"textarea",
		"label"	=>	"Descripción",
		"placeholder"	=>	"Ingrese la descripción de la promoción",
		"input-class"	=>	"form-control"
	),
	"promotion_picture"=>array(
		"data-type"	=>	"s",
		"input-type"	=>	"text",
		"label"	=>	"Imagen",
		"placeholder"	=>	"Ingrese la imagen de la promoción",
		"input-class"	=>	"form-control"
	),
	"promotion_startdate"=>array(
		"data-type"	=>	"s",
		"input-type"	=>	"text",
		"label"	=>	"Fecha de Inicio",
		"placeholder"	=>	"Ingrese la fecha de inicio de la promoción",
		"input-class"	=>	"form-control"
	),
	"promotion_enddate"=>array(
		"data-type"	=>	"s",
		"input-type"	=>	"text",
		"label"	=>	"Fecha de Finalización",
		"placeholder"	=>	"Ingrese la fecha de finalización de la promoción",
		"input-class"	=>	"form-control"
	),
	"promotion_status"=>array(
		"data-type"	=>	"i",
		"input-type"	=>	"radio",
		"input-options"	=>	array(
			"1"	=>	"Activada",
			"0"	=>	"Desactivada",
		),
		"label"	=>	"Estado",
		"placeholder"	=>	"",
		"input-class"	=>	"radio-inline"
	),
	"promotion_order"=>array(
		"data-type"	=>	"i",
		"input-type"	=>	"select",
		"input-options"	=>	"",
		"label"	=>	"Orden",
		"placeholder"	=>	"",
		"input-class"	=>	"form-control"
	)
);
/* Extra Select arrays */
$selectgroups = array(
	
);
// Settings End
?>