(function () {
    "use strict";

    angular
        .module('app')
        .controller('SideBarController', sideBarController);

    sideBarController.$inject = ['$scope', 'authService', 'ngDialog', 'accountFactory'];

    function sideBarController($scope, authService, ngDialog, accountFactory) {
        var vm = this;

        vm.accounts = [];
        vm.addAccountForm = addAccountForm;
        vm.activateAccount = activateAccount;

        init();

        $scope.$on('account:added', function (event, data) {
            vm.accounts.push(data);
        });

        function init() {
            accountFactory.get().then(function (response) {
                vm.accounts = response;
            })
        }

        function addAccountForm() {
            ngDialog.open({
                template: '/app/views/popups/account_create.html',
                controller: 'PopupAccountController as popupAcc'
            });
        }

        function activateAccount(id) {
            accountFactory.activate(id)
                .then(function (response) {
                    updateAccounts();
                }, function (error) {
                    console.log(error);
                })
        }

        function updateAccounts() {
            accountFactory.get().then(function (response) {
                vm.accounts = response;
            })
        }

    }
})();