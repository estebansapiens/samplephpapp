<?php
// Fetch the Sessions and their data
$adminlogsquery = "
	select id, user, message, time, user_ip
	from admin_logs logs
	order by id desc
";
$adminlogsdata = $GLOBALS['systemconfigs']->dbConnection->query($adminlogsquery);
// Output JSON for AJAX Requests
if (isset($_GET['postrequest'])) {
	$userdataresult = array();
	while ($userdata = $adminlogsdata->fetch_assoc()) {
		// Parse data in the result
		$newtime = date("H:i:s A",strtotime($userdata['time']));
		$userdatagroup = array(
			$userdata['id'],
			$userdata['user'],
			$userdata['message'],
			$newtime,
			$userdata['user_ip'],
		);
		$userdataresult[] = $userdatagroup;
	}
	$userdataresultclean = array(
		"status" => 1,
	    "message" => "success",
	    "data" => $userdataresult
	);
	$return = json_encode($userdataresultclean);
	header('Content-Type: application/json; charset=UTF-8');
	echo $return;
	exit;
}
?>
<table class="table table-striped table-bordered" id="adminlogstable" cellspacing="0" width="100%">
	<thead>
		<tr>
			<th>ID</th>
			<th>Username</th>
			<th>Message</th>
			<th>Time</th>
			<th>IP</th>
		</tr>
	</thead>
	<tbody>
		<?php
		while ($logsdata = $adminlogsdata->fetch_assoc()) {
			// Parse data in the result
			$newtime = date("H:i:s A",strtotime($logsdata['time']));
			?>
			<tr id="logsentry<?=$logsdata['id']?>">
				<td><?=$logsdata['id']?></td>
				<td><?=$logsdata['user']?></td>
				<td><?=$logsdata['message']?></td>
				<td><?=$newtime?></td>
				<td><?=$logsdata['user_ip']?></td>
			</tr>
			<?php
		}
		?>
	</tbody>
</table>