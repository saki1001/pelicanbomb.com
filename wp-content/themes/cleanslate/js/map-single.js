// Declare All Global Variables
// ----------------------------------
var ads = [];
var neighborhoods = [];

var markers = [];
var iterator = 0;

var infoWindow;
var map;
var geocoder;
var coordinates;

// Add markers to map
// ----------------------------------
var addMarker = function() {
    markers.push(new google.maps.Marker({
        position: neighborhoods[iterator],
        map: map,
        draggable: false,
        animation: google.maps.Animation.DROP,
        icon: new google.maps.MarkerImage(templateDirectoryUrl + 'images/map-pin.png')
    }));
    
    iterator++;
}

// Make map once all coordinates found
// ----------------------------------
var getMap = function() {
    if( neighborhoods.length ===  $j('.addy').length ) {
        createMap();
        createMapPins();
    }
};

// Get coordinates of place(s)
// ----------------------------------
var geocodeAddress = function(coordinates, address) {
    
    geocoder = new google.maps.Geocoder();
    
    // Find Coordinates if none
    if( coordinates === '' ) {
        geocoder.geocode( {'address': address }, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                
                if (results[0]) {
                    var lat =  results[0].geometry.location.lat();
                    var lng =  results[0].geometry.location.lng();
                    coordinates = lat + ',' + lng;
                    
                    // Callback function
                    neighborhoods.push(coordinates);
                    getMap();
                } else {
                    // alert('No results available');
                    $j('#mapBox').append('<p>No map available.</p>');
                }
                
            } else {
                // alert("Geocoder failed due to: " + status);
                $j('#mapBox').append('<p>No map available.</p>');
            }
            
        });
        
    } else {
        neighborhoods.push(coordinates);
        getMap();
    }
};

var createMap = function() {
    
    var origin;
    
    if( neighborhoods.length === 1 ) {
        var LatLng = neighborhoods[0];
        var latlngparts = LatLng.split(",");
        origin = new google.maps.LatLng(parseFloat(latlngparts[0]), parseFloat(latlngparts[1]));
    } else {
        //start off with new orleans///
        origin = new google.maps.LatLng(29.98700, -90.061798);
    }
    
    // Set map options
    var mapOptions = {
        zoom: 12,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        center: origin
    };
    
    // Create map
    map = new google.maps.Map(document.getElementById('mapBox'), mapOptions);
};

var createMapPins = function() {
    for (var i = 0; i < neighborhoods.length; i++) {
        
        // console.log(neighborhoods[i]);
        var LatLng = neighborhoods[i];
        var latlngparts = LatLng.split(",");
        
        markers.push(new google.maps.Marker({
            position: new google.maps.LatLng(parseFloat(latlngparts[0]), parseFloat(latlngparts[1])),
            map:map,
            draggable: false,
            animation: google.maps.Animation.DROP,
            icon: new google.maps.MarkerImage(templateDirectoryUrl + '/images/map-pin.png')
        }));
        
        var boxText = document.createElement("div");
        boxText.style.cssText = "border: 1px solid black; margin-top: 8px; background: yellow; padding: 5px;";
        boxText.innerHTML = "test";
        
        var myOptions = {
                 content: boxText
                ,disableAutoPan: false
                ,maxWidth: 0
                ,pixelOffset: new google.maps.Size(-140, 0)
                ,zIndex: null
                ,boxStyle: { 
                  background: "url('tipbox.gif') no-repeat"
                  ,opacity: 0.90
                  ,width: "280px"
                 }
                ,closeBoxMargin: "10px 10px 10px 10px"
                ,closeBoxURL: "http://www.google.com/intl/en_us/mapfiles/close.gif"
                ,infoBoxClearance: new google.maps.Size(1, 1)
                ,isHidden: false
                ,pane: "floatPane"
                ,enableEventPropagation: false
        };
        
        var ib = new InfoBox(myOptions);
        
    }
};


$j(document).ready(function() {
    
    // Iterate through addresses
    // Get coordinates if none supplied
    // After last item, call getMap();
    $j('.addy').each(function(){
        var coordinates = $j(this).attr('data-coord');
        var address = $j(this).attr('data-address');
        
        geocodeAddress(coordinates, address);
    });
    
});