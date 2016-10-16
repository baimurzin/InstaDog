(function () {
    "use strict";

    angular
        .module('app',
            [
                'ui-notification',
                'angular-loading-bar',
                'app.auth',
                'app.account',
                'app.test'
            ]);
})();