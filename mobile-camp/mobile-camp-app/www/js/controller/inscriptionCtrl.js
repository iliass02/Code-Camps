app
  .controller('InscriptionCtrl', function($scope, $http, $location, $state, $window) {
    console.log("Inscription Ctrl");

    $http.get(url_path+"/api/v1/terms")
      .success(function(data) {
        $scope.terms = data.data;
        console.log(data.data);

      })
      .error(function (err) {
        Materialize.toast("Erreur : veuillez réessayer ultérieurement", 1500, "red");
      })
      .finally(function() {

      });

    $scope.signup = function(nom, prenom, login, mdp, terms, telephone) {

      console.log(terms);

      if(!nom || !prenom || !login || !mdp || !terms || !telephone) {
        Materialize.toast("Erreur : tous les champs sont requis", 1500, "red");
      } else {

        telephone = telephone.toString();


        var etna = {
          login: login,
          password: mdp
        }
        

        $http.post('https://auth.etna-alternance.net/login', etna)
          .success(function (data) {
            console.log(data);
          })
          .error(function (err, status) {
            if (status == 400) {

              $http.get('https://auth.etna-alternance.net/login', etna)
                .success(function (data2) {
                  $scope.insert(nom, prenom, data2.login, mdp, terms, telephone);
                })
                .error(function (err) {
                  console.log(err);
                })

            }
          })

      }

    }


    $scope.insert = function(nom, prenom, login, mdp, terms, telephone) {


      //Call web service
      var data = {
        'nom': nom,
        'prenom': prenom,
        'login': login,
        'mdp': mdp,
        'terms': terms,
        'telephone': telephone};

      $http.post(url_path+'/api/v1/signup', data)
        .success(function(data) {
          Materialize.toast("Inscription réussi", 1500, "green");
          //$location.path('/skills/'+data.data.insertId);
          $state.go('skills', {userId: data.data.insertId, login: login});
        })
        .error(function(data, status) {
          if (status == 500) {
            Materialize.toast("Erreur : veuillez réessayer ultérieurement", 1500, "red");
          } else if (status == 401) {
            Materialize.toast("Erreur : L'utilisateurs existe déjà", 1500, "red");

          } else {
            Materialize.toast("Erreur", 1500, "red");
          }
        });
    }

    $scope.goBack = function () {
      $window.history.back();
    }

  });
