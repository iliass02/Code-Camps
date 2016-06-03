app
.controller('WishListCtrl', function ($scope, $location, $http, $stateParams, $mdDialog, $window, $ionicModal, $state) {

  $scope.userId = $stateParams.userId;
  $scope.colorUrl = $stateParams.colorName;


  $http.get(url_path+'/api/v1/account/'+$scope.userId)
    .success(function (data) {
      console.log(data);
      $scope.login = data.userInfo[0].login;
    })
    .error(function (err) {
      console.log(err);
    })



  $http.get(url_path+'/api/v1/wishList/'+$scope.userId)
    .success(function (data) {
      $scope.users = data.data;
      console.log(data.data);
    })
    .error(function (err) {
      console.log(err);
    })

  //modal
  $scope.showConfirm = function(ev, userLikeId) {
    // Appending dialog to document.body to cover sidenav in docs app
    var confirm = $mdDialog.confirm()
      .title('Êtes-vous sûr de vouloir le supprimer ?')
      .textContent('Cet utilisateur sera supprimé définitivement de votre Wish List !')
      .targetEvent(ev)
      .ok('Oui')
      .cancel('Non', 'red');
    $mdDialog.show(confirm).then(function() {
      console.log("Oui");
      $scope.remove(userLikeId);
    }, function() {
      console.log("Non");
    });
  };

  $scope.remove = function(userLikeId) {
    console.log(userLikeId, $scope.userId);
    //remove userLikeId

    var data2 =  {
      userId: $scope.userId
    };
    console.log(url_path+'/api/v1/wishlist/'+userLikeId);

    $http.delete(url_path+'/api/v1/wishlist/'+userLikeId+'?userId='+$scope.userId)
      .success(function (data) {
        Materialize.toast("L'utilisateur a bien été supprimé !", 1500, "green");

        //refresh ng-repeat
        $http.get(url_path+'/api/v1/wishList/'+$scope.userId)
          .success(function (data) {
            $scope.users = data.data;
            console.log(data.data);
          })
          .error(function (err) {
            console.log(err);
          })

      })
      .error(function (err) {
        Materialize.toast("Erreur: Veuillez reessayer ulterieurement", 1500, "red");
      })
  }

  $scope.profil = function (userId) {
    $location.path('account/viewer/'+userId+'/'+$scope.colorUrl)
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

  $scope.goBack = function() {
    $window.history.back();
  }

})
