(function () {
    "use strict";

    angular
        .module('app')
        .controller('PopupAccountController', popupAccountController);

    popupAccountController.$inject = [];

    function popupAccountController() {
        var vm = this;

        vm.test =12345;
    }
})();