<?php

header("Content-Type: application/javascript");

// Configuration data
include_once "../classes/config.php";

// Main class
include_once "../classes/main.php";

/* @Creation Date: 10/8/2015
 * @Modification Date: 10/9/2015
 * 
 * AppDashboard holds the interactivity of the Administrative
 * Dashboard.
 */
?>

var AppDashboard = {
	'opt': {
		'activeUsersRefreshDelay': 3500,
		'adminLogsRefreshDelay': 3500,
		'activeUsersDatatable' : '',
		'activeUsersDatatableSelector' : '#activeuserstable',
		'adminLogsDatatable' : '',
		'adminLogsDatatableSelector' : '#adminlogstable',
		'activeUsersRefreshInterval' : '',
		'adminLogsRefreshInterval' : '',
		
	},
	'init': // Initializer function
	function() {
		// Set DataTable errors to "throw" instead of "alert"
		$.fn.dataTableExt.sErrMode = 'throw';
		// Refresh Active Users via Interval
		AppDashboard.activeUsersRefreshInterval();
		// Refresh Admin Logs via Interval
		AppDashboard.adminLogsRefreshInterval();
		// Initialize Active Users Datatable
		AppDashboard.initActiveUsers();
		// Initialize Admin Logs Datatable
		AppDashboard.initAdminLogs();
		// Ajaxify new elements
		AppMain.ajaxifyElements();
	},
	'activeUsersRefreshInterval': // Refresh the users DataTable via AJAX by Interval
	function() {
		AppDashboard.opt.activeUsersRefreshInterval = setInterval(function(){
			// Check if the DataTable is still present
			if ( $(AppDashboard.opt.activeUsersDatatableSelector).length ) {
				AppDashboard.opt.activeUsersDatatable.ajax.reload(null, false);
			} else {
				clearInterval(AppDashboard.opt.activeUsersRefreshInterval);
			}
		}, AppDashboard.opt.activeUsersRefreshDelay);
	},
	'adminLogsRefreshInterval': // Refresh the users DataTable via AJAX by Interval
	function() {
		AppDashboard.opt.adminLogsRefreshInterval = setInterval(function(){
			// Check if the DataTable is still present
			if ( $(AppDashboard.opt.adminLogsDatatableSelector).length ) {
				AppDashboard.opt.adminLogsDatatable.ajax.reload(null, false);
			} else {
				clearInterval(AppDashboard.opt.adminLogsRefreshInterval);
			}
		}, AppDashboard.opt.adminLogsRefreshDelay);
	},
	'initActiveUsers': // Initialize the DataTable for Active Users
	function() {
		// DataTable Functionality
		AppDashboard.opt.activeUsersDatatable = $(AppDashboard.opt.activeUsersDatatableSelector).DataTable({
			"ajax": {
			  "url": "/dashboard/activeusers.php?postrequest=1"
			},
		    "order": [[ 0, "desc" ]],
	        "columnDefs": [
	            {
	                "targets": [ 0 ],
	                "visible": false,
	                "searchable": false
	            }
	        ],
            "pagingType": "simple"
		});
	},
	'initAdminLogs': // Initialize the DataTable for Active Users
	function() {
		// DataTable Functionality
		AppDashboard.opt.adminLogsDatatable = $(AppDashboard.opt.adminLogsDatatableSelector).DataTable({
			"ajax": {
			  "url": "/dashboard/adminlogs.php?postrequest=1"
			},
			"order": [[ 0, "desc" ]],
	        "columnDefs": [
	            {
	                "targets": [ 0 ],
	                "visible": false,
	                "searchable": false
	            }
	        ],
            "pagingType": "simple"
		});
	}
}

// Initialize the Dashboard
AppDashboard.init();
AppMain.bindButtonActions();