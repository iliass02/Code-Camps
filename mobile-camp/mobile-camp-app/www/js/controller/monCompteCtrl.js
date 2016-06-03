app
  .controller('MonCompteCtrl', function($scope, $http, $location, $stateParams, $mdDialog, $state, $ionicHistory) {
    console.log("Mon compte Ctrl");

    $scope.userId = $stateParams.userId;

    $scope.colorUrl = $stateParams.colorName;



    $http.get(url_path+'/api/v1/account/'+$scope.userId)
      .success(function (data) {
        $scope.login = data.userInfo[0].login;
      })
      .error(function (err) {
        console.log(err);
      })

    $http.get(url_path+'/api/v1/wishList/'+$scope.userId)
      .success(function (data) {
        $scope.users = data.data;
      })
      .error(function (err) {
        console.log(err);
      })

    $http.get(url_path + '/api/v1/account/' + $stateParams.userId)
      .success(function(data) {
        console.log(data)
        $scope.nom = data.userInfo[0].nom;
        $scope.prenom = data.userInfo[0].prenom;
        $scope.name = $scope.nom + " " + $scope.prenom
        $scope.login = data.userInfo[0].login
        $scope.email = data.userInfo[0].login + "@etna-alternance.net"
        $scope.nomTerms = data.userInfo[0].nom_terms;
        $scope.promo = data.userInfo[0].promo;
        $scope.skillsMaster = data.userSkillsM;
        $scope.skills = data.userSkills;
        $scope.phone = data.userInfo[0].telephone;
      })
      .error(function(data) {
        console.log(data);
      });


      $scope.chooseSkill = function(ev) {

        var confirm = $mdDialog.confirm()
          .title('Compétences maîtrisées ou à améliorer ?')
          .textContent('Choisissez le type de compétence que vous souhaitez ajouter')
          .targetEvent(ev)
          .ok('A améliorer !')
          .cancel('Maîtrisées !');

        $mdDialog.show(confirm).then(function() {
          console.log("A améliorer");
          $state.go("addSkills", {improve:1, userId: $stateParams.userId, colorName: $scope.colorUrl});
        }, function() {
          console.log("Maîtrisée");
          $state.go("addSkills", {improve:0, userId: $stateParams.userId, colorName: $scope.colorUrl});
        });
      };

      $scope.switchSkill = function(ev) {

        var confirm = $mdDialog.confirm()
          .title('Compétences maîtrisées ou à améliorer ?')
          .textContent('Choisissez le type de compétence que vous souhaitez passer à \'améliorer / maîtriser\'')
          .targetEvent(ev)
          .ok('A améliorer !')
          .cancel('Maîtrisées !', 'red');
        $mdDialog.show(confirm).then(function() {
          console.log("A améliorer");
          if ($scope.skills.length) {
            $state.go("switchSkills", {userId: $stateParams.userId, improve:1, colorName: $scope.colorUrl});
          } else {
            Materialize.toast("Désolé, vous avez aucune compétence de ce type", 1500, "red");
          }
        }, function() {
          console.log("Maîtrisée");
          if ($scope.skillsMaster.length) {
            $state.go("switchSkills", {userId: $stateParams.userId, improve:0, colorName: $scope.colorUrl});
          } else {
            Materialize.toast("Désolé, vous avez aucune compétence de ce type", 1500, "red");
          }
        });
      };

      $scope.delSkill = function (skill) {

        console.log(skill.skillUserId);

        $http.delete(url_path + '/api/v1/account/delSkill?skillId='+skill.skillUserId)
        .success(function(data) {
            Materialize.toast("La compétence : " + skill.nom + " a bien été supprimée", 1500, "green");
            console.log(data);
        })
        .error(function(data) {
            Materialize.toast("Une erreur est survenue veuillez réessayer ulterieurement", 1500, "red");
            console.log(data);
        });
      }

      $scope.deco = function(ev) {

        var confirm = $mdDialog.confirm()
          .title('Deconnexion ?!')
          .textContent('Souhaitez-vous vous déconnecter')
          .targetEvent(ev)
          .ok('Deconnexion !')
          .cancel('Non', 'red');

        $mdDialog.show(confirm).then(function() {
         $http.delete("https://auth.etna-alternance.net/identity")
          .success(function(data) {
            Materialize.toast("À la prochaine " + $scope.prenom + " !", 1500, "green");
            console.log("deconnexion");
            $location.path("/signin");
          })
          .error(function (data) {
            Materialize.toast("Une erreur est survenue veuillez réessayer ulterieurement", 1500, "red");
            console.log(data);
          })
        });
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
