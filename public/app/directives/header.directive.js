(function () {
    "use strict";

    angular
        .module('app')
        .directive('appHeader', HeaderDirective);

    function HeaderDirective() {
        return {
            templateUrl: '/app/directives/parts/header.html',
            controller: 'HeaderController as header'
        };
    }
})();