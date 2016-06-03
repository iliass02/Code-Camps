app

.controller('ProjectDetailCtrl', function ($scope, $http, $location, $stateParams, $ionicLoading, $window, $mdDialog) {

  var login = $stateParams.login;
  $scope.login = $stateParams.login;

  $scope.colorUrl = $stateParams.colorName;

  console.log('Project Detail Ctrl');

  var session = $stateParams.session;
  var projectId = $stateParams.projectId;


  $ionicLoading.show({
    template: '<ion-spinner icon="android"></ion-spinner>'
  });

  $scope.addMembersView = function() {
    $location.path("/add-members/"+projectId+"/"+session+"/"+login)
  }

  $http.get("https://prepintra-api.etna-alternance.net/sessions/"+session+"/project/"+projectId)
    .success(function (data) {
      $scope.project = data;
    })
    .error(function (data) {
      console.log(data);
    })
    .finally(function() {
      $ionicLoading.hide();
      $scope.chargement = true;
    });




  $http.get("https://prepintra-api.etna-alternance.net/sessions/"+session+"/project/"+projectId+"/mygroup")
    .success(function (data) {
      $scope.membreInscrit = true;
      $scope.groupId = data.id;
      $scope.nomLeader = data.leader.lastname;
      $scope.prenomLeader = data.leader.firstname;
      $scope.loginLeader = data.leader.login;
      $scope.membres = data.members;
      if ($scope.groupId > 0) {
        $scope.ajouterMembreButton = true;
      }

      console.log($scope.loginLeader);
      if ($scope.groupId > 0 && $scope.loginLeader == login ) {
        $scope.supprimerGroupeButton = true;
      }
      var log = [];
      angular.forEach(data.members, function(membre) {
        console.log(membre.login);
        if (membre.login == login) {
          if (membre.validation == 0 && login != $scope.loginLeader) {
            console.log(membre.validation);
            $scope.validationDiv = true;
          }
        }
      }, log);


    })
    .error(function (err) {
      console.log(err);
      $scope.membreInscrit = false;
    });



  $scope.modalDelete = function(ev, groupId) {

    var confirm = $mdDialog.confirm()
      .title('Quoi faire ?!')
      .textContent('Êtes-vous sûr de vouloir supprimer le groupe')
      .targetEvent(ev)
      .ok('Oui')
      .cancel('Non');
    $mdDialog.show(confirm).then(function() {
      console.log("A améliorer");
      $ionicLoading.show({
        template: '<ion-spinner icon="android"></ion-spinner>'
      });
      $scope.deleteGroup(groupId);
    }, function() {
      console.log("Maîtrisée");
    });
  };



  $scope.deleteGroup = function (groupId) {
    $http.delete("https://prepintra-api.etna-alternance.net/sessions/"+session+"/project/"+projectId+"/group/"+groupId)
      .success(function(data) {
        console.log(data);
        $ionicLoading.hide();
        Materialize.toast("Vous avez supprimer le groupe", 1500, "green");

        $scope.membres = "";
        $scope.supprimerGroupeButton = false;
        $scope.membreInscrit = false;
        $scope.ajouterMembreButton = false;

      })
      .error(function (err, status) {
        $ionicLoading.hide();
        console.log(err);
        if (status == 400) {
          Materialize.toast("Ce membre n'est pas dans votre groupe", 1500, "red");
        } else if (status == 500) {
          Materialize.toast("Vous avez supprimer le groupe", 1500, "green");
          $scope.membres = "";
          $scope.ajouterMembreButton = false;
          $scope.supprimerGroupeButton = false;
          $scope.membreInscrit = false;
        }
      })
  }




  $scope.createGroup = function () {
    $http.post("https://prepintra-api.etna-alternance.net/sessions/"+session+"/project/"+projectId+"/group")
      .success(function(data) {
        console.log(data);

        $http.get("https://prepintra-api.etna-alternance.net/sessions/"+session+"/project/"+projectId+"/mygroup")
          .success(function (data) {
            $scope.membreInscrit = true;
            $scope.groupId = data.id;
            $scope.nomLeader = data.leader.lastname;
            $scope.prenomLeader = data.leader.firstname;
            $scope.loginLeader = data.leader.login;
            $scope.membres = data.members;

            if ($scope.groupId > 0) {
              $scope.ajouterMembreButton = true;
            }

            if ($scope.groupId > 0 && $scope.loginLeader == login ) {
              $scope.supprimerGroupeButton = true;
            }
            var log = [];
            angular.forEach(data.members, function(membre) {
              console.log(membre.login);
              if (membre.login == login) {
                if (membre.validation == 0 && login != $scope.loginLeader) {
                  console.log(membre.validation);
                  $scope.validationDiv = true;
                }
              }
            }, log);


          })
          .error(function (err) {
            console.log(err);
            $scope.errorMyGroup = false;
          });
      })
      .error(function (err, status) {
        console.log(err);

        if (status == 400) {
          Materialize.toast("Vous avez déjà créer un groupe", 1500, "red");

        }
      })
  }





  $scope.validationGroup = function (groupId, valider) {



    $http.put("https://prepintra-api.etna-alternance.net/sessions/"+session+"/project/"+projectId+"/group/"+groupId, {'validation':valider} )
      .success(function(data) {
        console.log(data);
        $scope.validationDiv = false;
        if(valider == 0) {
          Materialize.toast("Vous avez refusé cette demande", 1500, "red");
          $scope.membres = "";
        } else {
          Materialize.toast("Vous avez accepté cette demande", 1500, "green");
        }


      })
      .error(function (err, status) {
        console.log(err);
        if (status == 400) {

        } else if (status == 500) {
          $scope.validationDiv = false;
          if(valider == 0) {
            Materialize.toast("Vous avez refusé cette demande", 1500, "red");
            $scope.membres = "";
          } else {
            Materialize.toast("Vous avez accepté cette demande", 1500, "green");
          }

        }
      })
  }



  $scope.goBack = function () {
    $location.path('/current-activity/'+login+"/"+$scope.colorUrl)

  }


});
