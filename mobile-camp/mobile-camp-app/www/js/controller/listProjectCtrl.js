app
  .controller('ListProjectCtrl', function($scope, $http, $location, $stateParams, $window, $ionicLoading) {

    $scope.colorUrl = $stateParams.colorName;


    $ionicLoading.show({
      template: '<ion-spinner icon="android"></ion-spinner>'
    });

  $http.get(url_path + "/api/v1/account/" + $stateParams.userId)
  .success(function(data) {
    var login = data.userInfo[0].login;
    var terms = data.userInfo[0].terms_id;

    $http.get("https://prepintra-api.etna-alternance.net/terms/"+ terms +"/students/"+ login +"/marks")
      .success(function(data) {

        $ionicLoading.hide();
        $scope.datas = data;
        $scope.getGroup = function(session_id, activity_type, activity_id) {
          if (!session_id || !activity_id || !activity_type) {
            console.log("Manque des infos");
          }
          else {
            $http.get("https://prepintra-api.etna-alternance.net/sessions/" + session_id + "/" + activity_type + "/" + activity_id + "/groups")
            .success(function(data2) {
              console.log(data2)
              $scope.members = data2.members;
              $ionicLoading.hide();
            })
            .error(function(data2) {
              console.log(data2)
              $ionicLoading.hide();
            })
          }

        }
      })
      .error(function(data) {
        console.log(data);
        $ionicLoading.hide();
      })
    })
  .error(function(data) {
    console.log(data)
    $ionicLoading.hide();
  })

    $scope.goBack = function () {
      $window.history.back();
    }

  });
