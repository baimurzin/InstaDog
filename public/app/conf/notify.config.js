(function () {
    "use strict";

    angular
        .module('app')
        .config(notificationConfig);

    notificationConfig.$inject = ['NotificationProvider'];

    function notificationConfig(NotificationProvider) {
        NotificationProvider.setOptions({
            delay: 10000,
            startTop: 20,
            startRight: 10,
            verticalSpacing: 20,
            horizontalSpacing: 20,
            positionX: 'left',
            positionY: 'top'
        });
    }
})();