var app = angular.module("registerApp", []);
app.controller("registerCtrl", function($scope, $http) {

    $scope.registerButtonDisabled = true;

    $scope.valueChanged = function() {
        
            
        if ($scope.pesel) {
            console.log($scope.pesel)
            console.log($scope.pesel.length)
        }
        
        // validate input
        if ($scope.login && $scope.login!=='' &&
        $scope.password && $scope.password!=='' &&
        $scope.confirmPassword && $scope.confirmPassword!=='' &&
        $scope.name && $scope.name!=='' &&
        $scope.surname && $scope.surname!=='' &&
        $scope.pesel && !isNaN($scope.pesel) && $scope.pesel.length == 8 &&
        $scope.age && !isNaN($scope.age) &&
        $scope.country && $scope.country!=='' &&
        $scope.city && $scope.city!=='' &&
        $scope.address && $scope.address!=='' &&
        $scope.postcode && $scope.postcode!=='')   
        {
            $scope.registerButtonDisabled = false;
        }
        else {
            $scope.registerButtonDisabled = true;
        }

    };

    $scope.registerUser = function() {
        // check if passwords match
        if ($scope.login )
        if ($scope.password != $scope.confirmPassword) {
            alert("Passwords do not match!");
            $scope.password = "";
            $scope.confirmPassword = "";
        }

        $data = {
            login: $scope.login,
            password: $scope.password,
        };


        // $login = $scope.login;

        // $data = {};
        // $data.login = $login;
        // $data.password = $password;

        // $http.post("register.php", {login: $login, password: $password}).then(
        //     function success(response) {
        //         $scope.statusMessage = "Success!";
        //     },
        //     function error(response){
        //         $scope.statusMessage = "Error :<";
        //     }
        // );
    }
});