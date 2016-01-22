$( document ).ready( function() {
   /**
    *
    * contact form
    * 
    */
    $( '#contact-form button[name=send]' ).click( function() {
        values = {
            'name' : '',
            'email' : '',
            'phone' : '',
            'subject' : '',
            'message' : ''
        };
        areErrors = false;
        $.each( values, function( key, value ) {
            currentElement = $( '*[name='+ key +']' );
            values[key] = currentElement.val();
            if( values[key] != false ) { currentElement.removeClass( 'error' ); }
            else {
                currentElement.addClass( 'error' );
                areErrors = true;
            }
        });
        if( areErrors == false ) {
            // your action here, for example sending an email...
            $.ajax({
                url: '/mail/submit.php',
                data: { 'submit': 'contact-form', 'data': values },
                type: 'post',
                success: function( output ) {
                    // animation after your action
                    $.contactFormAnimation();
                }
            });
        }
    });
    $.contactFormAnimation = function() {
        formHeight = $( '#contact-form-section-form' ).height();
        $( '#contact-form-section-form' ).css({ 'minHeight' : formHeight });
        $( '#contact-form-fields' ).fadeOut( 300 );
        setTimeout( function() {
            $( '.contact-form-thanks' ).fadeIn( 300 );
        }, 400 );
    }
   /**
    *
    * appointment form
    * 
    */
    $( '#appointment-popup' ).on( 'click', 'input.submit-appointment', function() {
        values = {
            'name' : '',
            'phone' : '',
            'email' : '',
            'appointment-date' : '',
            'approximate-time' : '',
            'additional-notes' : ''
        };
        areErrors = false;
        $.each( values, function( key, value ) {
            currentElement = $( '#appointment-form-in-popup form *[name='+ key +']' );
            values[key] = currentElement.val();
            if( values[key] != false ) { currentElement.removeClass( 'error' ); }
            else {
                currentElement.addClass( 'error' );
                areErrors = true;
            }
        });
        if( areErrors == false ) {
            // your action here, for example sending an email...
            $.ajax({
                url: '/mail/submit.php',
                data: { 'submit': 'appointment-form', 'data': values },
                type: 'post',
                success: function( output ) {
                    // animation after your action
                    $.appointmentFormAnimation();
                }
            });
        }
    });
    $.appointmentFormAnimation = function() {
        formHeight = $( '.appointment-popup-content' ).height();
        $( '.appointment-popup-content' ).css({ 'minHeight' : formHeight });
        $( '#appointment-form-in-popup form' ).fadeOut( 300 );
        setTimeout( function() {
            $( '#appointment-form-in-popup .thanks' ).fadeIn( 300 );
        }, 400 );
    }
   /**
    *
    * responsive menu
    * 
    */
    $( '.responsive-menu, .scrollable-menu-responsive' ).click( function() {
        $( '#responsive-menu-wrapper' ).css({ 'display' : 'block' });
        $( '#responsive-menu-window' ).fadeIn( 300 );
    });
    $( '.close-responsive-menu, .responsive-menu-list a' ).click( function() {
        $( '#responsive-menu-window' ).fadeOut( 300 );
    });
   /**
    *
    * go-top button
    * 
    */
    goTopVisible = false;
    $( window ).scroll( function() {
        scrollPos = $( this ).scrollTop();
        if( scrollPos > 250 ) {
            if( goTopVisible == false ) {
                $( '#go-top' ).fadeIn( 500 );
                goTopVisible = true;
            }
        }
        else {
            if( goTopVisible == true ) {
                $( '#go-top' ).fadeOut( 500 );
                goTopVisible = false;
            }
        }
    });
    $( '#go-top' ).click( function() { $( 'html, body' ).animate( { scrollTop : 0 }, 750 ); });
   /**
    *
    * go-top button remove to right
    * 
    */
    $.goTopRemove = function() {
        containerWidth = $( '#container' ).width();
        marginLeft = ( containerWidth / 2 );
        $( '#go-top' ).css({ 'marginLeft' : marginLeft });
    }
    $( window ).load( function() { $.goTopRemove(); });
    $( window ).resize( function() { $.goTopRemove(); });
   /**
    *
    * scrollable menu
    * 
    */
    responsiveMenuHashes = false;
    responsiveMenuVisible = false;
    $( window ).scroll( function() {
        scrollPos = $( this ).scrollTop();
        startShowing = $( '#main-content' ).offset().top;
        if( scrollPos > startShowing ) {
            if( responsiveMenuVisible == false ) {
                $( '#scrollable-menu-wrapper' ).fadeIn( 100 );
                responsiveMenuVisible = true;
            }
        }
        else {
            if( responsiveMenuVisible == true ) {
                $( '#scrollable-menu-wrapper' ).fadeOut( 100 );
                responsiveMenuVisible = false;
            }
        }
        if( responsiveMenuVisible == true ) {
            if( responsiveMenuHashes == false ) {
                responsiveMenuHashes = new Array();
                $( '.scrollable-menu-list li' ).each( function() {
                    element = $( this ).children( 'a' );
                    if( element[0].hash != '' && typeof element[0].hash != 'undefined' ) {
                        responsiveMenuHashes.push( element[0].hash.substr( 1 ) );
                    }
                });
            }
        }
    });
   /**
    *
    * cycle functions
    * 
    */
    $( window ).load( function() {
        $( '.make-slideshow' ).cycle({
            fx: 'fadeout',
            speed: 500,
            timeout: 0,
            slides: '> div',
            prev: '> .presentation-prev-button',
            next: '> .presentation-next-button',
            autoHeight: 'container'
        });
        $( '.team-box-profiles' ).cycle({
            fx: 'fadeout',
            speed: 500,
            timeout: 0,
            slides: '> div',
            prev: '.persons-switch .prev',
            next: '.persons-switch .next'
        });
        $( '#indice' ).cycle({
            fx: 'fade',
            speed: 500,
            timeout: 5000,
            slides: '> div'
        });
    });
   /**
    *
    * scroll animations
    * 
    */
    $( window ).load( function() {
        setTimeout( function() {
            $( '.waitForLoad' ).removeClass( 'waitForLoad' ).addClass( 'animated' );
        }, 200 );
    });
    $( window ).scroll( function() {
        scrollTop = $( this ).scrollTop();
        $( '.waitForScroll' ).each( function() {
            elementOffset = $( this ).offset();
            if( elementOffset.top - scrollTop < 750 ) {
                $( this ).removeClass( 'waitForScroll' ).addClass( 'animated' );
            }
        });
    });
   /**
    *
    * progress bar
    *
    */
    progressBarDone = new Array();
    $.progressBarStart = function( parent ) {
        if( progressBarDone[parent] == undefined ) {
            $( parent +' .progress-value' ).each( function() {
                element_width = $( this ).attr( 'data-value' ) + '%';
                $( this ).animate( { 'width' : element_width }, 900 );
            });
        }
        progressBarDone[parent] = 'done';
    }
    $( window ).scroll( function() {
        scrollTop = $( this ).scrollTop();
        elementOffset = $( '.single-profile[data-profile-id="1"]' ).offset();
        if( elementOffset.top - scrollTop < 500 ) {
            setTimeout( function() {
                $.progressBarStart( '.single-profile[data-profile-id="1"]' );
            }, 300 );
        }
    });
    $( '.team-box-profiles' ).on( 'cycle-after', function( event, optionHash, outgoingSlideEl, incomingSlideEl, forwardFlag ) {
        profileID = $( incomingSlideEl ).attr( 'data-profile-id' );
        $.progressBarStart( '.single-profile[data-profile-id="'+ profileID +'"]' );
    });
   /**
    *
    * show appointment timepicker
    * 
    */
    $( '.approximate-time' ).focus( function() {
        $( '.approximate-time-box' ).show();
        $( this ).addClass( 'approximate-time-box-active' );
    });
    $( '#appointment-popup' ).on( 'focus', '.approximate-time', function() {
        $( '#appointment-popup .approximate-time-box' ).show();
        $( this ).addClass( 'approximate-time-box-active' );
    });
    $( document ).click( function( e ) {
        if( $( e.target ).closest( '.approximate-time-input' ).length === 0 ) {
            $( '.approximate-time-box' ).hide();
            $( '.approximate-time' ).removeClass( 'approximate-time-box-active' );
        }
    });
    var timepickerType = '12h';
   /**
    *
    * functions for 12h timepicker
    * 
    */
    if( timepickerType == '12h' ) {
        $.hour_up = function( hour ) {
            hour = hour + 1;
            if( hour == 13 ) {
                hour = 1;
                result = String( '1' );
                $.changeTimeType( $( '.time-selector-type' ).attr( 'data-value' ) );
            }
            else {
                result = String( hour );
            }
            $( '.time-selector-hours' ).attr( 'data-value', hour ).html( result );
        }
        $.hour_down = function( hour ) {
            hour = hour - 1;
            if( hour == 0 ) {
                hour = 12;
                result = String( '12' );
                $.changeTimeType( $( '.time-selector-type' ).attr( 'data-value' ) );
            }
            else {
                result = String( hour );
            }
            $( '.time-selector-hours' ).attr( 'data-value', hour ).html( result );
        }
        $.mins_up = function( mins ) {
            mins = mins + 15;
            if( mins == 60 ) {
                $.hour_up( parseInt( $( '.time-selector-hours' ).attr( 'data-value' ) ) );
                mins = 0;
                result = String( '00' );
            }
            else {
                result = String( mins );
            }
            $( '.time-selector-mins' ).attr( 'data-value', mins ).html( result );
        }
        $.mins_down = function( mins ) {
            mins = mins - 15;
            if( mins == 0 ) {
                mins = 0;
                result = String( '00' );
            }
            else if( mins == -15 ) {
                $.hour_down( parseInt( $( '.time-selector-hours' ).attr( 'data-value' ) ) );
                mins = 45;
                result = String( '45' );
            }
            else {
                result = String( mins );
            }
            $( '.time-selector-mins' ).attr( 'data-value', mins ).html( result );
        }
        $.changeTimeType = function( type ) {
            if( type == 'am' ) new_type = 'pm';
            else new_type = 'am';
            $( '.time-selector-type' ).attr( 'data-value', new_type ).html( new_type );
        }
        $.getTimeValue = function() {
            hour = $( '.time-selector-hours' ).attr( 'data-value' );
            mins = $( '.time-selector-mins' ).attr( 'data-value' );
            type = $( '.time-selector-type' ).attr( 'data-value' );
            if( mins == '0' ) mins = '00';
            result = hour +':'+ mins +' '+ type;
            return( result );
        }
        $.manageApproximateTime = function( currentElement ) {
            if( currentElement.hasClass( 'hours' ) ) {
                value = parseInt( $( '.time-selector-hours' ).attr( 'data-value' ) );
                if( currentElement.hasClass( 'hours-up' ) ) { $.hour_up( value ); }
                else if( currentElement.hasClass( 'hours-down' ) ) { $.hour_down( value ); }
            }
            else if( currentElement.hasClass( 'mins' ) ) {
                value = parseInt( $( '.time-selector-mins' ).attr( 'data-value' ) );
                if( currentElement.hasClass( 'mins-up' ) ) { $.mins_up( value ); }
                else if( currentElement.hasClass( 'mins-down' ) ) { $.mins_down( value ); }
            }
            else if( currentElement.hasClass( 'time-type' ) ) {
                value = $( '.time-selector-type' ).attr( 'data-value' );
                $.changeTimeType( value );
            }
            $( '.approximate-time' ).val( $.getTimeValue() );
        }
    }
   /**
    *
    * functions for 12h timepicker
    * 
    */
    if( timepickerType == '24h' ) {
        $.hour_up = function( hour ) {
            hour = hour + 1;
            if( hour == 24 ) {
                hour = 0;
                result = String( '0' );
            }
            else {
                result = String( hour );
            }
            $( '.time-selector-hours' ).attr( 'data-value', hour ).html( result );
        }
        $.hour_down = function( hour ) {
            hour = hour - 1;
            if( hour == -1 ) {
                hour = 23;
                result = String( '23' );
            }
            else {
                result = String( hour );
            }
            $( '.time-selector-hours' ).attr( 'data-value', hour ).html( result );
        }
        $.mins_up = function( mins ) {
            mins = mins + 15;
            if( mins == 60 ) {
                $.hour_up( parseInt( $( '.time-selector-hours' ).attr( 'data-value' ) ) );
                mins = 0;
                result = String( '00' );
            }
            else {
                result = String( mins );
            }
            $( '.time-selector-mins' ).attr( 'data-value', mins ).html( result );
        }
        $.mins_down = function( mins ) {
            mins = mins - 15;
            if( mins == 0 ) {
                mins = 0;
                result = String( '00' );
            }
            else if( mins == -15 ) {
                $.hour_down( parseInt( $( '.time-selector-hours' ).attr( 'data-value' ) ) );
                mins = 45;
                result = String( '45' );
            }
            else {
                result = String( mins );
            }
            $( '.time-selector-mins' ).attr( 'data-value', mins ).html( result );
        }
        $.getTimeValue = function() {
            hour = $( '.time-selector-hours' ).attr( 'data-value' );
            mins = $( '.time-selector-mins' ).attr( 'data-value' );
            if( mins == '0' ) mins = '00';
            result = hour +':'+ mins;
            return( result );
        }
        $.manageApproximateTime = function( currentElement ) {
            if( currentElement.hasClass( 'hours' ) ) {
                value = parseInt( $( '.time-selector-hours' ).attr( 'data-value' ) );
                if( currentElement.hasClass( 'hours-up' ) ) { $.hour_up( value ); }
                else if( currentElement.hasClass( 'hours-down' ) ) { $.hour_down( value ); }
            }
            else if( currentElement.hasClass( 'mins' ) ) {
                value = parseInt( $( '.time-selector-mins' ).attr( 'data-value' ) );
                if( currentElement.hasClass( 'mins-up' ) ) { $.mins_up( value ); }
                else if( currentElement.hasClass( 'mins-down' ) ) { $.mins_down( value ); }
            }
            $( '.approximate-time' ).val( $.getTimeValue() );
        }
    }
   /**
    *
    * timepicker events
    *
    */
    $( '.time-change-action-event' ).click( function() { $.manageApproximateTime( $( this ) ); });
    $( '#appointment-popup' ).on( 'click', '.time-change-action-event', function() { $.manageApproximateTime( $( this ) ); });
   /**
    *
    * appointment date datepicker
    * 
    */
    $( '.appointment-datepicker' ).datepicker({
        dateFormat: "yy-mm-dd",
        minDate: new Date()
    });
    $( window ).resize( function() { $( '#ui-datepicker-div' ).hide(); });
   /**
    *
    * appointment popup functions
    * 
    */
    $.loadAppointmentForm = function( appointmentDate, approximateTime ) {
        $.ajax({
            url: 'appointment.html',
            success: function( output ) {
                $( '#appointment-popup' ).show();
                $( '#appointment-popup .appointment-popup-background' ).animate( { 'opacity' : 0.7 }, 400 );
                setTimeout( function() {
                    $( '#appointment-popup .appointment-popup-content' ).html( output );
                    $( '#appointment-popup .appointment-popup-content' ).addClass( 'animated bounceInDown' );
                    $( '.appointment-datepicker' ).datepicker({
                        dateFormat: "yy-mm-dd",
                        minDate: new Date(),
                        beforeShow: function( input, inst ) {
                            $( '#ui-datepicker-div' ).addClass( 'in-appointment-popup' ); 
                        }
                    });
                    $( '#appointment-popup input[name=appointment-date]' ).val( appointmentDate );
                    if( approximateTime != '' ) {
                        $( '#appointment-popup input[name=approximate-time]' ).val( approximateTime );
                        timeSplit = approximateTime.split( ' ' );
                        timeSplit[0] = timeSplit[0].split( ':' );
                        $( '.approximate-time-box .time-selector-hours' ).attr( 'data-value', timeSplit[0][0] ).html( timeSplit[0][0] );
                        $( '.approximate-time-box .time-selector-mins' ).attr( 'data-value', timeSplit[0][1] ).html( ( timeSplit[0][1] == 0 ? '00' : timeSplit[0][1] ) );
                        $( '.approximate-time-box .time-selector-type' ).attr( 'data-value', timeSplit[1] ).html( timeSplit[1] );
                    }
                    windowWidth = $( window ).width();
                    if( windowWidth <= 599 ) {
                        parentWidth = windowWidth - 80;
                        $( '#appointment-popup .appointment-popup-content .appointment-form input[type=text]' ).css({ 'width' : parentWidth - 61 +'px' });
                        $( '#appointment-popup .appointment-popup-content .appointment-form textarea' ).css({ 'width' : parentWidth - 26 +'px' });
                    }
                }, 200 ); 
            }
        });
    };
    $.closeAppointmentForm = function() {
        $( '#appointment-popup .appointment-popup-content' ).addClass( 'animated bounceOutUp' );
        setTimeout( function() {
            $( '#appointment-popup .appointment-popup-content' ).html( '' );
            $( '#appointment-popup .appointment-popup-content' ).removeClass( 'animated bounceOutUp' ).css({ 'minHeight' : '', 'height' : '' });
            $( '#appointment-popup .appointment-popup-background' ).animate( { 'opacity' : 0 }, 400 );
            setTimeout( function() {
                $( '#appointment-popup' ).hide();
            }, 300 );
        }, 600 );
    }
    $( '.open-appointment-box' ).click( function() { $.loadAppointmentForm( '', '' ); }); 
    $( '.open-appointment-box-with-data' ).click( function() {
        appointmentDate = $( '.appointment-datepicker' ).val();
        approximateTime = $( '.approximate-time' ).val();
        $.loadAppointmentForm( appointmentDate, approximateTime );
    });
    $( '#appointment-popup' ).on( 'click', '#close-popup', function() { $.closeAppointmentForm(); });
    if( $( window ).width() < 849 ) {
        $( '.open-appointment-box, .open-appointment-box-with-data' ).click( function() {
            $( 'html, body' ).animate( { scrollTop : 0 }, 500 );
        });
    }
   /**
    *
    * gallery images height same as width
    * 
    */
    $.setGalleryImageHeight = function( element ) {
        elementWidth = element.width();
        elementMargin = parseInt( element.css( 'marginLeft' ) ) * 2;
        element.css({ 'height' : elementWidth, 'marginBottom' : elementMargin });
    }
    $( window ).load( function() { $.setGalleryImageHeight( $( '.gallery-item' ) ); });
    $( window ).resize( function() { $.setGalleryImageHeight( $( '.gallery-item' ) ); });
   /**
    *
    * gallery item background animate
    * 
    */
    $( '.gallery-item' ).martanianGallery();
    $( '.item-background' ).hover( function() {
        $( this ).animate( { 'opacity' : 0.9 }, 300 );
    }, function() {
        $( this ).animate( { 'opacity' : 0 }, 300 );
    });
   /**
    *
    * isotope
    * 
    */
    $isotopeSelector = '*';
    $isotopeContainer = $( '.gallery-items' );
    $( window ).load( function() {
        $isotopeContainer.isotope({
            filter: $isotopeSelector,
            resizable: false
        });
        $( '.gallery-filters button' ).click( function() {
            if( $( this ).hasClass( 'button-brown' ) ) return false;
            $( '.gallery-filters .button-brown' ).removeClass( 'button-brown' ).addClass( 'button-gray' );
        		$( this ).removeClass( 'button-gray' ).addClass( 'button-brown' );
            $isotopeSelector = $( this ).attr( 'data-filter' );
            $isotopeContainer.isotope({ 
                filter: $isotopeSelector,
                resizable: false
            });
        });
    });
    $( window ).resize( function() {
        $isotopeContainer.isotope( 'destroy' );
        $isotopeContainer.isotope({ 
            filter: $isotopeSelector,
            resizable: false
        });
    });
   /**
    *
    * scrollable menu
    * 
    */
    $( window ).martanianScrollOnLoad();
   /**
    *
    * blog post images slider
    * 
    */
    $( window ).load( function() {
        $( '.blog-post-images' ).cycle({ 
            fx: 'fadeout',
            speed: 500,
            timeout: 0,
            prev: '> .image-change-right',
            next: '> .image-change-left',
            autoHeight: 'container'
        });
    });
   /**
    *
    * alert boxes
    * 
    */
    $( '.alert-box i' ).click( function() {
        element = $( this ).parent();
        element.animate( { 'opacity' : 0 }, 300 );
        setTimeout( function() {
            element.animate( { 'height' : 0, 'marginTop' : 0, 'padding' : 0 }, 300 );
        }, 300 );
    });
   /**
    *
    * width calc functions
    * 
    */
    $.calculateElementsWidth = function( windowWidth ) {
       /**
        *
        * #small-appointment .appointment-form .input input[type=text]
        * @width <= 599
        *
        */
        if( windowWidth <= 599 ) {
            parentWidth = $( '#small-appointment .appointment-form .input' ).width();
            $( '#small-appointment .appointment-form .input input[type=text]' ).css({ 'width' : parentWidth - 62 +'px' });
        }
        else $( '#small-appointment .appointment-form .input input[type=text]' ).css({ 'width' : '' });
       /**
        *
        * #responsive-menu-window ul
        * @width <= 849
        * 
        */
        if( windowWidth <= 849 ) {
            $( '#responsive-menu-window ul' ).css({ 'width' : windowWidth - 60 +'px' });
        }
        else $( '#responsive-menu-window ul' ).css({ 'width' : '' });
       /**
        *
        * #scrollable-menu-wrapper
        * @width <= 599
        * 
        */
        if( windowWidth <= 599 ) {
            $( '#scrollable-menu-wrapper' ).css({ 'width' : ( windowWidth * 0.9 ) - 2 +'px' });
        }
        else $( '#scrollable-menu-wrapper' ).css({ 'width' : '' });
       /**
        *
        * #slogan
        * @width <= 599
        *
        */
        if( windowWidth <= 599 ) {
            $( '#slogan' ).css({ 'width' : windowWidth - 80 +'px' });
        }
        else $( '#slogan' ).css({ 'width' : '' });
       /**
        *
        * #appointment-popup .appointment-popup-content .appointment-form input[type=text],
        * #appointment-popup .appointment-popup-content .appointment-form textarea
        * @width <= 599
        *
        */
        if( windowWidth <= 599 ) {
            parentWidth = windowWidth - 80;
            $( '#appointment-popup .appointment-popup-content .appointment-form input[type=text]' ).css({ 'width' : parentWidth - 61 +'px' });
            $( '#appointment-popup .appointment-popup-content .appointment-form textarea' ).css({ 'width' : parentWidth - 26 +'px' });
        }
        else {
            $( '#appointment-popup .appointment-popup-content .appointment-form input[type=text]' ).css({ 'width' : '' });
            $( '#appointment-popup .appointment-popup-content .appointment-form textarea' ).css({ 'width' : '' });
        }
       /**
        *
        * #blog #content article.blog-post .blog-post-comments-reply input[type=text],
        * #blog #content article.blog-post .blog-post-comments-reply textarea
        * @width all        
        *
        */
        commentFormWidth = $( '#blog #content article.blog-post .blog-post-comments-reply' ).width();
        $( '#blog #content article.blog-post .blog-post-comments-reply input[type=text]' ).css({ 'width' : commentFormWidth - 62 +'px' });
        $( '#blog #content article.blog-post .blog-post-comments-reply textarea' ).css({ 'width' : commentFormWidth - 26 +'px' }); 
       /**
        *
        * #contact-form #contact-form-section-form
        * @width <= 599        
        *
        */
        if( windowWidth <= 599 ) {
            parentWidth = $( '#contact-form' ).width();
            $( '#contact-form #contact-form-section-form' ).css({ 'width' : parentWidth - 100 +'px' });
        }
        else {
            $( '#contact-form #contact-form-section-form' ).css({ 'width' : '' });
            if( windowWidth <= 849 ) {
                parentWidth = $( '#contact-form' ).width();
                $( '#contact-form #contact-form-section-form' ).css({ 'right' : parentWidth * 0.15 - 40 +'px' });
            }
            else $( '#contact-form #contact-form-section-form' ).css({ 'right' : '' });
        }
       /**
        *
        * #contact-form input[type=text]
        * #contact-form textarea
        * @width all
        *
        */
        contactFormWidth = $( '#contact-form-fields' ).width();
        $( '#contact-form input[type=text]' ).css({ 'width' : contactFormWidth - 62 +'px' });
        $( '#contact-form textarea' ).css({ 'width' : contactFormWidth - 26 +'px' }); 
       /**
        *
        * end
        * 
        */
    }
    $( window ).load( function() { $.calculateElementsWidth( $( window ).width() ); });
    $( window ).resize( function() { $.calculateElementsWidth( $( window ).width() ); });
   /**
    *
    * end
    * 
    */
});