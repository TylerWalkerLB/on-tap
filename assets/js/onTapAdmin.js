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
            Self.elementObjects.addNewForm.on('submit', function(e) {
                e.preventDefault();
                Self.addNewLocation();
            });
        }
    };

    Self.addNewLocation = function() {
        console.log('form submitted');
    };

})(jQuery, OnTap);

jQuery(document).ready(function() {
    OnTap.admin.init();
});
