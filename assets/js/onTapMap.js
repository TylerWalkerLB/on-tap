/*
*
* onTapMap.js
*
* Description: This script builds out and handles the map displayed for the user on the presentation layer
*
 */

var OnTap = OnTap || {};

(function($, OnTap) {
    var Self = OnTap.onTapMap = {};

    Self.elementObjects = {};
    Self.Vars = {};

    Self.init = function() {
        Self.elementObjects.mapContainer = document.getElementById('ot-map');
        Self.elementObjects.$mapExists = $('#ot-map');

        if (Self.elementObjects.$mapExists.length) {
            Self.Vars.ajaxUrl = ot_ajax.ajaxUrl;
            Self.Vars.adminUrl = ot_ajax.admin_url;
            Self.Vars.locations = ot_ajax.locations;
            Self.Vars.markers = [];

            Self.Vars.infowindow = new google.maps.InfoWindow();

            Self.elementObjects.map = new google.maps.Map(Self.elementObjects.mapContainer, {
                center: {lat: 32.954709, lng: -96.847184},
                zoom: 8
            });

            Self.Vars.locations.forEach( function(loc, index) {
                var marker = new google.maps.Marker({
                    map: Self.elementObjects.map,
                    position: new google.maps.LatLng(loc['location_lat'], loc['location_lng']),
                    label: String(index)
                });
                Self.Vars.markers.push(marker);

                google.maps.event.addListener(marker, 'click', (function(marker, i) {
                    return function() {
                        var infoContent = '<h6>'+ loc.location_name +'</h6>';
                        Self.Vars.infowindow.setContent(infoContent);
                        Self.Vars.infowindow.open(Self.elementObjects.map, marker);
                    }
                })(marker, i));
            });



        }
    }

})(jQuery, OnTap);

jQuery(document).ready(function() {
    OnTap.onTapMap.init();
});
