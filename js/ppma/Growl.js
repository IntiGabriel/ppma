$(function() {
    'use strict';

    window.ppma.Growl = {

        error: function(msg) {
            $.bootstrapGrowl(msg, { type: 'error'});
        },


        success: function(msg) {
            $.bootstrapGrowl(msg, { type: 'success'});
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
