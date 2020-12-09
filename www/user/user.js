var app = angular.module("userApp", []);
app.controller("userCtrl", function ($scope, $http) {
  const urlParams = new URLSearchParams(window.location.search);
  const login = urlParams.get("login");

  $http.get("user.php?login=" + login).then(
    function (response) {
      $scope.users = response.data.users;
    },
    function () {}
  );
});
