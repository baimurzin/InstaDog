(function () {
    "use strict";

    angular
        .module('app',
            [
                'ui-notification',
                'ngDialog',
                'angular-loading-bar',
                'app.auth',
                'app.account',
                'app.test'
            ]);
})();