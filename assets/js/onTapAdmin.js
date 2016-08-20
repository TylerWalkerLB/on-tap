/*
*
* Scripts to handle admin
*
 */

var OnTap = OnTap || {};

(function($, OnTap){
    var Self = OnTap.admin = {};

    Self.elementObjects = {};
    Self.Vars = {};

    Self.Vars.ajaxUrl = ot_ajax.ajaxUrl;
    Self.Vars.adminUrl = ot_ajax.admin_url;

    Self.init = function() {
        Self.elementObjects.addNewForm = $('#on-tap-add-new');

        if (Self.elementObjects.addNewForm.length) {
            Self.elementObjects.newTitle = Self.elementObjects.addNewForm.find('.loc-title');
            Self.elementObjects.newAdd1 = Self.elementObjects.addNewForm.find('.loc-address1');
            Self.elementObjects.newAdd2 = Self.elementObjects.addNewForm.find('.loc-address2');
            Self.elementObjects.newCity = Self.elementObjects.addNewForm.find('.loc-city');
            Self.elementObjects.newState = Self.elementObjects.addNewForm.find('.loc-state');
            Self.elementObjects.newZip = Self.elementObjects.addNewForm.find('.loc-zip');

            Self.elementObjects.addNewForm.on('submit', function(e) {
                e.preventDefault();
                Self.addNewLocation();
            });
        }
    };

    Self.addNewLocation = function() {
        console.log(Self.elementObjects.newTitle.value);
    };

})(jQuery, OnTap);

jQuery(document).ready(function() {
    OnTap.admin.init();
});