(function () {
    "use strict";

    angular
        .module('app')
        .controller('PopupAccountController', popupAccountController);

    popupAccountController.$inject = ['$rootScope', 'accountFactory', 'Notification'];

    function popupAccountController($rootScope, accountFactory, Notification) {
        var vm = this;

        vm.save = save;

        function save() {
            accountFactory.save({
                login: vm.login,
                password: vm.password
            }).then(function (response) {
                $rootScope.$broadcast('account:added', response);
            }, function (error) {
                Notification.error('Bad')
            })
        }
    }
})();