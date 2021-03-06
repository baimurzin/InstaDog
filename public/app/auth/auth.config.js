(function () {
    "use strict";
    angular
        .module('app.auth')
        .config(authConfig);

    authConfig.$inject = ['$stateProvider', '$urlRouterProvider', '$authProvider', '$httpProvider', '$provide'];

    function authConfig($stateProvider, $urlRouterProvider, $authProvider, $httpProvider, $provide) {


        function redirectWhenLoggedOut($q, $injector) {

            return {

                responseError: function (rejection) {

                    if (rejection.status == 401) {
                        $state.go('auth');
                        return $q.reject(rejection);
                    }

                    // Need to use $injector.get to bring in $state or else we get
                    // a circular dependency error
                    var $state = $injector.get('$state');

                    // Instead of checking for a status code of 400 which might be used
                    // for other reasons in Laravel, we check for the specific rejection
                    // reasons to tell us if we need to redirect to the login state
                    var rejectionReasons = ['token_not_provided', 'token_expired', 'token_absent', 'token_invalid'];

                    // Loop through each rejection reason and redirect to the login
                    // state if one is encountered
                    angular.forEach(rejectionReasons, function (value, key) {

                        if (rejection.data.error === value) {

                            // If we get a rejection corresponding to one of the reasons
                            // in our array, we know we need to authenticate the user so
                            // we can remove the current user from local storage
                            localStorage.removeItem('user');

                            // Send the user to the auth state so they can login
                            $state.go('auth');
                        }
                    });

                    return $q.reject(rejection);
                }
            }
        }


        // Setup for the $httpInterceptor
        $provide.factory('redirectWhenLoggedOut', redirectWhenLoggedOut);

        // Push the new factory onto the $http interceptor array
        $httpProvider.interceptors.push('redirectWhenLoggedOut');


        $authProvider.loginUrl = '/api/authenticate';
        $authProvider.signupUrl = '/api/signup';
        $urlRouterProvider.otherwise('/auth');

        $stateProvider
            .state('auth', {
                url: '/auth',
                templateUrl: '../app/views/auth/authView.html',
                controller: 'AuthController as auth'
            })
            .state('users', {
                url: '/users',
                templateUrl: '../app/views/test/usersView.html',
                controller: 'TestController as user'
            })
            .state('dashboard', {
                url: '/dashboard',
                templateUrl: '../app/views/dashboard/main.html',
                controller: 'AccountController as account'
            })
            .state('signup', {
                url: '/signup',
                templateUrl: '../app/views/auth/signUpView.html',
                controller: 'SignupController as auth'
            })
    }

})();