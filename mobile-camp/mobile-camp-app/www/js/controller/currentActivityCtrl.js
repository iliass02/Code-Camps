app
.controller('CurrentActivityCtrl', function($scope, $http, $location, $stateParams, $ionicNavBarDelegate, $ionicLoading) {

  $ionicNavBarDelegate.showBackButton(false);

  $scope.colorUrl = $stateParams.colorName;


  console.log('Current Activity Ctrl');
  $ionicLoading.show({
    template: '<ion-spinner icon="android"></ion-spinner>'
  });


  $scope.login = $stateParams.login;


  $http.get('https://prepintra-api.etna-alternance.net/students/'+$stateParams.login+'/currentactivities')
    .success(function(data) {
      $scope.projects = data;
      $ionicLoading.hide();
    })
    .error(function(err) {
      console.log(err);

    })
    .finally(function () {
      $ionicLoading.hide();
      $scope.chargement = true;

    })

  $http.get(url_path+'/api/v1/user/login/'+$stateParams.login)
    .success(function (data) {
      $scope.userId = data.data[0].id;

      //Tinder Button Tab
      $http.get(url_path+'/api/v1/account/'+$scope.userId)
        .success(function (data) {
          $scope.term = data.userInfo[0].terms_id;
        })
        .error(function (data) {
          console.log(data);
        })
    })
    .error(function (err) {
      console.log(err);
    })

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
