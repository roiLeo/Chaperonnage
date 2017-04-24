'use strict'

angular
    .module('myApp', ['ngRoute', 'recherche', 'results', 'moment-picker'])
    .config(function($routeProvider, $locationProvider){
        $routeProvider.otherwise({
            redirectTo : '/recherche'
        });
        //La valeur par défaut du préfixe a changé dans la version 1.6
        $locationProvider.hashPrefix('');
    });
