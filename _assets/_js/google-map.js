$( document ).ready( function() {

    $.getWidthClass = function( width ) {
        
        width = width + 17;
        
        if( width >= 1150 ) return( 1 );
        else if( width >= 850 && width < 1150 ) return( 2 );
        else if( width >= 600 && width < 850 ) return( 3 );
        else return( 4 );
    }

    var pos_a1 = 9.900430; 
    var pos_b1 = -84.133552;

    var map = '';
    var map_pos = '';
    var currentWidth = 0;
    var currentWidthClass = 1;

    google.maps.event.addDomListener( window, 'load', function() {

        websiteWidth = $( window ).width();
        centerPos = '';
        
        if( websiteWidth >= 1150 ) {
        
            map_center = new google.maps.LatLng(
                pos_a1,
                pos_b1 + 0.006
            );
        }
        
        else if( websiteWidth >= 850 ) {
            
            map_center = new google.maps.LatLng(
                pos_a1,
                pos_b1 + 0.005
            );
        }
        
        else if( websiteWidth >= 600 ) {
            
            map_center = new google.maps.LatLng(
                pos_a1 - 0.003,
                pos_b1
            );
        }
        
        else {
        
            map_center = new google.maps.LatLng(
                pos_a1 - 0.003,
                pos_b1
            );
        }

        currentWidth = $( window ).width();
        currentWidthClass = $.getWidthClass( currentWidth );
        
        var mapOptions = {
            zoom: 16,
            center: map_center,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            scrollwheel: false
        }
      
        map = new google.maps.Map( document.getElementById( 'map-canvas' ), mapOptions );

        var beachMarker = new google.maps.Marker({
            position: new google.maps.LatLng(pos_a1, pos_b1),
            map: map,
        });
        
    });

    google.maps.event.addDomListener( window, 'resize', function() {

        newWidthClass = $.getWidthClass( $( window ).width() );

        if( currentWidthClass == 1 ) {
        
            if( newWidthClass == 2 ) {
        
                map.setCenter(
                    new google.maps.LatLng(
                        pos_a1,
                        pos_b1 + 0.0082
                    )
                );
            }
        }

        else if( currentWidthClass == 2 ) {
        
            if( newWidthClass == 1 ) {
        
                map.setCenter(
                    new google.maps.LatLng(
                        pos_a1,
                        pos_b1 + 0.0028
                    )
                );
            }
            
            else if( newWidthClass == 3 ) {
            
                map.setCenter(
                    new google.maps.LatLng(
                        pos_a1 - 0.000232,
                        pos_b1 + 0.0026
                    )
                );
            }
        }
        
        else if( currentWidthClass == 3 ) {
        
            if( newWidthClass == 2 ) {
        
                map.setCenter(
                    new google.maps.LatLng(
                        pos_a1 - 0.00268,
                        pos_b1 + 0.0023
                    )
                );
            }
        }
        
        else if( currentWidthClass == 4 && newWidthClass == 4 ) {

            map.setCenter(
                new google.maps.LatLng(
                    pos_a1 - 0.00268,
                    pos_b1
                )
            );
        }

        currentWidthClass = newWidthClass;
    
    });
 
});