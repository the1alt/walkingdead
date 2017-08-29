/**
 * Directives
 */
(function() {

    "use strict";

    angular.module('charactereRecords').directive("map", map);


    function map() {

        return {
            restrict: 'EA',
            replace: true,
            transclude: true,
            scope: { characteres: '=characteres', coords:'=coords' },
            template: '<div id="map"></div>',
            link: function(scope, element, attrs) {
                scope.$watch("characteres", function(newValue, oldValue) {
                    //console.log(newValue, oldValue);

                    var map = new google.maps.Map(document.getElementById('map'), {
                        center: scope.coords, //init
                        zoom: 14,
                        styles: [{"featureType":"all","elementType":"labels.text.fill","stylers":[{"color":"#ffffff"}]},{"featureType":"all","elementType":"labels.text.stroke","stylers":[{"color":"#000000"},{"lightness":13}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#000000"}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#eeeeee"},{"lightness":14},{"weight":1.4}]},{"featureType":"landscape","elementType":"all","stylers":[{"color":"#08304b"}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#0c4152"},{"lightness":5}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#000000"}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#0b434f"},{"lightness":25}]},{"featureType":"road.arterial","elementType":"geometry.fill","stylers":[{"color":"#000000"}]},{"featureType":"road.arterial","elementType":"geometry.stroke","stylers":[{"color":"#0b3d51"},{"lightness":16}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#000000"}]},{"featureType":"transit","elementType":"all","stylers":[{"color":"#aafff"}]},{"featureType":"water","elementType":"all","stylers":[{"color":"#021019"}]},{"featureType":"transit","elementType":"all","stylers":[{"color":"#146474"}]},{"featureType":"transit.station.airport","elementType":"labels.text.fill","stylers": [{"color":"#040404"}]},{"featureType":"transit.station.airport","elementType": "labels.text.stroke","stylers": [{"visibility": "on"},{"color":"#fefefe"}]},]});

                    var lat = 	49.00749937;
                    var long = 	2.54836031;
                    newValue.forEach(function(element) {

                        var contentString = '<div id="content">' +
                            element.pseudo+ " - " + element.activity +
                            '</div>';

                        var infowindow = new google.maps.InfoWindow({
                            content: contentString
                        });


                        lat++; //exemple
                        long++;

                        var marker = new google.maps.Marker({
                            position: { lat: parseFloat(element.latitude), lng: parseFloat(element.longitude) },
                            map: map,
                            title: element.pseudo
                        });

                        marker.addListener('click', function() {
                            infowindow.open(map, marker);
                        });

                        // To add the marker to the map, call setMap();
                        marker.setMap(map);
                    });



                }, true);
            }
        };
    }


}());
