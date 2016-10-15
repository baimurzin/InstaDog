(function () {
    "use strict";

    angular.module('app.test', []);

    angular
        .module('app.test')
        .controller('TestController', TestController);

    TestController.$inject = ['$http', 'authService'];

    function TestController($http, authService) {


        var vm = this;

        vm.users;
        vm.error;

        vm.getUsers = getUsers;
        vm.logout = logout;

        function getUsers() {
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