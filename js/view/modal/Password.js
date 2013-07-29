$(function() {
    'use strict';

    var Password = Backbone.View.extend({

        el: '#modal-password',


        events: {
            'submit form':        'submit',
            'click .btn-primary': function() { this.$el.find('form').submit(); }
        },


        hide: function() {
            this.$el.modal('hide');
        },


        show: function() {
            this.$el.modal('show');
            this.$el.find(':password').first().click().focus();
        },


        submit: function() {
            var form = this.$el.find('form');

            // send form as ajax
            $.post(form.attr('action'), form.serialize())
                .done($.proxy(function(response) {
                    // growl response
                    ppma.Growl.processResponse(response);

                    if (response.error == false) {
                        this.hide();
                    }
                }, this));

            return false;
        }

    });

    window.ppma.view.modal.Password = new Password();

});