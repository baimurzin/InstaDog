(function () {
    "use strict";

    angular
        .module('app')
        .run(runApp);

    runApp.$inject = ['$rootScope', '$state', 'authService'];

    function runApp($rootScope, $state, authService) {
        $rootScope.$on('$stateChangeStart', function (event, toState) {

            var user = JSON.parse(localStorage.getItem('user'));

            if (user) {
                $rootScope.authenticated = true;
                $rootScope.currentUser = user;

                if (toState === 'auth') {
                    event.preventDefault();
                    $state.go('users'); //main page
                }
            }
        })
    }
})();