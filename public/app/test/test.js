(function () {
    "use strict";

    angular.module('app.test', []);

    angular
        .module('app.test')
        .controller('TestController', TestController);

    TestController.$inject = ['$http', 'authService', 'Notification'];

    function TestController($http, authService, Notification) {

        var vm = this;

        vm.users;
        vm.error;

        vm.getUsers = getUsers;
        vm.logout = logout;

        function getUsers() {
            Notification.primary('Primary notification');
            $http.get('api/authenticate')
                .success(function (users) {
                    vm.users = users;
                })
                .error(function (err) {
                    vm.error = err;
                });
        }

        function logout() {
            authService.logout();
        }
    }

})();