var map;
var green = "#006837";
var blue = "#0F84EC";
var forestGreen = "#797003";
var gray = "gray";
var color = "#000";
var markers = [];
var latCenter = 34.9413067035216;
var longCenter = -81.0260256352684;
var trailMode = false;
var poly = null;
var routePoints = null;
var bounds = null;

function initMap() {

    map = new google.maps.Map(document.getElementById('map'), {
        center: {
            lat: latCenter,
            lng: longCenter
        },
        zoom: 14,
        mapTypeId: google.maps.MapTypeId.TERRAIN
    });

    map.setOptions({
        minZoom: 13,
        maxZoom: 0
    });
	
	//map boundaries
	
	var minLat = 34.8;
	var minLng = -81.2;
	var maxLat = 35.1;
	var maxLng = -80.8;
	
    var allowedBounds = new google.maps.LatLngBounds(
        new google.maps.LatLng(34.8, -81.2),
        new google.maps.LatLng(35.1, -80.8)
    );

    var lastValidCenter = map.getCenter();

    google.maps.event.addListener(map, 'dragend', function() {
        if (allowedBounds.contains(map.getCenter())) return;

        // Out of bounds - Move the map back within the bounds

        var c = map.getCenter(),
            x = c.lng(),
            y = c.lat(),
            maxX = allowedBounds.getNorthEast().lng(),
            maxY = allowedBounds.getNorthEast().lat(),
            minX = allowedBounds.getSouthWest().lng(),
            minY = allowedBounds.getSouthWest().lat();

        if (x < minX) x = minX;
        if (x > maxX) x = maxX;
        if (y < minY) y = minY;
        if (y > maxY) y = maxY;

        map.setCenter(new google.maps.LatLng(y, x));
    });
    
    
   /*function zoomToObject(polyLines){
            var bounds = new google.maps.LatLngBounds();
            var points = polyLines.getPath().getArray();
            for (var i = 0; i < points.length ; i++){
                bounds.extend(points[i]);
            }
            map.fitBounds(bounds);
        }
    */
	
	$(document).ready(function(){
	    
	    

        $(".mapit").on("click", function(){
            
            if(trailMode == true){
                console.log("You mapping a different path.");
                //map.clear();
            }
                
            if ($(this).hasClass("trailColor")) {
                color = forestGreen;
            } else if ($(this).hasClass("specialWaysColor")) {
                color = green;
            } else if ($(this).hasClass("blueWaysColor")) {
                color = blue;
            } else if ($(this).hasClass("sidewalkColor")) {
                color = gray;
            } else {
                return;
            }
            
            
        	trailMode = true;
        	
        	var startPoints = window["routePointsStart" + $(this).attr("data-id")];
            var endPoints = window["routePointsEnd" + $(this).attr("data-id")];
            routePoints = window["routePoints" + $(this).attr("data-id")];
            
            
            
            
            for(var i = 0; i < endPoints.length; i++){
                var startPt = new google.maps.LatLng(startPoints[i][0], startPoints[i][1]);
                var endPt = new google.maps.LatLng(endPoints[i][0], endPoints[i][1]);
                
                var polyLines = [startPt, endPt];
                
                //for(var i = 0; i < polyLines.length; i++){
                    //bounds.extend(polyLines[i].latLng());
                //}
                
                
                
                poly = new google.maps.Polyline({
                path: polyLines,
                strokeColor: color,
                strokeOpacity: 1.0,
                strokeWeight: 5
                });
                
                
                
                //link to map
                poly.setMap(map);
                //zoomToObject(bounds);
            }
            
            //function clearAll(){
    
            	//console.log("You mapping a different path.");
            
                //removes the markers from the map, but keeps them in the array.
                //for(i = 0; i < polyLines.length; i++) {
                  //  polyLines[i].setMap(null);
                //}
                
                
                //for(i = 0; i < markers.length; i++) {
                  //  markers[i].setMap(null);
                //}
            
                //deletes all markers & coords in the array by removing references to them.
                //markers = [];
                //poly.setMap(null);
                //polyLines = [];
                
            //}
            
            
        });
    });
}