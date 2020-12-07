var app = angular.module("registerApp", []);
app.controller("registerCtrl", function($scope, $http) {

    $scope.registerButtonDisabled = true;

    $scope.valueChanged = function() {        
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
        if ($scope.password != $scope.confirmPassword) {
            alert("Passwords do not match!");
            $scope.password = "";
            $scope.confirmPassword = "";
        }

        $data = {
            login: $scope.login,
            password: $scope.password,
            name: $scope.name,
            surname: $scope.surname,
            pesel: $scope.pesel,
            age: $scope.age,
            country: $scope.country,
            city: $scope.city,
            address: $scope.address,
            postcode: $scope.postcode
        };

        $http.post("register.php", $data).then(
            function success(response) {
                alert(response.data.message);
                $scope.login = "";
                $scope.password = "";
                $scope.name = "";
                $scope.surname = "";
                $scope.pesel = "";
                $scope.age = "";
                $scope.country = "";
                $scope.city = "";
                $scope.address = "";
                $scope.postcode = "";
            },
            function error(response){
                if(response.status == 400) {
                    alert(response.data.message);
                }
                else {
                    alert("Server error: user not added.");
                }
            }
        );
    }
});