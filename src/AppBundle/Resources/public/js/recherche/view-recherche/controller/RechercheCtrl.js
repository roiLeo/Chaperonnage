'use strict'

angular
    .module('recherche')
    .controller('RechercheCtrl', ['$scope', function($scope){
        initAutocomplete();
        $scope.myDate = new Date();
        $scope.isOpen = false;
    }]);