(function () {
    "use strict";

    angular
        .module('app')
        .controller('AppController', appController);

    appController.$inject = ['authService'];

    function appController(authService) {
        var vm = this;

        vm.auth = authService;
    }
})();