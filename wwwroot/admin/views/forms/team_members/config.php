<?php
// Settings Start
$tablename = "team_members";
$id_field = "member_id";
$nodename = "Miembro(a) del Equipo";
$formid = "team-member-update";
$formaction = "//".$GLOBALS['maincontrol']->adminDirectory."forms/team/update.php";
/* Order stuff */
$orderenabled = true;
$ordercolumn = "member_order";
$ordermax = 10;
/* Types: s = string, i = integer, d = double,  b = blob */
$tablecolumns = array(
	"member_name"=>array(
		"data-type"	=>	"s",
		"input-type"	=>	"text",
		"label"	=>	"Nombre Completo",
		"placeholder"	=>	"Ingrese el nombre del miembro(a) del equipo",
		"input-class"	=>	"form-control"
	),
	"member_position"=>array(
		"data-type"	=>	"s",
		"input-type"	=>	"text",
		"label"	=>	"Posición de Trabajo",
		"placeholder"	=>	"Ingrese el nombre del cargo que ejerse este miembro",
		"input-class"	=>	"form-control"
	),
	"member_googleplus"=>array(
		"data-type"	=>	"s",
		"input-type"	=>	"text",
		"label"	=>	"Perfil de Google+",
		"placeholder"	=>	"Ingrese el URL del perfil de Google+",
		"input-class"	=>	"form-control"
	),
	"member_facebook"=>array(
		"data-type"	=>	"s",
		"input-type"	=>	"text",
		"label"	=>	"Perfil de Facebook",
		"placeholder"	=>	"Ingrese el URL del perfil de Facebook",
		"input-class"	=>	"form-control"
	),
	"member_description"=>array(
		"data-type"	=>	"s",
		"input-type"	=>	"textarea",
		"label"	=>	"Descripción del Empleado(a)",
		"placeholder"	=>	"Ingrese la descripción corta que aparece abajo de la imagen en el sitio web",
		"input-class"	=>	"form-control"
	),
	"member_makeuplevel"=>array(
		"data-type"	=>	"i",
		"input-type"	=>	"select",
		"input-options"	=>	"",
		"label"	=>	"Nivel de Maquillaje (1 - 100)",
		"placeholder"	=>	"",
		"input-class"	=>	"form-control"
	),
	"member_manicurelevel"=>array(
		"data-type"	=>	"i",
		"input-type"	=>	"select",
		"input-options"	=>	"",
		"label"	=>	"Nivel de Manicura (1 - 100)",
		"placeholder"	=>	"",
		"input-class"	=>	"form-control"
	),
	$ordercolumn=>array(
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
	"member_manicurelevel" => array(
		"maxvalue" => 100
	),
	"member_makeuplevel" => array(
		"maxvalue" => 100
	)
);
// Settings End

?>