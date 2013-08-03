$(function() {
    'use strict';

    var Index = Backbone.View.extend({

        el: '#entry-list',

        events: {
            'click .delete': 'delete'
        },

        _rowTemplate: null,


        add: function(model) {
            var row = this._rowTemplate.clone().removeClass('hide').hide();

            // set data
            row.find('.id').html(model.id);
            row.find('.name').html(model.get('name'));
            row.find('.username').html(model.get('username'));
            row.find('.tags').html(model.get('tags'));

            this._rowTemplate.after(row.fadeIn());

            // show table
            this.$el.fadeIn();
        },


        delete: function(event) {
            var modal = ppma.View.ConfirmModal;
            var id    = $(event.target).closest('tr').find('.id').text();
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