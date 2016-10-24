if (typeof IM === 'undefined' || typeof IM.Instagram === 'undefined') {
    throw new Error('requires main app module IM or Instagram');
}

IM.Instagram.Accounts = {};

(function () {
    "use strict";

    var o = IM.Instagram.Accounts;

    IM.Instagram.Accounts = {
        instagram_accounts_table: '#instagram_accounts_table',

        initInstagramAccountsTable: function () {
            $(IM.Instagram.Accounts.instagram_accounts_table).bootstrapTable({
                pagination: true,
                pageList: [10, 20, 50, 100],
                pageSize: 10,
                classes: 'table table-striped',
                method: 'GET',
                search: false,
                idField: 'id',
                uniqueId: 'id',
                escape: true,
                columns: [
                    {
                        field: 'state',
                        checkbox: true
                    },
                    {
                        field: 'login',
                        title: 'Login',
                        sortable: true
                    },
                    {
                        field: 'status',
                        title: 'Status',
                        formatter: function (value, row, index) {
                            switch (value) {
                                case 0:
                                    return '<div class="text-center loader-inner line-scale-party"><div></div><div></div><div></div><div></div></div>';
                                case 1:
                                    return '<i class="fa fa-check"></i>';
                                case 2:
                                    return 'error';
                            }
                        }
                    },
                    {
                        field: 'acc_data.followings_count',
                        title: 'Followings',
                        sortable: true
                    },
                    {
                        field: 'acc_data.followers_count',
                        title: 'Followers',
                        sortable: true
                    },
                    {
                        field: 'acc_data.media_count',
                        title: 'Posts',
                        sortable: true
                    }
                ]
            });
        }
    }

})();