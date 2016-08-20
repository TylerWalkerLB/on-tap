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
        console.log('admin script fired');
    };

})(jQuery, OnTap);

jQuery(document).ready(function() {
    OnTap.admin.init();
});
