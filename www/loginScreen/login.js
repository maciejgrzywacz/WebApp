var app = angular.module("loginApp", []);
app.controller("loginCtrl", function($scope, $http) {

    $scope.loginUser = function() {
        $login = $scope.login;
        $password = $scope.password;

        $data = {};
        $data.login = $login;
        $data.password = $password;

        $http.post("login.php", {login: $login, password: $password}).then(
            function success(response) {
                alert("User logged in.")
            },
            function error(response){
                alert('Access denied.');
            }
        );
    }
});