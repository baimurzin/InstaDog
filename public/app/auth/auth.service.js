(function () {
    "use strict";

    angular
        .module('app')
        .service('authService', authService);

    authService.$inject = ['$auth', '$state', '$http', '$rootScope'];

    function authService($auth, $state, $http, $rootScope) {
        var vm = this;

        vm.loginError = false;
        vm.loginErrorText;

        return {
            login: login,
            logout: logout
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

        function logout() {
            $auth.logout().then(function () {
                localStorage.removeItem('user');
                $rootScope.authenticated = false;
                $rootScope.currentUser = null;
                $state.go('auth');
            });
        }

    }
})();