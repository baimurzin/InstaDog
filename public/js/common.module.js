var commonModule = {};

(function () {
    "use strict";

    commonModule = {

        refreshTable: function (tableId) {
            $(tableId).bootstrapTable('refresh');
        },

        notify: function(type, message) {
            if (!type || !message) return false;

            Lobibox.notify(type, {
                soundPath: '/plugins/lobibox/sounds/',
                soundExt: '.ogg',
                showClass: 'bounceIn',
                hideClass: 'bounceOut',
                delay: 10000,
                delayIndicator: false,
                position: "top right",
                msg: message
            });
        },

        notifyLoad: function() {
            $.ajax({
                type: "GET",
                url: notifyLoad,
                success: function (data) {
                    if (data.length > 0) {
                        for(i=0;i<data.length;i++) {
                            commonModule.notify(data[i].type, data[i].message);
                        }
                    }
                },
                error: function(e) {
                    commonModule.checkLoginSession(e);
                }
            });
        },

        deleteIdsFromTable: function(tableId) {
            if (confirm("Are you sure?")) {
                var deleteIDs = $(tableId).bootstrapTable('getSelections').map(function(el){
                    return el.id;
                });

                if (!deleteIDs.length) {
                    this.notify('error', 'Select items');
                    return false;
                }

                $.ajax(
                    {
                        type: "POST",
                        url: $(tableId).data('delete_url')+ "/" + deleteIDs.join(','),
                        data: {
                            _method: 'delete'
                        },
                        success: function() {
                            commonModule.refreshTable(tableId);
                        },
                        error: function(e) {
                            commonModule.checkLoginSession(e);
                        }
                    }
                );
            }

            return false;
        }
    }
})();