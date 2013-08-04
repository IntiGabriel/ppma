$(function() {
    'use strict';

    ppma.View.Entry.Row = Backbone.View.extend({

        tagName: 'tr',

        events: {
            'click .delete': '_delete',
            'click .edit':   '_update'
        },

        model: null,

        _template: $('#entry-row-template'),


        /**
         * @private
         */
        _delete: function() {
            var modal = ppma.View.ConfirmModal;
            var model = ppma.Collection.Entries.get(this.model.id);

            // submit-callback
            var submitCallback = function() {
                model.destroy({
                    success: function(model, response) {
                        ppma.Growl.processMessages(response.messages);
                    }
                });

                this.$el.remove();
                modal.hide();
            };

            // cancel-callback
            var cancelCallback = function() {
                modal.off('submit', submitCallback);
            };

            // bind callbacks to modal
            this.listenToOnce(modal, 'submit', submitCallback);
            this.listenToOnce(modal, 'cancel', cancelCallback);

            // show modal
            modal.setHeader('Delete Entry #' + this.model.id);
            modal.setMessage('Do you really want to delete this entry?');
            modal.show();
        },


        initialize: function() {
            this.listenTo(this.model, 'change:name', this._updateName);
            this.listenTo(this.model, 'change:username', this._updateUsername);
        },


        /**
         * @returns {jQuery}
         */
        render: function() {
            var template = _.template( this._template.html(), this.model.attributes );
            this.$el.html(template);

            // format tags
            var tags = '';
            _.each( this.$el.find('.tag-list').text().split(','), function(tag) {
                tags = tags + '<button class="btn btn-mini">' + tag + '</button> ';
            });

            // add tags
            this.$el.find('.tag-list').html(tags);

            return this.$el;
        },


        /**
         * @private
         */
        _save: function() {
            var form  = ppma.View.Entry.Modal.$el;
            var model = this.model;

            // get attribues
            var attributes = {
                name:     form.find(':input.name').val(),
                username: form.find(':input.username').val(),
                password: form.find(':input.password').val(),
                url:      form.find(':input.url').val(),
                comment:  form.find(':input.comment').val(),
                tagList:  form.find(':input.tagList').val()
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
        },


        /**
         * @private
         */
        _update: function() {
            // add save-callback
            this.listenTo(ppma.View.Entry.Modal, 'submit', this._save);

            // remoave callback
            this.listenTo(ppma.View.Entry.Modal, 'hide', function() {
                this.stopListening(ppma.View.Entry.Modal, 'submit', this._save);
            });

            var fillAndShowModal = function(model) {
                ppma.View.Entry.Modal.fillForm(model);
                ppma.View.Entry.Modal.show();
            }

            // fetch password if is not setted
            if (this.model.get('password').length == 0) {
                var password = new ppma.Model.Password({ id: this.model.id });

                password.fetch({
                    success: $.proxy(function(model) {
                        // set password to models
                        model.set('password', model.get('data').password);
                        this.model.set('password', model.get('password'));

                        // show modal
                        fillAndShowModal(this.model)
                    }, this)
                });
            } else {
                // show modal
                fillAndShowModal(this.model);
            }
        },


        /**
         * @private
         */
        _updateName: function(model) {
            this.$el.find('.name').text(this.model.get('name'));
        },


        /**
         * @private
         */
        _updateUsername: function(model) {
            this.$el.find('.username').text(this.model.get('username'));
        }

    });

});