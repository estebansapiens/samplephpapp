<?php
// Fetch the Sessions and their data
$usersessionsquery = "
	select sesshandle.entry_id, users.username, users.nickname, sesshandle.latest_activity, sesshandle.access_type 
	from session_handle sesshandle 
	join users on sesshandle.user_id = users.userid 
	order by users.userid desc 
";
$usersessiondata = $GLOBALS['systemconfigs']->dbConnection->query($usersessionsquery);
// Output JSON for AJAX Requests
if (isset($_GET['postrequest'])) {
	$userdataresult = array();
	while ($userdata = $usersessiondata->fetch_assoc()) {
		// Parse data in the result
		$newtime = date("H:i:s A",strtotime($userdata['latest_activity']));
		$userdatagroup = array(
			$userdata['entry_id'],
			$userdata['username'],
			$userdata['nickname'],
			$newtime,
			$userdata['access_type'],
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
<table class="table table-striped table-bordered" id="activeuserstable" cellspacing="0" width="100%">
	<thead>
		<tr>
			<th>ID</th>
			<th>Username</th>
			<th>Nickname</th>
			<th>Latest Activity</th>
			<th>Access Type</th>
		</tr>
	</thead>
	<tbody>
		<?php
		while ($userdata = $usersessiondata->fetch_assoc()) {
			// Parse data in the result
			$newtime = date("H:i:s A",strtotime($userdata['latest_activity']));
			$accesstype = "";
			switch ($userdata['access_type']) {
				case '0':
					$accesstype = "Admin";
					break;
				case '1':
					$accesstype = "App";
					break;
				default:
					$accesstype = "Undefined";
					break;
			}
			?>
			<tr id="sessionentry<?=$userdata['entry_id']?>">
				<td><?=$userdata['entry_id']?></td>
				<td><?=$userdata['username']?></td>
				<td><?=$userdata['nickname']?></td>
				<td><?=$newtime?></td>
				<td><?=$accesstype?></td>
			</tr>
			<?php
		}
		?>
	</tbody>
</table>