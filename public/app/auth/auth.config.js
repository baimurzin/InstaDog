(function () {
    "use strict";
    angular
        .module('app.auth')
        .config(authConfig);


    function authConfig($stateProvider, $urlRouterProvider, $authProvider) {

        $authProvider.loginUrl = '/api/authenticate';
        $urlRouterProvider.otherwise('/');

        $stateProvider
            .state('auth', {
                url: '/auth',
                templateUrl: '../app/views/auth/authView.html',
                resolve: {
                    skipIfAuthenticated: _skipIfAuthenticated
                },
                controller: 'AuthController as auth'
            })
            .state('users', {
                url: '/users',
                templateUrl: '../app/views/test/usersView.html',
                resolve: {
                    redirectIfNotAuthenticated: _redirectIfNotAuthenticated
                },
                controller: 'TestController as user'
            })
            .state('dashboard', {
                url: '/dashboard',
                templateUrl: '../app/views/dashboard/main.html',
                controller: 'AccountController as account'
            })
    }

    function _skipIfAuthenticated($q, $state, $auth) {
        debugger;
        var defer = $q.defer();
        if ($auth.authenticate()) {
            console.log(1);
            defer.reject();
        } else {
            console.log(2);
            defer.resolve();
        }
        return defer.promise();
    }

    function _redirectIfNotAuthenticated($q, $state, $auth) {
        console.log(2);
        var defer = $q.defer();
        if($auth.authenticate()) {
            defer.resolve();
        } else {
            $timeout(function () {
                $state.go('auth');
            });
            defer.reject();
        }
        return defer.promise;
    }
})();