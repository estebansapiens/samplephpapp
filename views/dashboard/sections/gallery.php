<?php

// Fetch the Gallery elements and their data
$databasequery = "
	select element_id,
	element_title,
	element_order,
	element_image,
	element_service
	from gallery 
	order by element_order asc 
";
$databasedata = $GLOBALS['systemconfigs']->dbConnection->query($databasequery);
// Output JSON for AJAX Requests
if (isset($_GET['postrequest'])) {
	$dbdataresult = array();
	while ($dbdata = $databasedata->fetch_assoc()) {
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
<table class="table table-striped table-bordered" id="gallerytable" cellspacing="0" width="100%">
	<thead>
		<tr>
			<th>ID</th>
			<th>Estado</th>
			<th>Orden</th>
			<th>Titulo</th>
			<th>Imagen</th>
		</tr>
	</thead>
	<tbody>
		<?php
		while ($dbdata = $databasedata->fetch_assoc()) {
			switch ($dbdata['element_service']) {
				case 0:
					$dbdata['element_service'] = "Inactivo";
					break;
				
				case 1:
					$dbdata['element_service'] = "Activo";
					break;
				
				default:
					$dbdata['element_service'] = "Sin definir.";
					break;
			}
			?>
			<tr id="galleryentry<?=$dbdata['testimonial_id']?>">
				<td><?=$dbdata['element_id']?></td>
				<td><?=$dbdata['element_service']?></td>
				<td><?=$dbdata['element_order']?></td>
				<td><?=$dbdata['element_title']?></td>
				<td><img height="100px" src="<?=$dbdata['element_image']?>"/></td>
			</tr>
			<?php
		}
		?>
	</tbody>
</table>