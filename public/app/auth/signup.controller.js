(function () {
    "use strict";

    angular
        .module('app')
        .controller('SignupController', SignUpController);

    SignUpController.$inject = ['authService', '$state'];

    function SignUpController(authService, $state) {
        var vm = this;

        vm.signup = signup;

        function signup() {
            var user = {
                email: vm.email,
                password: vm.password,
                name: vm.name
            };

            authService.signup(user).catch(function (response) {
                if (response.status == 302) {
                    $state.go('auth');
                }
            });
        }

    }
})();