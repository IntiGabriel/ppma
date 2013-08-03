$(function() {
    'use strict';

    window.ppma.Growl = {

        error: function(msg) {
            $.bootstrapGrowl(msg, { type: 'error', delay: 2000});
        },


        success: function(msg) {
            $.bootstrapGrowl(msg, { type: 'success', delay: 2000});
        },


        processMessages: function(messages, error) {
            $.each(messages, function() {

                if (error) {
                    ppma.Growl.error(this);
                } else {
                    ppma.Growl.success(this);
                }

            });
        }

    };

});
