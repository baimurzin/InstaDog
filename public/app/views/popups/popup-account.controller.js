(function () {
    "use strict";

    angular
        .module('app')
        .controller('PopupAccountController', popupAccountController);

    popupAccountController.$inject = ['accountFactory'];

    function popupAccountController(accountFactory) {
        var vm = this;

        vm.save = save;

        function save() {
            accountFactory.save({
                login: vm.login,
                password: vm.password
            }).then(function (res) {
                console.log('respo');
                console.log(res);
            }, function (error) {
                console.log("err");
                console.log(error);
            })
        }
    }
})();