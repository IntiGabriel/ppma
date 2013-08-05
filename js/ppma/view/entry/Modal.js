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

        _model: null,


        bindShortcuts: function() {
            Mousetrap.bind('esc', $.proxy(this.cancel, this));
            Mousetrap.bind('enter', $.proxy(this.submit, this));
        },


        cancel: function() {
            this.trigger('cancel');

            // hide modal
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


        refresh: function() {
            var model = this._model;
            this.$el.find(':input.id').val(model.get('id'));
            this.$el.find(':input.name').val(model.get('name'));
            this.$el.find(':input.username').val(model.get('username'));
            this.$el.find(':input.password').val(model.get('password'));
            this.$el.find(':input.url').val(model.get('url'));
            this.$el.find(':input.comment').val(model.get('comment'));
            this.$el.find(':input.categoryId').val(model.get('categoryId'));
            this.$el.find(':input.tagList').importTags(model.get('tagList'));
        },


        setModel: function(model) {
            this._model = model;
            this.refresh();
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
        },


        update: function(model) {
            this.setModel(model);

            // add save-callback
            this.listenTo(this, 'submit', this._save);

            // remove callback
            this.listenTo(this, 'hide', function() {
                this.stopListening(this, 'submit', this._save);
            });

            // fetch password if is not setted
            if (this._model.get('password').length == 0) {
                var password = new ppma.Model.Password({ id: this._model.id });

                password.fetch({
                    success: $.proxy(function(model) {
                        // set password to models
                        this._model.set('password', model.get('data').password);
                        this.refresh();

                        this.show();
                    }, this)
                });
            } else {
                this.show();
            }
        },


        /**
         * @private
         */
        _save: function() {
            var form  = ppma.View.Entry.Modal.$el;
            var model = this._model;

            // get attribues
            var attributes = {
                name:       form.find(':input.name').val(),
                username:   form.find(':input.username').val(),
                password:   form.find(':input.password').val(),
                url:        form.find(':input.url').val(),
                comment:    form.find(':input.comment').val(),
                tagList:    form.find(':input.tagList').val(),
                categoryId: form.find(':input.categoryId').val()
            };

            // set attributes to model
            model.set(attributes);

            // save modal and add to collection
            ppma.Collection.Entries.create(model, {
                add: false,
                wait: true,
                success: function(model, response) {
                    // set id to model
                    model.set('id', response.get('data').id);

                    // no errors
                    if (!response.get('error')) {
                        // add model to collection
                        ppma.Collection.Entries.add(model);

                        // hide modal
                        ppma.View.Entry.Modal.hide();

                        // growl success message
                        ppma.Growl.processMessages(response.get('messages'), false);
                    }
                    else {
                        // growl error messages
                        ppma.Growl.processMessages(response.get('messages'), true);
                    }
                }
            });

            return false;
        }

    });


    ppma.View.Entry.Modal = new Modal();

});