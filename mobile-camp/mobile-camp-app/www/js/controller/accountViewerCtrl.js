app
.controller('AccountViewerCtrl', function ($scope, $http, $stateParams, $ionicModal, $window, $mdDialog, $location, $state) {

  $scope.goBack = function () {
    $window.history.back();
  }


  console.log($stateParams.login);

  $scope.colorUrl = $stateParams.colorName;



  $http.get(url_path + '/api/v1/account/' + $stateParams.userId)
    .success(function(data) {
      console.log(data)
      $scope.user = data.userInfo[0];
      console.log(data);


      $http.get(url_path + '/api/v1/skill/recommandation/count/' + $stateParams.userId + '/0')
        .success(function (data) {
          console.log(data);
          $scope.count = data.data;
        })
        .error(function (data) {
          console.log(data);
        })

      $http.get(url_path + '/api/v1/skill/recommandation/count/' + $stateParams.userId + '/1')
        .success(function (data) {
          console.log(data);
          $scope.countImprove = data.data;
        })
        .error(function (data) {
          console.log(data);
        })
    })

  //get userId personne connecter
  $http.get('https://auth.etna-alternance.net/login')
    .success(function (data) {
      var login = data.login;

      $http.get(url_path+'/api/v1/user/login/'+login)
        .success(function (data) {
          $scope.userIdConnect = data.data[0].id;
        })
        .error(function (err) {
          console.log(err);
        })

    })
    .error(function (err) {
      console.log(err);
    })


      $http.get(url_path + '/api/v1/skill/recommandation/count/' + $stateParams.userId + '/0')
        .success(function (data) {
          console.log(data);
          $scope.count = data.data;
        })
        .error(function (data) {
          console.log(data);
        })

      $http.get(url_path + '/api/v1/skill/recommandation/count/' + $stateParams.userId + '/1')
        .success(function (data) {
          console.log(data);
          $scope.countImprove = data.data;
        })
        .error(function (data) {
          console.log(data);
        })






  //modal
  $scope.showConfirm = function(ev, telephone, login, nom, prenom) {
    // Appending dialog to document.body to cover sidenav in docs app
    console.log(ev);
    var confirm = $mdDialog.confirm()
      .title('Quoi faire ?')
      .textContent('Vous pouvez faire une demande de groupe par SMS ou faire une demande de groupe classique !')
      .targetEvent(ev)
      .ok('SMS')
      .cancel('Classique');
    $mdDialog.show(confirm).then(function() {
      console.log("Oui");
      $scope.createGroup(telephone, login, nom, prenom);
    }, function() {
      console.log(login);
      $location.path('/select-project/'+login+"/"+$scope.colorUrl);
    });
  };



  $scope.createGroup = function (telephone, login, nom, prenom) {

    var params = {
      telephone: telephone,
      login: login,
      nom: nom,
      prenom: prenom
    }

    $http.post(url_path+'/api/v1/send/sms', params)
      .success(function (data) {
        Materialize.toast("Une demande de groupe a été réaliser par SMS", 2500, "green");
      })
      .error(function (err) {
        console.log(err);
        Materialize.toast("Une erreur est survenue veuillez réessayer ulterieurement", 1500, "red");
      })

  }



  $scope.recommand = function (skill_id, skill_nom) {
    console.log(skill_id);
    console.log($stateParams.userId);

    $http.get("https://auth.etna-alternance.net/login")
      .success(function (data) {
        var login = data.login;

        $http.get(url_path + '/api/v1/user/login/' + login)
          .success(function (data) {

            var userId = data.data[0].id;

            $http.get(url_path + '/api/v1/skill/recommandation/verif/' + userId + "?skillId=" + skill_id)
              .success(function (data) {
                var taille = data.data.length;

                if (data.data.length != 0) {
                  Materialize.toast("Vous avez déjà recommandé "+ skill_nom, 1500, "red");
                }
                else {
                  $http.post(url_path + '/api/v1/skill/recommandation/' + $stateParams.userId + "?skillsId=" + skill_id + "&userCo=" + userId)
                    .success(function (data) {
                      Materialize.toast("Vous avez recommandé la compétence " + skill_nom, 1500, "green");

                      $http.get(url_path + '/api/v1/skill/recommandation/count/' + $stateParams.userId + '/0')
                        .success(function (data) {
                          console.log(data);
                          $scope.count = data.data;
                        })
                        .error(function (data) {
                          console.log(data);
                        })

                      $http.get(url_path + '/api/v1/skill/recommandation/count/' + $stateParams.userId + '/1')
                        .success(function (data) {
                          console.log(data);
                          $scope.countImprove = data.data;
                        })
                        .error(function (data) {
                          console.log(data);
                        })


                    })
                    .error(function (data) {
                      Materialize.toast("Une erreur est survenue veuillez réessayer ulterieurement", 1500, "red");
                      console.log(data);
                    })
                }
              })
              .error(function (data) {
                console.log(data);
              })

          })
      })
      .error(function (data) {
        console.log(data);
      })


  }


})
