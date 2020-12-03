var app = angular.module("loginApp", []);
app.controller("imionaCtrl", function($scope, $http) {
    //$scope.imiona = [];
    alert($scope.login);
    $http.post("login.php", {}).then(
        function (response) {
            $scope.imiona = response.data.imiona;
        },
        function(){}
    );
});