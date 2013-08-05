$(function() {
    'use strict';

    ppma.View.Entry.Row = Backbone.View.extend({

        tagName: 'tr',

        events: {
            'click .delete': '_delete',
            'click .edit':   function() { ppma.View.Entry.Modal.update(this.model); }
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
            this.listenTo(this.model, 'change:name', this.render);
            this.listenTo(this.model, 'change:username', this.render);
            this.listenTo(this.model, 'change:tagList', this.render);
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
                if (tag.length > 0) {
                    tags = tags + '<button class="btn btn-mini">' + tag + '</button> ';
                }
            });

            // add tags
            this.$el.find('.tag-list').html(tags);

            // make chainable
            return this;
        },


    });

});