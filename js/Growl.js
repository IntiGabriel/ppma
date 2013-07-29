$(function() {
    'use strict';

    window.ppma.Growl = {

        error: function(msg) {
            $.bootstrapGrowl(msg, { type: 'error'});
        },

        success: function(msg) {
            $.bootstrapGrowl(msg, { type: 'success'});
        },

        processResponse: function(response) {
            $.each(response.messages, function() {
                if (response.error) {
                    ppma.Growl.error(this);
                } else {
                    ppma.Growl.success(this);
                }
            });
        }

    };

});
