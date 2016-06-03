/**
 * Created by Faouzi on 06/05/2016.
 */

app
  .controller('ConnexionCtrl', function($scope, $http, $location, $ionicLoading, $state) {



    $scope.signin = function(login, mdp) {

      $ionicLoading.show({
        template: '<ion-spinner icon="android"></ion-spinner>'
      });

      if(!login || !mdp) {
        Materialize.toast("Erreur : tous les champs sont requis", 1500, "red");
        $ionicLoading.hide();
      } else {

        //Call web service
        var data = {
          'login': login,
          'mdp': mdp };



        $http.post(url_path+'/api/v1/signin', data)
          .success(function(data) {

            var params = {
              login : login,
              password: mdp
            }


            $http.get(url_path+'/api/v1/user/color/'+login)
              .success(function (data) {
                $scope.colorUrl = data.data[0].color;
              })
              .error(function (err) {
                console.log(err);
              })

            $http.post('https://auth.etna-alternance.net/login', params)
              .success(function (data2) {
                Materialize.toast("Connexion réussie", 1500, "green");
                console.log(data.data[0].id);
                $location.path("/current-activity/"+login+"/"+$scope.colorUrl);
                $ionicLoading.hide();
              })
              .error(function (err, status) {
                $ionicLoading.hide();
                if (status == 400) {

                  $http.get('https://auth.etna-alternance.net/login', params)
                    .success(function (data3) {
                      Materialize.toast("Connexion réussie", 1500, "green");
                      console.log(data.data[0].id);
                      $location.path("/current-activity/"+login+"/"+$scope.colorUrl);
                    })
                    .error(function (err) {
                      console.log(err);
                    })

                }
              })

          })
          .error(function(data, status) {
            $ionicLoading.hide();
            if (status == 500) {
              Materialize.toast("Erreur : veuillez réessayer ultérieurement", 1500, "red");
            } else if (status == 401) {
              Materialize.toast("Erreur : L'utilisateur n'existe pas, veuillez vous inscrire", 1500, "red");
            } else if (status == 400) {
              Materialize.toast("Erreur : Mot de passe incorrect", 1500, "red");
            }
          })
      }

    }

  });

