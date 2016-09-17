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
            console.log(Self.Vars.locations);

            Self.elementObjects.map = new google.maps.Map(Self.elementObjects.mapContainer, {
                center: {lat: -34.397, lng: 150.644},
                zoom: 8
            });

            for (var i=0; i < Self.Vars.locations.length; i++) {

            }

        }
    }

})(jQuery, OnTap);

jQuery(document).ready(function() {
    OnTap.onTapMap.init();
});
