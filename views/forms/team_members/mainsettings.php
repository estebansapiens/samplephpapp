<?php
// Fetch the Team Main
$databasequery = "
	select section_header,
	section_content,
	section_background 
	from team_main 
	where setting_id = 1 
";
$databasedata = $GLOBALS['systemconfigs']->dbConnection->query($databasequery);
$maindata = array();
while ($dbdata = $databasedata->fetch_assoc()) {
	$maindata = $dbdata;
};
// Check form submission and trigger it
if (isset($_POST['secureInputField'])
&& $_POST['secureInputField'] == md5(session_id())) {
	$tablename = "team_main";
	$id_field = "setting_id";
	$tablecolumns = array(
		"section_header",
		"section_content",
		"section_background"
	);
	$errors = array();
	$query="update {$tablename} set ";
	foreach ($tablecolumns as $column) {
		$value = $_POST[$column];
		$query .= "{$column}='{$value}',";
	}
	$query = rtrim($query, ",");
	$query = $query.=" where {$id_field} = ".$_POST[$id_field];
	$databasequery = $GLOBALS['systemconfigs']->dbConnection->query($query);
	if (!$databasequery) {
		$errors[] = "Hubo un error procesando la solicitud: ".mysqli_error($GLOBALS['systemconfigs']->dbConnection);
	}
	if (count($errors)>0) {
		$result = array(
			"status"=>"error",
			"message"=>"Por favor corrija los siguientes errores:",
			"errors"=>$errors);
		$return = json_encode($result);
		header('Content-Type: application/json');
		echo $return;
		exit;
	} else {
		$result = array(
			"status"=>"success",
			"message"=>"Cambios guardados exitosamente!"
		);
		$return = json_encode($result);
		header('Content-Type: application/json');
		echo $return;
		exit;
	}
}
?>
<div class="panel panel-default col-md-5">
	<div class="panel-heading">Configuraciones Principales</div>
	<form id="team-main-configs" class="panel-body" role="form" action="//<?=$GLOBALS['maincontrol']->adminDirectory?>forms/team_members/mainsettings.php">
		<input type="hidden" value="<?=md5(session_id())?>" name="secureInputField" />
		<input type="hidden" value="1" name="setting_id" />
		<div class="form-group">
		    <label for="section_header">Titulo de la Sección:</label>
		    <input type="text" name="section_header" class="form-control" id="section_header" value="<?=$maindata['section_header']?>">
	    </div>
		<div class="form-group">
		    <label for="section_content">Contenido Principal de la Sección:</label>
		    <textarea name="section_content" class="form-control" id="section_content" rows="5"><?=$maindata['section_content']?></textarea>
	    </div>
		<div class="form-group">
		    <label for="section_background">Imagen de fondo de la Sección:</label>
		    <input type="text" name="section_background" class="form-control" id="section_background" value="<?=$maindata['section_background']?>">
	    </div>
	    <button type="submit" class="btn btn-default">Guardar Cambios</button>
	</form>
</div>
<script>
	PicMailMain.ajaxifyForm('team-main-configs');
</script>