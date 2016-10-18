(function () {
    "use strict";

    angular
        .module('app')
        .controller('SideBarController', sideBarController);

    sideBarController.$inject = ['authService', 'ngDialog', 'accountFactory'];

    function sideBarController(authService, ngDialog, accountFactory) {
        var vm = this;

        vm.addAccountForm = addAccountForm;
        vm.accounts = [];

        init();

        function addAccountForm() {
            ngDialog.open({
                template: '/app/views/popups/account_create.html',
                controller: 'PopupAccountController as popupAcc'
            });
        }

        function init() {
            console.log('init');
            accountFactory.get().then(function (response) {
                vm.accounts = response;
            })
        }


    }
})();