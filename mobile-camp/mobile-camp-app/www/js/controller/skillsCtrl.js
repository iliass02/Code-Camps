app
.controller("SkillsCtrl", function ($scope, $state, $http, $stateParams, $location, $ionicNavBarDelegate) {

  $ionicNavBarDelegate.showBackButton(false);

  console.log($stateParams.login);

  $http.get(url_path+'/api/v1/skills')
    .success(function (data) {
      $scope.skills = data.data;
    })
    .error(function (data) {
      console.log(data);
    })


  // list dynamic checkboxes
  $scope.roles = [];
  $scope.user = {
    roles: []
  };

  $scope.test = function () {
    console.log($scope.user.roles);
  }

  $scope.checkAll = function() {
    $scope.user.roles = angular.copy($scope.roles);
  };
  $scope.uncheckAll = function() {
    $scope.user.roles = [];
  };
  $scope.checkFirst = function() {
    $scope.user.roles.splice(0, $scope.user.roles.length);
    $scope.user.roles.push('guest');
  };



  $scope.newSkills = function(skills) {

    var data = {
      skillsId: skills
    }

    $http.post(url_path+'/api/v1/skills/'+$stateParams.userId, data)
      .success(function (data) {
        $scope.colorUrl = 'teal lighten-2';
        Materialize.toast("Ajout des compétences réussi", 1500, "green");
/*        $location.path('/skillsImprove/'+$stateParams.userId)*/
        $location.path('/skillsImprove/'+$stateParams.userId+'/'+$stateParams.login+'/'+$scope.colorUrl)
      })
      .error(function (data, status) {
        if (status == 400) {
          Materialize.toast("Erreur: Veuillez choisir au moins une compétences", 1500, "red");
        } else {
          Materialize.toast("Erreur: Veuillez reessayer ulterieurement", 1500, "red");
        }
      })

  }

})
