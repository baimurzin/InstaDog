(function () {
    "use strict";

    angular.module('app.test', []);

    angular
        .module('app.test')
        .controller('TestController', TestController);

    TestController.$inject = ['$http'];

    function TestController($http) {


        var vm = this;

        vm.users;
        vm.error;

        vm.getUsers = getUsers;

        function getUsers() {
            $http.get('api/authenticate')
                .success(function (users) {
                    vm.users = users;
                })
                .error(function (err) {
                    vm.error = err;
                });
        }
    }

})();