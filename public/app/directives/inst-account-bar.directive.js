(function () {
    "use strict";

    angular
        .module('app')
        .directive('instAccountBar', instAccountBar);

    function instAccountBar() {
        return {
            restrict:'A',
            templateUrl: '/app/directives/parts/inst_account_bar.html',
            controller: 'InstAccountBarController as instAccBar'
        }
    }
})();