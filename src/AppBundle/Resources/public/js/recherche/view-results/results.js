'use strict'

angular
    .module('results', ['ngRoute'])
    .config(function($routeProvider){
        $routeProvider.when('/results/:startLat/:startLng/:finishLat/:finishLng/:date/', {
            templateUrl : 'bundles/app/js/recherche/view-results/results.html',
            controller : 'ResultsCtrl'
        });
    });

