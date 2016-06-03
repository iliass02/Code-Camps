app
  .controller('AddSkillsCtrl', function($scope, $http, $location, $stateParams, $mdDialog, $state, $window) {
    console.log("Add skills Ctrl");


    $scope.colorUrl = $stateParams.colorName;


    $http.get(url_path + '/api/v1/skills/')
      .success(function(allSkillsDb) {
        var allSkills  = allSkillsDb.data;
        var finalDataSkill = angular.copy(allSkills);


    $scope.goBack = function() {
      $window.history.back()
    }

        if ($stateParams.improve == "0") {
          $http.get(url_path + '/api/v1/skills/user/' + $stateParams.userId)
            .success(function(skillsUser) {

              var skillsMasteredUser = skillsUser.data;
              $scope.skills = loadJsonSkill(allSkills, skillsMasteredUser, finalDataSkill);
            })
            .error(function(data) {
              console.log("error : " + data);
            })
        } else if ($stateParams.improve == "1") {
          $http.get(url_path + '/api/v1/skills-improve/user/' + $stateParams.userId)
            .success(function(skillsUser) {

              var skillsImprovedUser = skillsUser.data;
              $scope.skills = loadJsonSkill(allSkills, skillsImprovedUser, finalDataSkill);
            })
            .error(function(data) {
              console.log("error : " + data);
            })
        }
      })
      .error(function(data) {
        console.log("error : " + data);
      })

    function loadJsonSkill(tabSkillData, tabSkillUser, finalDataSkill) {

      var jsonSKill = [];

      for (i = 0; i < tabSkillData.length; i++) {
        for (j = 0; j < tabSkillUser.length; j++) {
          if (tabSkillData[i].nom == tabSkillUser[j].nom)
            console.log(delete finalDataSkill[i]);
        }
      }

      for (i = 0; i < finalDataSkill.length; i++) {
         if (finalDataSkill[i])
          jsonSKill.push(finalDataSkill[i]);
      }
      return jsonSKill;
    }

    // Checkbox - POST

    $scope.roles = [];
    $scope.user = {
      roles: []
    };

    $scope.test = function() {
      console.log($scope.user.roles);
    }

    $scope.newSkills = function(skills) {
      if ($stateParams.improve == "1") {

        var data = {
          skillsId: skills
        }

        console.log($stateParams.userId, skills);

        $http.post(url_path + '/api/v1/skills-improve/' + $stateParams.userId, data)
          .success(function (data) {
            Materialize.toast("Ajout des comptétences réussi", 1500, "green");
            $location.path('/account/' + $stateParams.userId+'/'+$scope.colorUrl);
          })
          .error(function (data, status) {
            if (status == 400) {
              Materialize.toast("Erreur : Veuillez choisir au moins une compétences", 1500, "red");
            } else {
              Materialize.toast("Erreur : Veuillez reessayer ulterieurement", 1500, "red");
            }
          })
      } else if ($stateParams.improve == "0") {

        var data = {
          skillsId: skills
        }

        $http.post(url_path + '/api/v1/skills/' + $stateParams.userId, data)
          .success(function (data) {
            Materialize.toast("Ajout des comptétences réussi", 1500, "green");
            $location.path('/account/' + $stateParams.userId+'/'+$scope.colorUrl);
          })
          .error(function (data, status) {
            if (status == 400) {
              Materialize.toast("Erreur: Veuillez choisir au moins une compétences", 1500, "red");
            } else {
              Materialize.toast("Erreur: Veuillez reessayer ulterieurement", 1500, "red");
            }
          })
      }
      $location.path('/account/' + $stateParams.userId+'/'+$scope.colorUrl);
    }
  });
