<?php
/*
// Fetch the Hours of Service and their data
$databasequery = "
	select service_id,
	day_of_service,
	service_start_time,
	service_end_time
	from hours_of_service 
	order by day_of_service asc 
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
<table class="table table-striped table-bordered" id="hours-of-service-table" cellspacing="0" width="100%">
	<thead>
		<tr>
			<th>ID</th>
			<th>Dia</th>
			<th>Hora de Apertura</th>
			<th>Hora de Cierre</th>
		</tr>
	</thead>
	<tbody>
		<?php
		while ($dbdata = $databasedata->fetch_assoc()) {
			switch ($dbdata['day_of_service']) {
				case 1:
					$dbdata['day_of_service'] = "Lunes";
					break;
				
				case 2:
					$dbdata['day_of_service'] = "Martes";
					break;
				
				case 3:
					$dbdata['day_of_service'] = "Miercoles";
					break;
				
				case 4:
					$dbdata['day_of_service'] = "Jueves";
					break;
				
				case 5:
					$dbdata['day_of_service'] = "Viernes";
					break;
				
				case 6:
					$dbdata['day_of_service'] = "Sábado";
					break;
				
				case 7:
					$dbdata['day_of_service'] = "Domingo";
					break;
				
				default:
					$dbdata['day_of_service'] = "No Definido";
					break;
			}
			?>
			<tr id="promotionentry<?=$dbdata['promotion_id']?>">
				<td><?=$dbdata['service_id']?></td>
				<td><?=$dbdata['day_of_service']?></td>
				<td><?=$dbdata['service_start_time']?></td>
				<td><?=$dbdata['service_end_time']?></td>
			</tr>
			<?php
		}
		?>
	</tbody>
</table>
*/?>
<div class="panel panel-default">
<?php
// Table Settings
$scriptname = "hours_of_service";
$datatitle = "Horarios de Atención";
$dataname = "Horario";
$tableid = "hours_of_service_table";
$tablecolumns = array(
	"ID",
	"Dia",
	"Hora de Apertura",
	"Hora de Cierrre"
);
// Table layout
include "./views/tables/layout-no-add.php";
?>
</div>