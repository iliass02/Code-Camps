app
  .controller('TinderViewCtrl', function($scope, $http, $stateParams, $location, $ionicNavBarDelegate) {

    var userTinder = Number($stateParams.userTinder);
    var userId = Number($stateParams.userId);
    $scope.colorUrl = $stateParams.colorName;




    $scope.searchUsers = function (search) { 
      $http.get(url_path+'/api/v1/users/search?recherche='+search) 
      .success(function (data) { 
        console.log(data); 
      }) 
      .error(function (data, status) { 
        console.log(data);  
      })
    }


    $http.get(url_path+'/api/v1/account/'+userId)
      .success(function (data) {
        var term = data.userInfo[0].terms_id;
        $scope.login = data.userInfo[0].login;
        $scope.getTinder(term, userTinder, userId);
      })
      .error(function (data) {
        console.log(data);
      })


    $scope.getTinder = function (term, userTinder, userId) {
      $http.get(url_path+'/api/v1/info/user/'+userId+'/term/'+term+'/userTinder/'+userTinder)
        .success(function (data) {
          $scope.userinfos = data.data;
          /*        if ($scope.userinfos.length == 0) {
           console.log("vide");
           }*/
        })
        .error(function (data, status) {
          console.log(data);
          //case if the user info display is same of user of apps
          if (status == 400) {
            userTinder = userTinder+1;
            console.log(userTinder);
            $location.path('/tinderView/'+userId+'/'+userTinder+"/"+$scope.colorUrl);
          }
        })
    }


    $http.get(url_path+'/api/v1/skills/user/'+userTinder)
      .success(function (data) {
        $scope.skills = data.data;
      })
      .error(function (data) {
        console.log(data);
      })

    $http.get(url_path+'/api/v1/skills-improve/user/'+userTinder)
      .success(function (data) {
        $scope.skillsImprove = data.data;
      })
      .error(function (data) {
        console.log(data);
      })

    $scope.like = function() {

      var data = {
        userLikeId: userTinder
      }

      $http.post(url_path+'/api/v1/wishlist/'+userId, data)
        .success(function (data) {
          userTinder = userTinder+1;
          $location.path('/tinderView/'+userId+'/'+userTinder+"/"+$scope.colorUrl);
        })
        .error(function (data) {
          console.log(data);
        })
    }

    $scope.dislike = function () {
      userTinder = userTinder+1;
      $location.path('/tinderView/'+userId+'/'+userTinder+"/"+$scope.colorUrl);
    }

    $scope.refresh = function() {


      $http.get(url_path+'/api/v1/users')
        .success(function (data) {
          $location.path('/tinderView/'+userId+'/'+data.data[0].id+"/"+$scope.colorUrl);
          console.log('location');
        })
        .error(function (data) {
          console.log(data);
          console.log('location');
        })
    }

    $scope.goBack = function(login, colorUrl) {
      $location.path('/current-activity/'+login+"/"+colorUrl);
    }


  })
