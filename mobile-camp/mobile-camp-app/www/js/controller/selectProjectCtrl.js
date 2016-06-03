app

.controller('SelectProjectCtrl', function ($scope, $http, $stateParams, $window, $ionicLoading) {

  console.log('SelectProjectCtrl');

  $scope.colorUrl = $stateParams.colorName;

  var login = $stateParams.login;
  console.log(login);

  $ionicLoading.show({
    template: '<ion-spinner icon="android"></ion-spinner>'
  });



  $http.get('https://auth.etna-alternance.net/login')
    .success(function (data) {
      $scope.loginSignIn = data.login;

      $http.get('https://prepintra-api.etna-alternance.net/students/'+$scope.loginSignIn+'/currentactivities')
        .success(function (data) {
          console.log(data);
          $scope.projects = data;
        })
        .error(function (err) {
          console.log(err);
        })
        .finally(function() {
          $ionicLoading.hide();
          $scope.chargement = true;
        });
    })
    .error(function (err) {
      console.log(err);
    });

  $scope.goBack = function () {
    $window.history.back();
  }



  $scope.addMembers = function (session, projectId) {

    $ionicLoading.show({
      template: '<ion-spinner icon="android"></ion-spinner>'
    });

    $http.get('https://prepintra-api.etna-alternance.net/sessions/'+session+'/project/'+projectId+'/mygroup')
      .success(function (data) {
        console.log(data)
        var leaderId = data.id;
        $http.post("https://prepintra-api.etna-alternance.net/sessions/"+session+"/project/"+projectId+"/group/"+leaderId, {'student': login} )
          .success(function(data) {
            console.log(data);
            Materialize.toast("Vous avez ajouter un membre", 1500, "green");
            //$scope.modal.hide();
          })
          .error(function (err, status) {
            console.log(err);

            if (err == "Student already in a different group") {
              Materialize.toast("Cet utilisateur est déjà dans un groupe", 1500, "red");
            } else if (status == 403) {
              Materialize.toast("Vous n'avez pas le droit d'ajouter de membres", 1500, "red");
            } else if (status == 500) {
              Materialize.toast("Cet utilisateur est déjà dans un groupe", 1500, "red");
            } else if (err = "Group full") {
              Materialize.toast("Le groupe est au complet ! Impossible d'ajouter un nouveau membre", 1500, "red");
            }
          })
          .finally( function () {
            $ionicLoading.hide();
          });
      })
      .error(function (err, status) {
        console.log(err);
        if (status == 404) {
          Materialize.toast("Vous n'avez pas créé de groupe pour ce projet", 1500, "red");
        }
      })
      .finally( function () {
        $ionicLoading.hide();
      });

  }



})
