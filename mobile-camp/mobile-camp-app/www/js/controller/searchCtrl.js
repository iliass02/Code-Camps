app
  .controller('SearchCtrl', function($scope, $http, $stateParams) {

  //$scope.users = [];

    $scope.userId = $stateParams.userId;
    $scope.colorUrl = $stateParams.colorName;



    $http.get(url_path+'/api/v1/account/'+$scope.userId)
      .success(function(data) {
        console.log(data);
        $scope.login = data.userInfo[0].login;
      })
      .error(function (err) {
        console.log(err);
      })


  $http.get(url_path + "/api/v1/account/" + $stateParams.userId)
  .success(function(data) {
    console.log(data);
    $scope.promo = data.userInfo[0].terms_id;
  })
  .error(function(data) {
    console.log(data)
  })



  $scope.getSkills = function (skills, promo) {

    var params = {
      promo:promo
      }

    $http.get(url_path + "/api/v1/skills/search/" + skills+"?promo="+promo)
      .success(function(data) {
        console.log(data);
        $scope.users = data.data;
        })
      .error(function(data) {
        console.log(data)
        })
  }


    $scope.userProfil = function (userId) {
      console.log('salut');
      $location.path('/account/viewer/'+userId+'/'+$scope.colorUrl);
    }

    //Tinder Button Tab
    $http.get(url_path+'/api/v1/users')
      .success(function (data) {

        if ($scope.userId == data.data[0].id) {
          data.data[0].id = data.data[0].id+1;
        }
        $scope.userTinderId = data.data[0].id;
      })
      .error(function (data) {
        console.log(data);
      })
});
