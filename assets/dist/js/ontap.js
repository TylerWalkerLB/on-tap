var OnTap=OnTap||{};!function(a,b){var c=b.onTapMap={};c.elementObjects={},c.Vars={},c.init=function(){c.elementObjects.mapContainer=document.getElementById("ot-map"),c.elementObjects.$mapExists=a("#ot-map"),c.elementObjects.$mapExists.length&&(c.Vars.ajaxUrl=ot_ajax.ajaxUrl,c.Vars.adminUrl=ot_ajax.admin_url,c.Vars.locations=ot_ajax.locations,c.Vars.allInfoWindows=[],c.Vars.infowindow=new google.maps.InfoWindow,c.elementObjects.map=new google.maps.Map(c.elementObjects.mapContainer,{center:{lat:32.954709,lng:-96.847184},zoom:8}),c.Vars.locations.forEach(function(a,b){c.Vars.markers=new google.maps.Marker({map:c.elementObjects.map,position:new google.maps.LatLng(a.location_lat,a.location_lng),label:b}),locationName=a.location_name,infoContent="<h6>"+a.location_name+"</h6>",c.Vars.infowindow.setContent(infoContent),c.Vars.infowindow.open(c.elementObjects.map,this),c.Vars.allInfoWindows.push(c.Vars.markers)}))}}(jQuery,OnTap),jQuery(document).ready(function(){OnTap.onTapMap.init()});