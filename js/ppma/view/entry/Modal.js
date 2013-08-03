$(function() {
    'use strict';

    var Modal = Backbone.View.extend({

        el: '#modal-entry',

        events: {
            'submit form':              'save',
            'click .save':              'save',
            'click .cancel':            'cancel',
            'click .toggle-password':   'togglePassword',
            'click .generate-password': 'generatePassword'
        },


        cancel: function() {
            this.trigger('cancel');
            this.hide();
        },


        generatePassword: function() {
            var passwordField = this.$el.find('.password');

            // show password field if not shown
            if (passwordField.attr('type') === 'password') {
                this.togglePassword();
            }

            // generate and set password
            passwordField.val($.password(12));
            passwordField.select();
        },


        hide: function() {
            // set active ajax-loader to content
            ppma.AjaxLoader.setActive(ppma.AjaxLoader.ACTIVE_CONTENT);

            // hide modal
            this.$el.modal('hide');
        },


        show: function() {
            // empty form
            this.$el.find(':input').val('');

            // set active ajax-loader to modal
            ppma.AjaxLoader.setActive(ppma.AjaxLoader.ACTIVE_MODAL);

            this.$el.modal('show');
            this.$el.find(':text').first().click().focus();
        },


        save: function() {
            // trigger submit-event
            this.trigger('submit');

            // get form
            var form = this.$el.find('form');

            // create model
            var model = new ppma.Model.Entry({
                name:     this.$el.find('[id$=name]:first').val(),
                username: this.$el.find('[id$=username]:first').val(),
                password: this.$el.find('[id$=password]:first').val()
            });

            // hide modal on success
            this.listenTo(model, 'sync', function(model, response) {
                if (!response.error) {
                    this.hide();
                }
            });

            // save modal and add to collection
            ppma.Collection.Entries.create(model, {
                add: false,
                wait: true,
                success: function(model, response) {
                    model.set('id', response.get('data').id);
                    ppma.Collection.Entries.add(model);
                }
            });

            return false;
        },


        togglePassword: function() {
            // clone password field
            var original = this.$el.find('.password');
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