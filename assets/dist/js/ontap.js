var OnTap=OnTap||{};!function(a,b){var c=b.onTapMap={};c.elementObjects={},c.Vars={},c.init=function(){c.elementObjects.mapContainer=document.getElementById("ot-map"),c.elementObjects.$mapExists=a("#ot-map"),c.elementObjects.$mapExists.length&&(c.Vars.ajaxUrl=ot_ajax.ajaxUrl,c.Vars.adminUrl=ot_ajax.admin_url,c.Vars.locations=ot_ajax.locations,c.Vars.markers=[],c.Vars.infowindow=new google.maps.InfoWindow,c.elementObjects.map=new google.maps.Map(c.elementObjects.mapContainer,{center:{lat:32.954709,lng:-96.847184},zoom:8}),c.Vars.locations.forEach(function(a,b){var d=new google.maps.Marker({map:c.elementObjects.map,position:new google.maps.LatLng(a.location_lat,a.location_lng),label:String(b)});c.Vars.markers.push(d),google.maps.event.addListener(d,"click",function(b){return function(){var d="";a.location_address2.length>0&&(d='<p class="ot-location__address2">'+a.location_address2+"</p>");var e='<div class="ot-location"><h6 class="ot-location__name">'+a.location_name+'</h6><p class="ot-location__address1">'+a.location_address1+"</p>"+d+'<p class="ot-location__address3">'+a.location_city+", "+a.location_state+" "+a.location_zip+"</p></div>";c.Vars.infowindow.setContent(e),c.Vars.infowindow.open(c.elementObjects.map,b)}}(d))}))}}(jQuery,OnTap),jQuery(document).ready(function(){OnTap.onTapMap.init()});