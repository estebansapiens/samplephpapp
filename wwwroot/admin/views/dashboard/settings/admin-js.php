<?php

// Fetch the Promotnions and their data
$databasequery = "
	select js_id,
	js_content,
	js_filename,
	js_service 
	from admin_js 
	order by js_id desc 
";
$databasedata = $GLOBALS['systemconfigs']->dbConnection->query($databasequery);
// Output JSON for AJAX Requests
if (isset($_GET['postrequest'])) {
	$dbdataresult = array();
	while ($dbdata = $databasedata->fetch_assoc()) {
		// Parse data in the result
		$dbdataresult[] = $dbdata;
	}
	$dbdataresultclean = array(
		"status" => 1,
	    "message" => "success",
	    "data" => $dbdataresult
	);
	$return = json_encode($dbdataresultclean);
	header('Content-Type: application/json; charset=UTF-8');
	echo $return;
	exit;
}
?>
<table class="table table-striped table-bordered" id="adminjstable" cellspacing="0" width="100%">
	<thead>
		<tr>
			<th>ID</th>
			<th>Nombre de Script</th>
			<th>Estado</th>
		</tr>
	</thead>
	<tbody>
		<?php
		while ($dbdata = $databasedata->fetch_assoc()) {
			// Parse data in the result
			switch ($dbdata['js_service']) {
				case 0:
					$dbdata['js_service'] = "Inactivo";
					break;
				
				case 1:
					$dbdata['js_service'] = "Activo";
					break;
				
				default:
					$dbdata['js_service'] = "Sin definir.";
					break;
			}
			?>
			<tr id="scriptentry<?=$dbdata['js_id']?>">
				<td><?=$dbdata['js_id']?></td>
				<td><?=$dbdata['js_filename']?></td>
				<td><?=$dbdata['js_service']?></td>
			</tr>
			<?php
		}
		?>
	</tbody>
</table>