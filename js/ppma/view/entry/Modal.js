$(function() {
    'use strict';

    var Modal = Backbone.View.extend({

        el: '#modal-entry',

        events: {
            'submit form':              'submit',
            'click .btn-primary':       function() { this.$el.find('form').submit(); },
            'click .toggle-password':   'togglePassword',
            'click .generate-password': 'generatePassword'
        },


        generatePassword: function() {
            // show password field if not shown
            if ($('#Entry_password').attr('type') === 'password') {
                this.togglePassword();
            }

            // generate and set password
            $('#Entry_password').val($.password(12));
            $('#Entry_password').select();
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

            // create model
            var model = new ppma.Model.Entry({
                name:     this.$el.find('[id$=name]:first').val(),
                username: this.$el.find('[id$=username]:first').val(),
                password: this.$el.find('[id$=password]:first').val()
            });

            // hide modal on sucess
            model.once('sync', $.proxy(function(model, response) {
                if (!response.error) {
                    this.hide();
                }
            }, this));

            // save modal
            model.save();

            return false;
        },


        togglePassword: function() {
            var original = $('#Entry_password');
            var clone    = original.clone();

            if (original.attr('type') === 'text') {
                clone.attr('type', 'password');
                this.$el.find('.toggle-password i').attr('class', 'icon-eye-open');
            }
            else {
                clone.attr('type', 'text');
                this.$el.find('.toggle-password i').attr('class', 'icon-eye-close');
            }

            original.replaceWith(clone);
        }

    });


    ppma.View.Entry.Modal = new Modal();

});