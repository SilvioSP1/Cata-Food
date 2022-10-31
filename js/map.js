const argCoords = { lat: -38.416097, lng: -63.616672 };
const mapDiv = document.getElementById("map");
const input = document.getElementById("place_input");
let map;
let marker;
let autocomplete;

function initMap() {

    map = new google.maps.Map(mapDiv, { 

        center: argCoords, 
        zoom: 5,

    });

    marker = new google.maps.Marker({ //declaramos el marcador

        position: argCoords,
        map: map,

    });

    initAutocomplete()


    function initAutocomplete(){

        autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.addListener('place_changed', function (){

            const place = autocomplete.getPlace();
            map.setCenter(place.geometry.location);
            marker.setPosition(place.geometry.location); 

        });

    }
}

