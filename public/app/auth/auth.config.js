(function () {
    "use strict";
    angular
        .module('app.auth')
        .config(authConfig);


    function authConfig($stateProvider, $urlRouterProvider, $authProvider) {

        $authProvider.loginUrl = '/api/authenticate';
        $urlRouterProvider.otherwise('/auth');

        $stateProvider
            .state('auth', {
                url: '/auth',
                templateUrl: '../app/views/auth/authView.html',
                controller: 'AuthController as auth'
            })
            .state('users', {
                url: '/users',
                templateUrl: '../views/test/usersView.html',
                controller: 'UserController as user'
            })
    }
})();