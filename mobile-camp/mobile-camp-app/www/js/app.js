// Ionic Starter App

// angular.module is a global place for creating, registering and retrieving Angular modules
// 'starter' is the name of this angular module example (also set in a <body> attribute in index.html)
// the 2nd parameter is an array of 'requires'
// 'starter.services' is found in services.js
// 'starter.controllers' is found in controllers.js
angular.module('starter', ['ionic', 'starter.controllers'])

.run(function($ionicPlatform) {
  $ionicPlatform.ready(function() {
    // Hide the accessory bar by default (remove this to show the accessory bar above the keyboard
    // for form inputs)
    if (window.cordova && window.cordova.plugins && window.cordova.plugins.Keyboard) {
      cordova.plugins.Keyboard.hideKeyboardAccessoryBar(true);
      cordova.plugins.Keyboard.disableScroll(true);

    }
    if (window.StatusBar) {
      // org.apache.cordova.statusbar required
      StatusBar.styleDefault();
    }
  });
})

.config(function($stateProvider, $urlRouterProvider, $httpProvider, $ionicConfigProvider) {

  $httpProvider.defaults.useXDomain = true;
  $httpProvider.defaults.withCredentials = true;
  delete $httpProvider.defaults.headers.common["X-Requested-With"];
  $httpProvider.defaults.headers.common["Accept"] = "application/json";
  $httpProvider.defaults.headers.common["Content-Type"] = "application/json";

  // Ionic uses AngularUI Router which uses the concept of states
  // Learn more here: https://github.com/angular-ui/ui-router
  // Set up the various states which the app can be in.
  // Each state's controller can be found in controllers.js
  $stateProvider

  .state('inscription', {
    url: '/signup',
    views: {
      '': {
        templateUrl: 'templates/inscription.html',
        controller: 'InscriptionCtrl'
      }
    }
  })
    .state('connexion', {
      url: '/signin',
      views: {
        '': {
          templateUrl: 'templates/connexion.html',
          controller: 'ConnexionCtrl'
        }
      }
    })

  .state('listProject', {
      url: '/listProject/:userId/:colorName',
      views: {
        '': {
          templateUrl: 'templates/listProject.html',
          controller: 'ListProjectCtrl'
        }
      }
  })
    .state('tinderView', {
      url: '/tinderView/:userId/:userTinder/:colorName',
      views: {
        '': {
          templateUrl: 'templates/tinderView.html',
          controller: 'TinderViewCtrl'
        }
      }
    })

    .state('skills', {
      url: '/skills/:userId/:login',
      views: {
        '': {
          templateUrl: 'templates/skills.html',
          controller: 'SkillsCtrl'
        }
      }
    })

    .state('skillsImprove', {
      url: '/skillsImprove/:userId/:login/:colorName',
      views: {
        '': {
          templateUrl: 'templates/skillsImprove.html',
          controller: 'SkillsImprove'
        }
      }
    })

    .state('search', {
        url: '/search/:userId/:colorName',
       views: {
          '': {
            templateUrl: 'templates/searchView.html',
            controller: 'SearchCtrl'
        }
      }
    })

    .state('monCompte', {
      url: '/account/:userId/:colorName',
      views: {
        '': {
          templateUrl: 'templates/monCompte.html',
          controller: 'MonCompteCtrl'
        }
      }
    })

    .state('addSkills', {
      url: '/addSkills/:userId/:improve/:colorName',
      views: {
        '': {
          templateUrl: 'templates/addSkills.html',
          controller: 'AddSkillsCtrl'
        }
      }
    })

    .state('switchSkills', {
      url: '/switchSkills/:userId/:improve/:colorName',
      views: {
        '': {
          templateUrl: 'templates/switchSkills.html',
          controller: 'SwitchSkillsCtrl'
        }
      }
    })

    .state('wishList', {
      url: '/wishlist/:userId/:colorName',
      views: {
        '': {
          templateUrl: 'templates/wishList.html',
          controller: 'WishListCtrl'
        }
      }
    })


    .state('accountViewer', {
      url: '/account/viewer/:userId/:colorName',
      views: {
        '': {
          templateUrl: 'templates/accountViewer.html',
          controller: 'AccountViewerCtrl'
        }
      }
    })

    .state('currentActivity', {
      url: '/current-activity/:login/:colorName',
      views: {
        '': {
          templateUrl: 'templates/currentActivity.html',
          controller: 'CurrentActivityCtrl'
        }
      }
    })

    .state('projectDetail', {
      url: '/project-detail/:projectId/:session/:login/:colorName',
      views: {
        '': {
          templateUrl: 'templates/projectDetail.html',
          controller: 'ProjectDetailCtrl'
        }
      }
    })

    .state('selectProject', {
      url: '/select-project/:login/:colorName',
      views: {
        '': {
          templateUrl: 'templates/selectProject.html',
          controller: 'SelectProjectCtrl'
        }
      }
    })

    .state('addMembers', {
      url: '/add-members/:projectId/:session/:login',
      views: {
        '': {
          templateUrl: 'templates/addMembers.html',
          controller: 'AddMembersCtrl'
        }
      }
    })

  .state('colorView', {
    url: '/color/:login/:colorName',
    views: {
      '': {
        templateUrl: 'templates/colorView.html',
        controller: 'ColorCtrl'
      }
    }
  })

    .state('chatUsers', {
      url: '/chat/:userIdChat/user/:userId/:colorName',
      views: {
        '': {
          templateUrl: 'templates/chatUsers.html',
          controller: 'ChatUsersCtrl'
        }
      }
    })

    .state('listChats', {
      url: '/chats/:userId/:colorName',
      views: {
        '': {
          templateUrl: 'templates/listChats.html',
          controller: 'ListChatsCtrl'
        }
      }
    });

  // if none of the above states are matched, use this as the fallback
  $urlRouterProvider.otherwise('/signin');



  //$ionicConfigProvider.tabs.position('bottom');

});
