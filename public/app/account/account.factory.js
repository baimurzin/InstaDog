(function () {
    "use strict";

    angular
        .module('app.account')
        .factory('accountFactory', accountFactory);

    accountFactory.$inject = ['$http', '$q'];

    function accountFactory($http, $q) {
        return {
            get: function () {
                var defer = $q.defer();
                $http.get('/api/accounts')
                    .success(function (data) {
                        defer.resolve(data);
                    })
                    .error(defer.reject);
                return defer.promise;
            },

            save: function (accountData) {
                var defer = $q.defer();
                $http({
                    method: 'POST',
                    url: '/api/accounts',
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                    data: $.param(accountData)
                })
                    .success(function (data) {
                        defer.resolve(data);
                    })
                    .error(defer.reject);
                return defer.promise;
            },

            destroy: function (id) {
                var defer = $q.defer();
                $http.delete('/api/accounts/' + id)
                    .success(function (data) {
                        defer.resolve(data);
                    })
                    .error(defer.reject);
                return defer.promise;
            }

        };
    }
})();