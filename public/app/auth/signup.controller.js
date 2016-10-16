(function () {
    "use strict";

    angular
        .module('app')
        .controller('SignupController', SignUpController);

    SignUpController.$inject = ['authService', '$state', 'Notification'];

    function SignUpController(authService, $state, Notification) {
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
                    Notification.success('Registration successful!');
                    $state.go('auth');
                } else {
                    Notification.warning('Something goes wrong.');
                }
            });
        }

    }
})();