angular.module('app', [])
    .controller('RepportController', function ($scope, $http) {
        $scope.repport = null;

        var refresh = function () {
            $http.get(Routing.generate('repport_all')).success(function (res) {
                $scope.repports = res;
            });
        };
        refresh();

        $scope.showContent = function (repport) {
            $scope.repport = repport;
        };

        $scope.refreshRepport = function () {
            refresh();
        };
    })
    .config(function ($interpolateProvider) {
        $interpolateProvider.startSymbol('{[{').endSymbol('}]}');
        //$httpProvider.defaults.headers.common["X-Requested-With"] = 'XMLHttpRequest';
    });