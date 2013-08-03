$(function() {
    'use strict';

    var Index = Backbone.View.extend({

        el: '#entry-list',

        events: {
            'click .delete': 'delete',
            'click .edit':   'edit'
        },

        _rowTemplate: '.template.record',


        add: function(model) {
            // set data to template
            var template = _.template( this.$el.find(this._rowTemplate).html(), model.attributes);
            this._rowTemplate.after($(template).fadeIn());

            // show table
            this.$el.fadeIn();
        },


        delete: function(event) {
            var modal = ppma.View.ConfirmModal;
            var id    = $(event.currentTarget).attr('rel');
            var model = ppma.Collection.Entries.get(id);

            // submit-callback
            var submitCallback = function() {
                model.destroy({
                    success: function(model, response) {
                        ppma.Growl.processMessages(response.messages);
                    }
                });
            };

            // cancel-callback
            var cancelCallback = function() {
                modal.off('submit', submitCallback);
            };

            // bind callbacks to modal
            modal.once('submit', submitCallback);
            modal.once('cancel', cancelCallback);

            // show modal
            modal.setHeader('Delete Entry #' + id);
            modal.setMessage('Do you really want to delete this entry?');
            modal.show();
        },


        edit: function(event) {
            var id    = $(event.currentTarget).attr('rel');
            var model = ppma.Collection.Entries.get(id);

            var fillAndShowModal = function(model) {
                ppma.View.Entry.Modal.fillForm(model);
                ppma.View.Entry.Modal.show();
            }

            // fetch password if is not setted
            if (model.get('password').length == 0) {
                var password = new ppma.Model.Password({ id: id});

                password.fetch({
                    success: $.proxy(function(passwordModel) {
                        // set password to models
                        passwordModel.set('password', passwordModel.get('data').password);
                        model.set('password', passwordModel.get('password'));

                        // show modal
                        fillAndShowModal(model)
                    }, this)
                });
            } else {
                // show modal
                fillAndShowModal(model);
            }
        },


        initialize: function() {
            // hide table
            this.$el.hide();

            // get template for row
            this._rowTemplate = this.$el.find('.template.record');

            // added callback if entry added to collection
            this.listenTo(ppma.Collection.Entries, 'add', this.add);

            // removed entry from collection
            ppma.Collection.Entries.on('remove', $.proxy(function(model) {
                this.$el.find('.id').each(function(index, element) {
                    if ($(element).text() == model.id) {
                        $(element).parent().remove();
                    }
                });
            }, this));
        }

    });

    ppma.View.Entry.Index = new Index();

});