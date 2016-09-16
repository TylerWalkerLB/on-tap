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

        if (Self.elementObjects.mapContainer.length) {
            console.log(Self.elementObjects.mapContainer);
        }
    }

})(jQuery, OnTap);

jQuery(document).ready(function() {
    OnTap.onTapMap.init();
});
