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
    Self.Vars.geocoder = new google.maps.Geocoder();

    Self.init = function() {
        Self.elementObjects.addNewForm = $('.on-tap-add-edit');

        if (Self.elementObjects.addNewForm.length) {
            Self.elementObjects.newTitle = Self.elementObjects.addNewForm.find('.loc-title');
            Self.elementObjects.newAdd1 = Self.elementObjects.addNewForm.find('.loc-address1');
            Self.elementObjects.newAdd2 = Self.elementObjects.addNewForm.find('.loc-address2');
            Self.elementObjects.newCity = Self.elementObjects.addNewForm.find('.loc-city');
            Self.elementObjects.newState = Self.elementObjects.addNewForm.find('.loc-state');
            Self.elementObjects.newZip = Self.elementObjects.addNewForm.find('.loc-zip');
            Self.elementObjects.submitButton = Self.elementObjects.addNewForm.find('.loc__submit');

            // Self.elementObjects.addNewForm.on('submit', function(e) {
            //     e.preventDefault();
            //     Self.addEditNewLocation();
            // });

            Self.elementObjects.submitButton.on('click', function(e) {
                console.log('button clicked');
                Self.addEditNewLocation();
            });
        }
    };

    Self.addEditNewLocation = function() {
        var title = Self.elementObjects.newTitle.val();
        var addr1 = Self.elementObjects.newAdd1.val();
        var addr2 = Self.elementObjects.newAdd2.val();
        var city = Self.elementObjects.newCity.val();
        var state = Self.elementObjects.newState.val();
        var zip = Self.elementObjects.newZip.val();
        var addEdit = Self.elementObjects.addNewForm.data('which');

        var locLat;
        var locLng;

        var address = addr1;

        if (addr2 != '' || addr2 != null) {
            address += ' ' + addr2 + ', ';
        }
        else {
            address += ', ';
        }

        address += city + ', ' + state + ' ' + zip;

        Self.Vars.geocoder.geocode({ 'address': address }, function (results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                locLat = results[0].geometry.location.lat();
                locLng = results[0].geometry.location.lng();
            }
        });

        var data = {
            'action': 'ontap_add_edit',
            'which' : addEdit,
            'title' : title,
            'addr1' : addr1,
            'addr2' : addr2,
            'city'  : city,
            'state' : state,
            'zip'   : zip,
            'lat'   : locLat,
            'lng'   : locLng
        };

        $.post(Self.Vars.ajaxUrl, data, function (response) {
            if (response) {
                window.location.assign(Self.Vars.adminUrl + 'admin.php?page=on-tap%2Fon-tap-locations.php&success=true');
            } else {
                alert('didnt work');
            }
        });


    };

})(jQuery, OnTap);

jQuery(document).ready(function() {
    OnTap.admin.init();
});
