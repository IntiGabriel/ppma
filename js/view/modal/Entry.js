$(function() {
    'use strict';

    var Entry = Backbone.View.extend({

        el: '#modal-entry',

        events: {
            'submit form':              'submit',
            'click .btn-primary':       function() { this.$el.find('form').submit(); },
            'click .toggle-password':   'togglePassword',
            'click .generate-password': 'generatePassword'
        },


        generatePassword: function() {
            var passwordField = $('#Entry_password');

            // show password field if not shown
            if (passwordField.attr('type') == 'password') {
                this.togglePassword()
            }

            // generate and set password
            passwordField.val($.password(12));
            passwordField.select();
        },


        hide: function() {
            this.$el.modal('hide');
        },


        show: function() {
            this.$el.modal('show');
            this.$el.find(':text').first().click().focus();
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
        },


        togglePassword: function() {
            var original = $('#Entry_password');
            var clone    = original.clone();

            if (original.attr('type') == 'text') {
                clone.attr('type', 'password');
            }
            else {
                clone.attr('type', 'text');
            }

            original.replaceWith(clone);
            clone.select();
        }

    });


    window.ppma.view.modal.Entry = new Entry();

});