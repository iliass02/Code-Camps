app

  .controller('AddMembersCtrl', function ($scope, $http, $location, $stateParams, $ionicModal, $ionicLoading, $window) {


    var loginSession = $stateParams.login
    var session = $stateParams.session;
    var projectId = $stateParams.projectId;


    $http.get(url_path+'/api/v1/user/login/'+$stateParams.login)
      .success(function (data) {
        $scope.userId = data.data[0].id;

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

    $http.get("https://prepintra-api.etna-alternance.net/sessions/"+session+"/project/"+projectId)
      .success(function (data) {
        $scope.project = data;
      })
      .error(function (data) {
        console.log(data);
      })
      .finally(function() {
        $scope.chargement = true;
        $ionicLoading.hide();
      });



    $http.get("https://prepintra-api.etna-alternance.net/sessions/"+session+"/project/"+projectId+"/mygroup")
      .success(function (data) {
        $scope.membreInscrit = true;
        $scope.groupId = data.id;
        $scope.nomLeader = data.leader.lastname;
        $scope.prenomLeader = data.leader.firstname;
        $scope.loginLeader = data.leader.login;
        $scope.membres = data.members;
      })
      .error(function (err) {
        console.log(err);
        $scope.membreInscrit = false;
      });



    $scope.deleteMembers = function (groupId, login) {
      $http.put("https://prepintra-api.etna-alternance.net/sessions/"+session+"/project/"+projectId+"/group/"+groupId+"/removeMember", {'student': login} )
        .success(function(data) {
          console.log(data);
          Materialize.toast("Vous avez supprimer ce membre de votre groupe", 1500, "green");
          $location.path("/project-detail/"+projectId+"/"+session+"/"+loginSession+"/"+$scope.colorUrl)

        })
        .error(function (err, status) {
          console.log(err);
          if (status == 400) {
            Materialize.toast("Ce membre n'est pas dans votre groupe", 1500, "red");
          } else if (status == 500) {
            $location.path("/project-detail/"+projectId+"/"+session+"/"+loginSession+"/"+$scope.colorUrl)
          }
        })
    }



    $scope.addMembers = function (groupId, login) {
      $http.post("https://prepintra-api.etna-alternance.net/sessions/" + session + "/project/" + projectId + "/group/" + groupId, {'student': login})
        .success(function (data) {
          console.log(data);
          Materialize.toast("Vous avez ajouter un membre", 1500, "green");
          $location.path("/project-detail/"+projectId+"/"+session+"/"+loginSession+"/"+$scope.colorUrl)

        })
        .error(function (err, status) {
          console.log(err);
          if (status == 400) {
            Materialize.toast("Ce membre est déjà dans un groupe", 1500, "red");
          } else if (status == 500) {
            $location.path("/project-detail/"+projectId+"/"+session+"/"+loginSession+"/"+$scope.colorUrl)
          }
        })
    }

    $scope.searchUsers = function (search) {

      if (search == "") {
        $scope.afficher = false;
      } else {
        $scope.afficher = true;
      }

      $http.get(url_path+'/api/v1/users/search?recherche='+search+"&term="+$scope.term)
        .success(function (data) {
          console.log(data);
          $scope.users = data.data;

        })
        .error(function (data, status) {
          console.log(data);
        })
    }

    $scope.goBack = function () {
      $window.history.back();
    }

  });
