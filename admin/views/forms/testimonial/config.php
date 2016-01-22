<?php
// Settings Start
$tablename = "testimonial";
$id_field = "testimonial_id";
$nodename = "Testimonio";
$formid = "testimonial-update";
$formcreateaction = "//".$GLOBALS['maincontrol']->adminDirectory."forms/".$tablename."/create.php";
$formupdateaction = "//".$GLOBALS['maincontrol']->adminDirectory."forms/".$tablename."/update.php";
/* Order stuff */
$orderenabled = true;
$ordercolumn = "testimonial_order";
$ordermax = 10;
/* Types: s = string, i = integer, d = double,  b = blob */
$tablecolumns = array(
	"testimonial_service"=>array(
		"data-type"	=>	"i",
		"input-type"	=>	"radio",
		"input-options"	=>	array(
			"1"	=>	"Activado",
			"0"	=>	"Desactivado",
		),
		"label"	=>	"Estado",
		"placeholder"	=>	"",
		"input-class"	=>	"radio-inline"
	),
	"testimonial_title"=>array(
		"data-type"	=>	"s",
		"input-type"	=>	"text",
		"label"	=>	"Titulo Informativo",
		"placeholder"	=>	"Ingrese un titulo informativo para el testimonio",
		"input-class"	=>	"form-control"
	),
	"testimonial_content"=>array(
		"data-type"	=>	"s",
		"input-type"	=>	"textarea",
		"label"	=>	"Contenido del Testimonio",
		"placeholder"	=>	"Ingrese el contenido que sale en el sitio web",
		"input-class"	=>	"form-control"
	),
	"testimonial_picture"=>array(
		"data-type"	=>	"s",
		"input-type"	=>	"text",
		"label"	=>	"Imagen de Testimonio",
		"placeholder"	=>	"Ingrese la imagen que saldrá al lado del testimonio",
		"input-class"	=>	"form-control"
	),
	"testimonial_order"=>array(
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