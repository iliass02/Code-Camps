app
  .controller("SkillsImprove", function ($scope, $http, $state, $stateParams, $location, $ionicNavBarDelegate, $ionicHistory) {

    $ionicNavBarDelegate.showBackButton(false);

    //$window.location.reload(true);
    $scope.colorUrl = $stateParams.colorName;

    $http.get(url_path+'/api/v1/skills')
      .success(function (data) {
        $scope.skillsImprove = data.data;
      })
      .error(function (data) {
        console.log(data);
      })


    // list dynamic checkboxes
    $scope.roles2 = [];
    $scope.user2 = {
      roles2: []
    };

    $scope.test2 = function () {
      console.log($scope.user2.roles2);
    }

    $scope.checkAll = function() {
      $scope.user2.roles2 = angular.copy($scope.roles2);
    };
    $scope.uncheckAll = function() {
      $scope.user2.roles2 = [];
    };
    $scope.checkFirst = function() {
      $scope.user2.roles2.splice(0, $scope.user2.roles2.length);
      $scope.user2.roles2.push('guest');
    };


    //get all user for redirect to TinderView
    $http.get(url_path+'/api/v1/users')
      .success(function (data) {
        $scope.tinderId = data.data[0].id;
      })
      .error(function (data) {
        console.log(data);
      })


    $scope.newSkillsImprove = function(skillsImprove) {

      var data = {
        skillsId: skillsImprove
      }

      $http.post(url_path+'/api/v1/skills-improve/'+$stateParams.userId, data)
        .success(function (data) {
          Materialize.toast("Ajout des comptétences réussi", 1500, "green");
          //$location.path('/tinderView/'+$stateParams.userId+'/'+$scope.tinderId)
          $location.path('/current-activity/'+$stateParams.login+'/'+$scope.colorUrl);
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
