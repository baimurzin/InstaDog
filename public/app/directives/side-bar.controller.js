(function () {
    "use strict";

    angular
        .module('app')
        .controller('SideBarController', sideBarController);

    sideBarController.$inject = ['authService'];

    function sideBarController(authService) {
        var vm = this;


    }
})();