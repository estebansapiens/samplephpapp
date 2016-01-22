<?php
// Configuration data
include_once "./classes/config.php";
// Main class
include_once "./classes/main.php";
// Session class
include_once "./classes/session.php";

$orderoptions = array();
if (isset($_POST['secureInputField'])
&& $_POST['secureInputField'] == md5(session_id())) {
	$entityid = $GLOBALS['systemconfigs']->dbConnection->real_escape_string($_POST[$id_field]);
	$errors = array();
	$query="update {$tablename} set ";
	$querycolumnsarr = array();
	$querycolumnstypes = array();
	foreach ($tablecolumns as $column => $columndata) {
		$value = $_POST[$column];
		$query.=" {$column} = ?,";
		$querycolumnsarr[] = $value;
		$querycolumnstypes[] = $columndata['data-type'];
	}
	$query = rtrim($query, ",")." where {$id_field} = {$entityid}";
	$databasequery = $GLOBALS['systemconfigs']->dbConnection->prepare($query);
	// Format and pass the Params to the query
	$a_params = array();
	$param_type = '';
	$n = count($querycolumnstypes);
	for($i = 0; $i < $n; $i++) {
	  $param_type .= $querycolumnstypes[$i];
	}
	$a_params[] = & $param_type;
	for($i = 0; $i < $n; $i++) {
	  $a_params[] = & $querycolumnsarr[$i];
	}
	call_user_func_array(array($databasequery, 'bind_param'), $a_params);
	$databasequery->execute();
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
			"message"=>"{$nodename} actualizada exitosamente!"
		);
		$return = json_encode($result);
		header('Content-Type: application/json');
		echo $return;
		exit;
	}
}
if (isset($_GET['entity_id'])) {
	// Fetch the Promotions and their data
	$entityid = $GLOBALS['systemconfigs']->dbConnection->real_escape_string($_GET['entity_id']);
	$databasequery = "select ";
	foreach ($tablecolumns as $column => $columndata) {
		$databasequery.="{$column},";
	}
	$databasequery = rtrim($databasequery,",");
	$databasequery.=" from {$tablename} where {$id_field} = {$entityid}";
	$databasedata = $GLOBALS['systemconfigs']->dbConnection->query($databasequery);
	$dbdataresult = array();
	while ($dbdata = $databasedata->fetch_assoc()) {
		// Parse data in the result
		$dbdataresult[] = $dbdata;
	}
	/* Extra Select arrays processing */
	if (count($selectgroups) > 0) {
		foreach ($selectgroups as $selectcolumn => $selectcolumndata) {
			$maxlevel = $selectcolumndata['maxvalue'];
			$optionsgroup = array();
			$currentprocessingnumber = 1;
			while ($currentprocessingnumber <= $maxlevel) {
				$optionsgroup[$currentprocessingnumber] = ($currentprocessingnumber == $dbdataresult[0][$selectcolumn])?"selected":"";
				$currentprocessingnumber++;
			}
			$tablecolumns[$selectcolumn]['input-options'] = $optionsgroup;
		}
	}
	/* Order stuff */
	if ($orderenabled and !isset($_POST['secureInputField'])) {
		$entityid = $GLOBALS['systemconfigs']->dbConnection->real_escape_string($_GET['entity_id']);
		$databaseorderquery = "select {$ordercolumn} from {$tablename} where {$id_field} != {$entityid}";
		$databaseorderdata = $GLOBALS['systemconfigs']->dbConnection->query($databaseorderquery);
		$dborderdataresult = array();
		while ($dborderdata = $databaseorderdata->fetch_assoc()) {
			// Parse data in the result
			if (!in_array($dborderdata[$ordercolumn], $dborderdataresult)) {
				$dborderdataresult[] = $dborderdata[$ordercolumn];
			}
		}
		$currentorder = 1;
		while ($currentorder <= $ordermax) {
			if ($currentorder == $dbdataresult[0][$ordercolumn]) {
				$orderoptions[$currentorder] = "selected";
			} else if (in_array($currentorder, $dborderdataresult)) {
				$orderoptions[$currentorder] = "used";
			} else {
				$orderoptions[$currentorder] = "free";
			}
			$currentorder++;
		}
		$tablecolumns[$ordercolumn]['input-options'] = $orderoptions;
	}
} else {
	$result = array(
		"status"=>"error",
		"message"=>"Por favor ingrese el numero de {$nodename}.");
	$return = json_encode($result);
	header('Content-Type: application/json');
	echo $return;
	exit;
}
?>
<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal">&times;</button>
	<h4 class="modal-title">Actualizar <?=$nodename?></h4>
</div>
<div class="modal-body">
	<form id="<?=$formid?>" class="panel-body" role="form" action="<?=$formupdateaction?>">
		<input type="hidden" value="<?=md5(session_id())?>" name="secureInputField" />
		<input type="hidden" value="<?=$_GET['entity_id']?>" name="<?=$id_field?>" />
		<?php
		foreach ($tablecolumns as $columnname => $columndata) { ?>
			<div class="form-group">
				<?php
			    switch ($columndata['input-type']) {
					case 'text': ?>
						<label for="<?=$columnname?>"><?=$columndata['label']?>:</label>
						<input type="text" name="<?=$columnname?>" class="<?=$columndata['input-class']?>" id="<?=$columnname?>" placeholder="<?=$columndata['placeholder']?>" value="<?=$dbdataresult[0][$columnname]?>">
				<?php	break;
					case 'radio': ?>
						<label><?=$columndata['label']?>:</label>
						<?php
							foreach ($columndata['input-options'] as $inputvalue => $inputlabel) { 
						?>
								<label class="<?=$columndata['input-class']?>"><input type="radio" <?=($inputvalue==$dbdataresult[0][$columnname])?"checked":""?> value="<?=$inputvalue?>" name="<?=$columnname?>"><?=$inputlabel?></label>
						<?php	
							}
						?>
				<?php	break;
					case 'select': ?>
						<label for="<?=$columnname?>"><?=$columndata['label']?>:</label>
						<select name="<?=$columnname?>" class="<?=$columndata['input-class']?>" id="<?=$columnname?>">
							<?php
								foreach ($columndata['input-options'] as $inputvalue => $inputlabel) { 
									if (in_array($inputlabel, array("free","used"))) { ?>
										<option <?=($inputlabel=="selected")?"selected":""?> <?=($inputlabel=="used")?"disabled":""?> value="<?=$inputvalue?>"><?=$inputvalue?><?=($inputlabel=="selected")?" (actual)":(($inputlabel=="used")?" (usado)":"")?></option>
							<?php	} else { ?>
										<option <?=($inputlabel=="selected")?"selected":""?> value="<?=$inputvalue?>"><?=$inputvalue?><?=($inputlabel=="selected")?" (actual)":""?></option>
							<?php	}
								}
							?>
						</select>
				<?php	break;
					case 'textarea': ?>
						<label for="<?=$columnname?>"><?=$columndata['label']?>:</label>
						<textarea name="<?=$columnname?>" class="<?=$columndata['input-class']?>" id="<?=$columnname?>" placeholder="<?=$columndata['placeholder']?>" rows="5"><?=$dbdataresult[0][$columnname]?></textarea>
				<?php	break;
					default: ?>
					
				<?php	break; 
				}
				?>
			</div>
		<?php } ?>
	    <button type="submit" class="btn btn-default">Actualizar <?=$nodename?></button>
	</form>
</div>
<div class="modal-footer">
	<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
</div>
<script>
	PicMailMain.ajaxifyForm('<?=$formid?>');
</script>