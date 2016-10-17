(function () {
    "use strict";

    angular
        .module('app')
        .controller('SideBarController', sideBarController);

    sideBarController.$inject = ['authService', 'ngDialog'];

    function sideBarController(authService, ngDialog) {
        var vm = this;

        vm.addAccountForm = addAccountForm;

        function addAccountForm() {
            ngDialog.open({
                template: '/app/views/popups/account_create.html',
                controller: 'PopupAccountController as popupAcc'
            });
        }

    }
})();