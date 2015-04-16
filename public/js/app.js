var app = window.app || {};

var incube8 = angular.module('incube8', [], function($interpolateProvider) {
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
});

incube8.controller('TransportationController', ['$scope', function($scope) {
    $scope.transportInfo = {};
}]);

incube8.directive('stationView', ['$http', '$timeout', function ($http, $timeout) {
    return {
        restrict: 'A',
        link: function(scope, el, attr) {
            var self = el,
                btnGetTransInfo = self.find('.get-trans-info');

            btnGetTransInfo.on('click', function(e) {
                var t = $(this),
                    transpoInfoPanel = t.parents('.transpo-info').siblings('.transpo-info-panel'),
                    transportList = transpoInfoPanel.find('.transport-list');

                e.preventDefault();

                if (!transportList.find('li').length) {
                    $http( {
                        method : 'GET',
                        url : t.data('info-url')
                    } ).success(function(data) {
                        transpoInfoPanel.removeClass("hidden");
                        scope.transportInfo[t.data('station-id')] = data;
                    }).error(function(data, status) {
                        alert('Error ' + status);
                    });
                } else {
                    transpoInfoPanel.toggleClass("hidden");
                }
            });
        }
    }
}])