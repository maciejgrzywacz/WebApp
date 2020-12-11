var app = angular.module("loginApp", []);
app.controller("loginCtrl", function ($scope, $http) {
  $scope.loginUser = function () {
    $login = $scope.login;
    $password = $scope.password;

    $data = {};
    $data.login = $login;
    $data.password = $password;
    document.getElementById("messageSucces").style.display = "none";
    document.getElementById("messageAlert").style.display = "none";

    $http.post("login.php", { login: $login, password: $password }).then(
      function success(response) {
        document.getElementById("messageSucces").style.display = "block";
        window.location.replace("../user/user.html?login=" + $login);
      },
      function error(response) {
        document.getElementById("messageAlert").style.display = "block";
      }
    );
  };
});
