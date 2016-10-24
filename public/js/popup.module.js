var popupModule = {};

(function () {
    "use strict";

    popupModule = {
        popupIndex: 0,

        generateHTML: function (popupId, popupSize, title, no_close, modalClass) {
            return '<div class="modal ' + ((modalClass) ? modalClass : '') + '" role="dialog" id="' + popupId + '">' +
                '<div class="modal-dialog ' + ((popupSize == 'large') ? 'modal-lg' : ((popupSize == 'small') ? 'modal-sm' : '')) + '"><div class="modal-content"><div class="modal-header">' +
                ((!no_close) ? '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>' : '') +
                '<h4 class="modal-title">' + ((title) ? title : '<i class="fa fa-spin fa-refresh"></i> Loading...') + '</h4>' +
                '</div>' +
                '<div class="modal-body"></div>' +
                '</div></div></div>';
        },

        create: function (url, size, callback) {
            if (!size)
                size = 'normal';

            var id = 'modal_' + popupModule.popupIndex;
            var html = popupModule.generateHTML(id, size);
            var modal;

            $('body').append(html);
            modal = $('#' + id);

            $.ajax({
                method: 'GET',
                url: url,
                beforeSend: function(){
                    modal.modal();
                    modal.on('hidden.bs.modal', function (e) {
                        modal.remove();
                    });
                },
                success: function(response){
                    if (response.status && response.status == 'Ok') {
                        modal.find('.modal-title').html(response.title);
                        modal.find('.modal-body').html(response.body);

                        commonModule.applyPlugins(modal.find('.modal-body'));
                    } else if (response.status && response.status == 'Error') {
                        if (!modal.hasClass('modal-danger')) {
                            modal.addClass('modal-danger');
                        }

                        modal.find('.modal-title').html('Error');
                        modal.find('.modal-body').html((response.message) ? response.message : 'Response error');
                    } else {
                        if (!modal.hasClass('modal-danger')) {
                            modal.addClass('modal-danger');
                        }

                        modal.find('.modal-title').html('Error');
                        modal.find('.modal-body').html('Response error');
                    }
                },
                error: function(err) {
                    popupModule.checkError(err, modal);
                }
            });

            popupModule.popupIndex++;

            return false;
        },

        submitPopupForm: function(form, callback) {
            var currentPopup = $(form).parents('.modal:first');

            $(form).find('button[type=submit]').attr('disabled', true);

            $.ajax(
                {
                    type: "POST",
                    url: $(form).attr('action'),
                    data: $(form).serialize(),
                    cache: false,
                    success: function (data) {
                        if (data.status && data.status == 'Ok' && !data.body) {

                            if (data.refreshTable) {
                                commonModule.refreshTable(data.refreshTable);
                                return false;
                            }

                            if (data.redirect) {
                                document.location = data.redirect;
                                return false;
                            }

                            if (data.notify) {
                                commonModule.notify(data.notify.type, data.notify.message);
                            }

                            currentPopup.modal('hide');

                            if (callback) {
                                callback();
                            }

                            return true;
                        } else {
                            if (data.body) {
                                currentPopup.find('.modal-body').html(data.body);
                            } else {
                                currentPopup.find('.modal-body').html(data);
                            }

                            commonModule.applyPlugins(currentPopup.find('.modal-body'));
                        }
                    },
                    error: function(e) {
                        popupModule.checkError(e, currentPopup);
                    },
                    complete: function() {
                        $(form).find('button[type=submit]').attr('disabled', false);
                    }
                }
            );

            return false;
        },

        checkError: function(error, contentModal) {
            if (error.status && error.status == 401) {
                var popupId = 'modal_unauthorized',
                    popupHtml = popupModule.generatePopupHtml(popupId, 'normal', 'Your session has expired', true, 'modal-danger'),
                    seconds = 5,
                    modal,
                    sessionRedirectSeconds,
                    redirectInterval;

                $('body').append(popupHtml);

                modal = $('#'+popupId);

                modal.find('.modal-body').html('<div class="text-center"><p><i class="fa fa-chain-broken fa-4x"></i></p></div><div class="text-center"><p><strong>You will be redirected to the login page after <span id="sessionRedirectSeconds">' + seconds + ' seconds</span>...</strong></p></div>');

                modal.modal({
                    keyboard: false,
                    backdrop: 'static'
                });

                sessionRedirectSeconds = modal.find('#sessionRedirectSeconds');

                if (redirectInterval) {
                    clearInterval(redirectInterval);
                }

                redirectInterval = setInterval(function(){
                    seconds--;
                    if (seconds == 0) {
                        clearInterval(redirectInterval);
                        document.location.reload();
                    }

                    sessionRedirectSeconds.text(seconds + ((seconds > 1) ? ' seconds' : ' second'));
                }, 1000);
            } else {
                if (contentModal) {
                    if (!contentModal.hasClass('modal-danger')) {
                        contentModal.addClass('modal-danger');
                    }
                    contentModal.find('.modal-title').html('Error' + ((error.status) ? ': ' + error.status : ''));
                    contentModal.find('.modal-body').html(error.statusText);
                }

                return false;
            }
        },

        closeLastPopup: function(id) {
            if (id) {
                $('#' + id).modal('hide');
                return;
            }
            var lastPopup = $('.modal:last').attr('id');

            $('#' + lastPopup).modal('hide');
        }
    }
})();