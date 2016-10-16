(function () {
    "use strict";

    angular
        .module('app')
        .controller('HeaderController', headerController);

    headerController.$inject = ['authService'];

    function headerController(authService) {
        var vm = this;
    }

})();