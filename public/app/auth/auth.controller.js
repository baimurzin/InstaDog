(function () {
    "use strict";

    angular
        .module('app.auth')
        .controller('AuthController', AuthController);

    AuthController.$inject = ['$auth', '$state'];

    function AuthController($auth, $state) {

        var vm = this;

        vm.login = login;


        function login() {
            var credentials = {
                email: vm.email,
                password: vm.password
            };

            $auth.login(credentials).then(function (data) {

                // If login is successful, redirect to the users state
                $state.go('users', {});
            });
        }
    }
})();