(function () {
    "use strict";

    angular
        .module('app')
        .service('authService', authService);

    authService.$inject = ['$auth', '$state', '$http', '$rootScope', '$q'];

    function authService($auth, $state, $http, $rootScope, $q) {
        var vm = this;

        vm.loginError = false;
        vm.loginErrorText;

        return {
            login: login,
            logout: logout,
            signup: signup,
            checkUser: checkUser
        };


        function login(credentials) {

            $auth.login(credentials).then(function () {
                return $http.get('api/authenticate/user');
            }, function (error) {
                vm.loginError = true;
                vm.loginErrorText = error.data.error;
            }).then(function (response) {
                var user = JSON.stringify(response.data.user);
                localStorage.setItem('user', user);
                $rootScope.authenticated = true;
                $rootScope.currentUser = response.data.user;
                $state.go('users');
            })
        }

        function checkUser() {
            var defer = $q.defer();
            $http.get('api/authenticate/user')
                .success(function (response) {
                    var user = response.data.user;
                    var userStr = JSON.stringify(user);
                    localStorage.setItem('user', userStr);
                    $rootScope.authenticated = true;
                    $rootScope.currentUser = user;
                    defer.resolve(user);
                })
                .error(function (error) {
                    localStorage.removeItem('user');
                    $rootScope.authenticated = false;
                    $rootScope.currentUser = null;
                    defer.reject(error.data.error);
                });
            return defer.promise;
        }

        function logout() {
            $auth.logout().then(function () {
                localStorage.removeItem('user');
                $rootScope.authenticated = false;
                $rootScope.currentUser = null;
                $state.go('auth');
            });
        }

        function signup(user) {
            return $auth.signup(user);
        }

    }
})();