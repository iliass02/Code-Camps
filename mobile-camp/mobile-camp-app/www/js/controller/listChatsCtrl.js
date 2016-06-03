app
.controller ('ListChatsCtrl', function($scope, $http, $location, $window, $stateParams) {

  console.log('ListChatsCtrl');

  $scope.colorUrl = $stateParams.colorName;



  $scope.userId = $stateParams.userId

  $http.get(url_path+'/api/v1/chats/users/'+$scope.userId)
    .success(function (data) {
      console.log(data);
      $scope.chats = data.data;
    })
    .error(function (err) {
      console.log(err);
    })



  $scope.getChat = function (user_id, user_id_chat) {

    console.log(user_id, user_id_chat);

    $location.path('/chat/'+user_id_chat+'/user/'+user_id+'/'+$scope.colorUrl);


  }


  $http.get(url_path+'/api/v1/account/'+$scope.userId)
    .success(function (data) {
      console.log(data);
      $scope.login = data.userInfo[0].login;
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


})
