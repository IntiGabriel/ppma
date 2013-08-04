$(function() {
    'use strict';

    ppma.Growl = {

        _notification: {},

        error: function(msg) {
            this._notification.trigger('error', msg);
        },


        initialize: _.once(function() {
            _.extend(this._notification, Backbone.Events);

            $('body').append(new Notifier({
                model: this._notification, // your notification object
                wait: 2000 // the duration of notifications as milliseconds
            }).render().el);
        }),


        success: function(msg) {
            this._notification.trigger('success', msg);
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

    ppma.Growl.initialize();

});
