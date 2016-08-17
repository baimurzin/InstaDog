(function () {
    "use strict";

    angular
        .module('app.account')
        .factory('commentFactory', commentFactory);

    commentFactory.$inject = ['$http'];

    function commentFactory($http) {
        return {
            get: function () {
                return $http.get('/api/accounts');
            },

            save: function (accountData) {
                return $http({
                    method: 'POST',
                    url: '/api/accounts',
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                    data: $.param(accountData)
                });
            },

            destroy: function (id) {
                return $http.delete('/api/accounts/' + id);
            }

            //todo
        };
    }
})();