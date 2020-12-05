var app = angular.module("imionaApp", []);
app.controller("imionaCtrl", function($scope, $http) {
    alert("elo")
    $http.get("imiona.php").then(
        function (response) {
            $scope.imiona = response.data.imiona;
        },
        function(){}
    );
});