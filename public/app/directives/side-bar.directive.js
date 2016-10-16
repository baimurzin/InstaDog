(function () {
    "use strict";

    angular
        .module('app')
        .directive('appSideBar', SideBarDirective);

    function SideBarDirective() {
        return {
            templateUrl: '/app/directives/parts/sidebar.html',
            controller: 'SideBarController as sidebar'
        };
    }


})();
