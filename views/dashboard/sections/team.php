<?php
// Advanced Settings Section
include_once "./views/forms/team_members/mainsettings.php";
?>
<div class="panel panel-default col-md-7">
<?php
// Table Settings
$scriptname = "team_members";
$datatitle = "Miembros(as) del Equipo";
$dataname = "Miembro(a)";
$tableid = "teamtable";
$tablecolumns = array(
	"ID",
	"Nombre",
	"Puesto",
	"Orden",
	"Nivel de Maquillaje",
	"Nivel de Manicura"
);
// Table layout
include "./views/tables/layout.php";
?>
</div>