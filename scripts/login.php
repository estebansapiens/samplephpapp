<?php

header("Content-Type: application/javascript");

// Configuration data
include_once "../classes/config.php";

// Main class
include_once "../classes/main.php";

?>

var AppLogin = {
	'processResponse': // Response Processor from Login attempt
	function(returnedData){
	  switch (returnedData.status) {
	  	case "success":
	  		// Successful Login
	  		$.ajax({ url: '//<?=$GLOBALS['maincontrol']->adminDirectory?>dashboard', dataType: 'text', type: 'POST', success: function(data) {
					$("#loading").show().removeClass("rollIn").addClass("bounceOutDown");
		  			$("#pageContent").html(data);
		  			AppMain.processSuccess(returnedData.message);
	  			}
	  		});
	  		break;
	  	case "authentication-error":
	  		// Wrong Username or Password
	  		$("#login-form-container").removeClass("flipOutY").addClass("zoomInLeft");
	  		AppMain.processError(returnedData.message);
			$("#loading").show().removeClass("rollIn").addClass("bounceOutDown");
	  		break;
	  	case "validation-error":
	  		// Problem validating the fields submitted
	  		$("#login-form-container").removeClass("flipOutY").addClass("zoomInLeft");
	  		AppMain.processErrors(returnedData.errors);
			$("#loading").show().removeClass("rollIn").addClass("bounceOutDown");
	  		break;
	  	case "error":
	  		// General error
	  		$("#login-form-container").removeClass("flipOutY").addClass("zoomInLeft");
	  		AppMain.processError(returnedData.message);
			$("#loading").show().removeClass("rollIn").addClass("bounceOutDown");
	  		break;
	  }
	},
	'init': // Class Initializer
	function(){
		// Login Form Submission
		$("#login-form").submit(function(event){
			event.preventDefault();
			$("#login-form-container").removeClass("zoomInLeft").addClass("flipOutY");
			$("#loading").show().removeClass("bounceOutDown").addClass("rollIn");
			// Set a delay for the transitions to have a time to shine
			setTimeout(function(){
				// Send the AJAX Request for validating the user
				$.ajax({
				   url: '//<?=$GLOBALS['maincontrol']->adminDirectory?>index.php',
				   data: $("#login-form").serialize(),
				   error: function() {
				   	AppMain.processError(AppMain.opt.ajaxProcessingErrorMessage);
				   },
				   cache: false,
				   processData: false,
				   dataType: 'json',
				   success: function(data) {
				   	  AppLogin.processResponse(data);
				   },
				   type: 'POST'
				});
			}, AppMain.opt.loadingDelay);
			
		});
		
		// Admin login button action
		$("#appAdmin").click(function(){
			$("#logintype").val("admin");
			$(".page-header > h1 > small").html("Administrative Login");
			$(".email-provider").hide(500);
			if ($("#inputEmail").val()!="" && $("#inputPassword").val()!="")
				$("#login-form").submit();
		});
	}

};

AppLogin.init();
