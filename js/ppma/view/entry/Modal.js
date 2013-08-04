$(function() {
    'use strict';

    /**
     *
     * @fires submit will be triggered if form is submitted
     * @fires hide   will be triggered if modal is hidden
     * @fires show   will be triggered if modal is shown
     * @fires cancel will be triggered if form is canceled
     * @type {object}
     */
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

            // hide modal
            this.hide();
        },


        fillForm: function(model) {
            this.$el.find(':input.id').val(model.get('id'));
            this.$el.find(':input.name').val(model.get('name'));
            this.$el.find(':input.username').val(model.get('username'));
            this.$el.find(':input.password').val(model.get('password'));
            this.$el.find(':input.url').val(model.get('url'));
            this.$el.find(':input.comment').val(model.get('comment'));
            this.$el.find(':input.tagList').importTags(model.get('tagList'));
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
            this.trigger('hide');

            // unbind shortcuts
            this.unbindShortcuts();

            // set active ajax-loader to content
            ppma.AjaxLoader.setActive(ppma.AjaxLoader.ACTIVE_CONTENT);

            // empty form
            this.$el.find(':input').val('');
            this.$el.find(':input.tagList').importTags('');

            // hide modal
            this.$el.modal('hide');
        },


        initialize: function() {
            this.$el.find(':input.tagList').tagsInput({
                defaultText: ''
            });
        },


        show: function() {
            this.trigger('show');

            // bind shortcuts
            this.bindShortcuts();

            // add callbacks
            this.listenTo(this, 'cancel', this.hide);

            // set active ajax-loader to modal
            ppma.AjaxLoader.setActive(ppma.AjaxLoader.ACTIVE_MODAL);

            this.$el.modal('show');
            this.$el.find(':text').first().click().focus();
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