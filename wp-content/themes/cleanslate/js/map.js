//declare all global variables //////////////////
var ads = [];
var neighborhoods = [];

var markers = [];
var iterator = 0;

var infoWindow;
var map;
var geocoder;

//function for adding markers with iteration /////////////

function addMarker() {
    markers.push(new google.maps.Marker({
        position: neighborhoods[iterator],
        map: map,
        draggable: false,
        animation: google.maps.Animation.DROP,
        icon: new google.maps.MarkerImage(templateDirectoryUrl + 'images/map-pin.png')
    }));
    
    iterator++;
}

//start jquery load stuff ///////////////////
$j(document).ready(function() {
    
    $j('#mapbutton').click(function(){
        var geocoder;
        geocoder = new google.maps.Geocoder();
        
        var address =  $j('#address').val();
        var addcont =  $j('#citystate').val();
        var comb = address + addcont;
        
        geocoder.geocode( {'address': comb }, function(results, status) {
            var lat =  results[0].geometry.location.lat();
            var lng =  results[0].geometry.location.lng();
            $j('#latitude').val(lat+','+lng);
            
        });
        
        return false;
     });
    
    //start off with new orleans///
    var orleans = new google.maps.LatLng(29.98700, -90.061798);
    
    //create map ///////////////////////////////////
    var mapOptions = {
        zoom: 12,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        center: orleans
    };
    
    map = new google.maps.Map(document.getElementById("mapBox"), mapOptions);
    
    //create infowindow that will just move around depending on click
    
    $j('.addy').each(function(){
        neighborhoods.push($j(this).attr('coord'));
    });
    
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
    
    // Click Handler for scroll to marker
    $j('.addy').click(function(){
        
        var ind =  $j(this).index('.addy');
        var addy =  $j(this).attr('id');
        var title =  $j(this).attr('title');
        
        $j('html, body').animate({
            scrollTop: 0
        }, 500, function(){
            scrollToMarker(ind, addy, title);
        });
        
        return false;
    });
    
    // Scroll to pin on map
    function scrollToMarker(index, addy, title) {
        var content =  '<h5 style="color:#fff;"><b>'+title+'</b></h5><p style="color:#fff;">'+addy+'</p>';
        map.setZoom(18);
        map.panTo(markers[index].getPosition());
        ib.open(map, markers[index]);
        var boxText = document.createElement("div");
            boxText.style.cssText = "border: 2px solid #fff; margin-top:0px; background: #2e3192; padding: 10px;";
            boxText.innerHTML = content;
            
        ib.setContent(boxText);
        
    }

//grab id values from all address dom elements and loop through them //////
});