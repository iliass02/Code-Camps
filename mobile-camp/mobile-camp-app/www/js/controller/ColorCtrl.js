app
  .controller('ColorCtrl', function($scope, $stateParams, $http, $location) {

    $scope.colorUrl = $stateParams.colorName;

    var login = $stateParams.login;

    $scope.choiceColor = function(color) {
      if (color == null) {
        Materialize.toast("Veuillez choisir un thème", 1500, "red");
      } else {
        $http.get(url_path+"/api/v1/user/updateColor/"+login+"/"+color)
          .success(function(data) {
            console.log(data);
            $location.path("/current-activity/"+login+"/"+color)
          })
          .error(function(err) {
            console.log(err);


          });
      }
    }



  })


  .directive("toggleClass", function() {
    return {
      restrict: 'A',
      link: function(scope, element) {
        element.addClass(scope.color);
      },
      scope: {
        color: '='
      },
      controller: 'ColorCtrl'
    }
  });




