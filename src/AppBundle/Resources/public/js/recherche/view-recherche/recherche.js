angular
    .module('recherche', ['ngRoute', 'ngMaterial', 'ngMessages'])
    .config(function($routeProvider){
        $routeProvider.when('/recherche', {
            templateUrl : 'bundles/app/js/recherche/view-recherche/recherche.html',
            controller : 'RechercheCtrl'
        });
    });