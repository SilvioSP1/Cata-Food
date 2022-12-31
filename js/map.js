/* const argCoords = { lat: -38.416097, lng: -63.616672 };
const mapDiv = document.getElementById("map");
const input = document.getElementById("place_input");
let map;
let marker;
let autocomplete;

function initMap() {

    map = new google.maps.Map(mapDiv, { 

        center: argCoords, 
        zoom: 15

    });

    marker = new google.maps.Marker({ //declaramos el marcador

        position: argCoords,
        map: map

    });

    initAutocomplete();


    function initAutocomplete(){

        autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.addListener('place_changed', function (){

            const place = autocomplete.getPlace();
            map.setCenter(place.geometry.location);
            marker.setPosition(place.geometry.location); 

        });

    }
} */

var map;
var marker;
var myLatlng = new google.maps.LatLng(-28.469264, -65.779011);
var geocoder = new google.maps.Geocoder();
const input = document.getElementById("place_input");
let autocomplete;
function initialize() {
    var mapOptions = {
    zoom: 13,
    center: myLatlng,
    mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    map = new google.maps.Map(document.getElementById("map"), mapOptions);
        var marker;
            google.maps.event.addListener(map, 'click', function(event) {
            placeMarker(event.latLng);
        });

    function initAutocomplete(){

        autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.addListener('place_changed', function (){

            const place = autocomplete.getPlace();
            map.setCenter(place.geometry.location);
            marker.setPosition(place.geometry.location); 

        });
    }
    initAutocomplete();
    
    function placeMarker(location) {
        if (marker == null)
        {
                marker = new google.maps.Marker({
                position: location,
                map: map,
                zoom:13
                });
        }
        else
        {
            marker.setPosition(location);
        }
        geocoder.geocode(
            { location: location },
            (
                results = google.maps.GeocoderResult,
                status= google.maps.GeocoderStatus
            ) => {
                if (status === "OK") {
                if (results[0]) {
                console.log  (results[0].address_components);
                var address_components = results[0].address_components;
                        var components={};
                        jQuery.each(address_components,function(k,v1) {jQuery.each(v1.types,function(k2, v2){components[v2]=v1.long_name});});
                        var city, postal_code,state,country,sublocality,street_number,route;
                            
                        console.log(components);
                        if(components.locality) {
                            city = components.locality;
                        }

                        if(!city) {
                            city = components.administrative_area_level_1;
                        }

                        if(components.postal_code) {
                            postal_code = components.postal_code;
                        }
                        if(components.postal_code) {
                            postal_code = components.postal_code;
                        }

                        if(components.administrative_area_level_1) {
                            state = components.administrative_area_level_1;
                        }
                            
                        if(components.route) {
                            route = components.route;
                        }
                        if(components.sublocality_level_1) {
                            sublocality = components.sublocality_level_1;
                        }
                        if(components.country) {
                            country = components.country;
                        }
                        if(components.street_number) {
                            street_number = components.street_number;
                        }
                        $('#place_input').val(results[0].formatted_address);
                        $('#input-address-formated').val(results[0].formatted_address);
                        $('#input-address').val(state);
                        $('#input-city').val(city);
                        $('#input-country').val(country);
                        $('#input-postal-code').val(postal_code);
                        $('#input-street').val(route+', '+sublocality);
                        $('#input-interior-number').val(street_number);
                        $('#input-exterior-number').val(street_number);
                        $('#latitude').val(marker.getPosition().lat());
                        $('#longitude').val(marker.getPosition().lng());
                
                } else {
                    window.alert("No results found");
                }
                } else {
                window.alert("Geocoder failed due to: " + status);
                }
            }
            );
    }

}
google.maps.event.addDomListener(window, 'load', initialize); 



