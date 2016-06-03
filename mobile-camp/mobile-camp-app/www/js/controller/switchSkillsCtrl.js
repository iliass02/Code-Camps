app
  .controller('SwitchSkillsCtrl', function($scope, $http, $location, $stateParams, $mdDialog, $state, $window) {
    console.log("Switch skills Ctrl");

    // Checkbox - POST

    $scope.roles = [];
    $scope.user = {
      roles: []
    };

    $scope.test = function() {
      console.log($scope.user.roles);
    }

    $http.get(url_path + '/api/v1/account/' + $stateParams.userId)
      .success(function(data) {
        if ($stateParams.improve == 0) {
          $scope.status = "à améliorer";
          $scope.skills = data.userSkillsM;
        } else if ($stateParams.improve == 1) {
          $scope.status = "à maîtriser";
          $scope.skills = data.userSkills;
        } else {
          $scope.status = "erreur...";
        }
      })
      .error(function(data) {
        console.log("error : " + data)
      })

    $scope.changeStatusSkills = function(skills) {

      if (!skills.length) {
        Materialize.toast("Désolé, aucune compétence n'a été sélectionnée", 1500, "red");
      } else {
        if ($stateParams.improve == "1") {
          var dataToApi = {
            userId: $stateParams.userId,
            skillsId: skills,
            status: 0
          }

          console.log(dataToApi);

          $http.post(url_path + "/api/v1/skills-status", dataToApi)
            .success(function (){
              Materialize.toast("Le status est bien passé à \'maîtriser\'", 1500, "green");
            })
            .error(function (err){
              Materialize.toast("Une erreur est survenue veulliez réessayer ulterieurement", 1500, "red");
            });
          } else {
            var dataToApi = {
              userId: $stateParams.userId,
              skillsId: skills,
              status: 1
            }

            $http.post(url_path + "/api/v1/skills-status", dataToApi)
              .success(function (){
                Materialize.toast("Le status est bien passé à \'maîtriser\'", 1500, "green");
              })
              .error(function (err){
                Materialize.toast("Une erreur est survenue veulliez réessayer ulterieurement", 1500, "red");
              });
          }
        }
        $location.path('/account/' + $stateParams.userId+'/'+$scope.colorUrl);
      }

    $scope.goBack = function () {
      $window.history.back();
    }
  });
