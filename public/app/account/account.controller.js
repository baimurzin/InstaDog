(function () {
    "use strict";

    angular
        .module('app.account')
        .controller('AccountController', AccountController);

    AccountController.$inject = ['$scope', '$q', 'accountFactory'];

    function AccountController($scope, $q, accountFactory) {

        var vm = this;

        vm.loadingAccounts = true;


    }
})();