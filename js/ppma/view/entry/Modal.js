$(function() {
    'use strict';

    var Modal = Backbone.View.extend({

        el: '#modal-entry',

        events: {
            'submit form':              'submit',
            'click .save':              'submit',
            'click .cancel':            'cancel',
            'click .toggle-password':   'togglePassword',
            'click .generate-password': 'generatePassword'
        },


        bindShortcuts: function() {
            Mousetrap.bind('esc', $.proxy(this.cancel, this));
            Mousetrap.bind('enter', $.proxy(this.submit, this));
        },


        cancel: function() {
            this.trigger('cancel');
        },


        fillForm: function(model) {
            this.$el.find(':input.id').val(model.get('id'));
            this.$el.find(':input.name').val(model.get('name'));
            this.$el.find(':input.username').val(model.get('username'));
            this.$el.find(':input.password').val(model.get('password'));
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

            // empty form
            this.$el.find(':input').val('');

            // hide modal
            this.$el.modal('hide');
        },


        initialize: function() {
            this.listenTo(this, 'show', this.bindShortcuts)
            this.listenTo(this, 'cancel', this.unbindShortcuts);
            this.listenTo(this, 'cancel', this.hide);
            this.listenTo(this, 'submit', this.save);
        },


        show: function() {
            this.trigger('show');

            // set active ajax-loader to modal
            ppma.AjaxLoader.setActive(ppma.AjaxLoader.ACTIVE_MODAL);

            this.$el.modal('show');
            this.$el.find(':text').first().click().focus();
        },


        save: function() {
            // get form
            var form = this.$el.find('form');

            // set attribues
            var attributes = {
                name:     this.$el.find(':input.name').val(),
                username: this.$el.find(':input.username').val(),
                password: this.$el.find(':input.password').val()
            };

            // add id if exist
            if (this.$el.find(':input.id').val().length > 0) {
                attributes.id = this.$el.find(':input.id').val();
            }

            // save model
            var model = new ppma.Model.Entry(attributes);

            // hide modal on success
            this.listenTo(model, 'sync', function(model, response) {
                if (!response.error) {
                    ppma.Growl.processMessages(response.messages, false);
                    this.hide();
                }
                else {
                    ppma.Growl.processMessages(response.messages, true);
                }
            });

            // save modal and add to collection
            ppma.Collection.Entries.create(model, {
                add: false,
                wait: true,
                success: function(model, response) {
                    model.set('id', response.get('data').id);

                    if (!response.get('error')) {
                        ppma.Collection.Entries.add(model);
                    }
                }
            });

            return false;
        },


        submit: function() {
            this.trigger('submit');
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
        },


        unbindShortcuts: function() {
            Mousetrap.unbind('esc');
            Mousetrap.unbind('enter');
        }

    });


    ppma.View.Entry.Modal = new Modal();

});