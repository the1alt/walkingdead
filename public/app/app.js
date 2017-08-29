var app = angular.module('charactereRecords', [], function ($interpolateProvider) {
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
})
    .constant('API_URL', 'http://localhost/walkingdead/public/api/v1/');