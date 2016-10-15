(function () {
    "use strict";

    angular
        .module('app.auth')
        .controller('AuthController', AuthController);

    AuthController.$inject = ['authService'];

    function AuthController(authService) {
        var vm = this;

        vm.login = login;
        vm.logout = logout;

        function login() {
            authService.login({
                email: vm.email,
                password: vm.password
            });
        }

        function logout() {
            authService.logout();
        }
    }

})();