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

        console.log('init started');
        Self.elementObjects.mapContainer = document.getElementById('ot-map');
        Self.elementObjects.$mapExists = $('#ot-map');

        if (Self.elementObjects.$mapExists.length) {
            console.log('element exists');
            Self.elementObjects.map = new google.maps.Map(Self.elementObjects.mapContainer, {
                center: {lat: -34.397, lng: 150.644},
                zoom: 8
            });

        }
    }

})(jQuery, OnTap);

jQuery(document).ready(function() {
    OnTap.onTapMap.init();
});
