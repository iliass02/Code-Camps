app
.controller('ChatUsersCtrl', function ($scope, $location, $http, $stateParams, $window, $ionicScrollDelegate) {

  console.log('ChatUsersCtrl');

  $scope.userId = $stateParams.userId;
  $scope.userIdChat = $stateParams.userIdChat;
  $scope.colorUrl = $stateParams.colorName;



  $http.get(url_path+'/api/v1/chat/'+$scope.userIdChat+'/user/'+$scope.userId)
    .success(function(data){
      console.log(data);
      $scope.chats = data.data;
      $ionicScrollDelegate.scrollBottom();
    })
    .error(function (err) {
      console.log(err);
    })


  $scope.message = function (message) {

    $http.post(url_path+'/api/v1/chat/'+$scope.userIdChat+'/user/'+$scope.userId, {message: message})
      .success(function (data) {
        console.log(data);

        //refresh
        $http.get(url_path+'/api/v1/chat/'+$scope.userIdChat+'/user/'+$scope.userId)
          .success(function(data){
            console.log(data);
            $scope.chats = data.data;
            $scope.message.text = "";
          })
          .error(function (err) {
            console.log(err);
          })
      })
      .error(function (err) {
        console.log(err)
      });

  }

  $scope.goBack = function () {
    $window.history.back();
  }






})
