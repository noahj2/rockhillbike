var map;
var green = "#006837";
var blue = "#0F84EC";
var forestGreen = "#797003";
var lineColor = "#000";
var markers = [];
var polyLines = [];

function initMap() {

    map = new google.maps.Map(document.getElementById('map'), {
        center: {
            lat: 34.9413067035216,
            lng: -81.0260256352684
        },
        zoom: 14,
        mapTypeId: google.maps.MapTypeId.TERRAIN
    });

    map.setOptions({
        minZoom: 13,
        maxZoom: 0
    });
	
	//map boundaries
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

	//polyLines = [
	//];
	
	var polyLinesPath = new google.maps.Polyline({
	    path: polyLines,
	    geodesic: true,
	    strokeColor: '#FF0000',
	    strokeOpacity: 1.0,
	    strokeWeight: 2
	});
	
	polyLinesPath.setMap(map);
}