<?php

header("Content-Type: application/javascript");

// Configuration data
include_once "../classes/config.php";

// Main class
include_once "../classes/main.php";

/* @Creation Date: 10/11/2015
 * @Modification Date: 10/11/2015
 * 
 * App Main class holds the global interactivity
 * of the Javascript subclasses.
 */
?>

var AppMain = {
        'currentpage':'',
        'errorNotificationCount': 0,
        'successNotificationCount': 0,
        'opt':{
            'loadingDelay':2500,
            'errorNotificationHideDelay':5000,
            'successNotificationHideDelay':5000,
            'ajaxProcessingErrorMessage': 'There was an error processing the request, please try again.',
            'popupModal': '#popupModal'
        },
        'hideNotification': // Hide Notification element
		function (element) {
			$(element).removeClass("flipInX").addClass("flipOutX");
			setTimeout(function(){
				$(element).hide(300);
			}, 500);
		},
		'processErrors': // Multiple Error processing
		function (errorData) {
			$.each(errorData, function(index) {
				var errorBody = '<div onclick="AppMain.hideNotification(this)" class="alert alert-danger animated flipInX" role="alert" id="errorNotification'+AppMain.errorNotificationCount+'">' +
					  '<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>' +
					  '<span class="sr-only">Error:</span> ';
		        var errorMessage = errorBody + errorData[index].message + '</div>';
		        var errorMessageID = "errorNotification"+AppMain.errorNotificationCount;
		    	// Insert and apply a hide timeout to the inserted element
		        $("#errorcontainer").append(errorMessage);
		        // Hide it over time
		        AppMain.autoHideElement(AppMain.opt.errorNotificationHideDelay,errorMessageID);
				AppMain.errorNotificationCount++;
		    });
		},
		'processError': // Single Error processing
		function (errorData) {
			var errorBody = '<div style="display:none;" onclick="AppMain.hideNotification(this)" class="alert alert-danger animated flipInX" role="alert" id="errorNotification'+AppMain.errorNotificationCount+'">' +
				  '<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>' +
				  '<span class="sr-only">Error:</span> '+errorData+'</div>';
	        var errorMessageID = "errorNotification"+AppMain.errorNotificationCount;
		    // Insert element
		    $("#errorcontainer").append(errorBody);
		    // Show element
		    $("#"+errorMessageID).show(300);
    	 	// Hide it over time
	        AppMain.autoHideElement(AppMain.opt.errorNotificationHideDelay,errorMessageID);
			AppMain.errorNotificationCount++;
		},
		'processSuccess': // Single Error processing
		function (successData) {
			var successBody = '<div style="display:none;" onclick="AppMain.hideNotification(this)" class="alert alert-success animated flipInX" role="alert" id="successNotification'+AppMain.successNotificationCount+'">' +
				  '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>' +
				  '<span class="sr-only">Mensaje:</span> '+successData+'</div>';
	        var successMessageID = "successNotification"+AppMain.successNotificationCount;
		    // Insert element
		    $("#errorcontainer").append(successBody);
		    // Show element
		    $("#"+successMessageID).show(300);
    	 	// Hide it over time
	        AppMain.autoHideElement(AppMain.opt.successNotificationHideDelay,successMessageID);
			AppMain.successNotificationCount++;
		},
		'autoHideElement': // Hide Element over time
		function(elementHideTime, elementID) {
			setTimeout(function(){
	    	 	$("#"+elementID).removeClass("flipInX").addClass("flipOutX");
				setTimeout(function(){
					$("#"+elementID).hide(300);
				}, 500);
			}, elementHideTime);
		},
		'ajaxifyElements': // Ajaxify Site links
		function(){
			$("a:not([target=\'_blank\']):not([target=\'_BLANK\']):not([href^=#]):not(.no-link):not([data-toggle=\'dropdown\'])").click(function(event) {
				/*if ($(this).attr("ajax-active")=="ajax-it") {*/
	            	event.preventDefault();
	            	var elementURL = $(this).attr("href");
					$("#pageContent").removeClass("fadeInDown").addClass("fadeOutUp");
					$("footer").removeClass("fadeInDown").addClass("fadeOutUp");
					$("#loading").show().removeClass("bounceOutDown").addClass("rollIn");
					// Set a delay for the transitions to have a time to shine
					setTimeout(function(){
		            	$.ajax({ url: elementURL, dataType: 'text', type: 'POST', success: function(data) {
								$("#loading").show().removeClass("rollIn").addClass("bounceOutDown");
					  			$("#pageContent").html(data);
								$("#pageContent").removeClass("fadeOutUp").addClass("fadeInDown");
								$("footer").removeClass("fadeOutUp").addClass("fadeInDown");
				  			}
				  		});
					}, AppMain.opt.loadingDelay);
	           /* }*/
			});
		},
		'bindButtonActions': // Ajaxify the forms to control the element administration
		function(){
			$(document).on("click", "button[special-action]",function(){
				modalURL = $(this).attr("special-action");
	  			$(AppMain.opt.popupModal+" .modal-content").html(' ');
				$("#loading").show().addClass("rollIn").removeClass("bounceOutDown");
				$.ajax({ url: modalURL, dataType: 'text', type: 'POST', success: function(data) {
						$("#loading").show().removeClass("rollIn").addClass("bounceOutDown");
			  			$(AppMain.opt.popupModal+" .modal-content").html(data);
			  			$(AppMain.opt.popupModal).modal('show');
		  			}
		  		});
			});
		},
		'bindDeleteConfirmationPopups': // Bind the confirmation popups on the delete buttons
		function(){
			
		},
		'ajaxifyForm': // Ajaxify the forms to control the element administration
		function(formID){
			$("form#"+formID).submit(function(event){
				event.preventDefault();
				var form = $(this);
				$.ajax({
			      type: "POST",
			      url: form.attr('action'),
			      data: form.serialize()
			    }).done(function(data) {
			    	if (data.status=="success") {
			    		$.fn.dataTable
					    .tables( { visible: true, api: true } )
					    .ajax.reload(function(){
					    	console.log("reloaded table"+$(this).id());
					    });
			    		AppMain.processSuccess(data.message);
			    	} else if (data.status=="error") {
			    		AppMain.processError(data.message);
			    	}
			    	$(AppMain.opt.popupModal).modal('hide');
			    }).fail(function(data) {
			      	AppMain.processError(data);
			    });
			});
		}
};

