$(function() {
    'use strict';

    var Index = Backbone.View.extend({

        el: '#entry-list',

        events: {
            'click th.sortable': 'sort'
        },


        add: function(model) {
            // create row
            var row = new ppma.View.Entry.Row({ model: model });

            // add row to table
            this.$el.find('tbody').prepend( row.render() );

            // show table
            //this.$el.fadeIn();
        },


        refresh: function() {
            this.$el.find('tbody').empty();

            this.$el.find('table').attr('class', 'table table-striped');
            this.$el.find('td').removeAttr('class');

            _.each(ppma.Collection.Entries.models, $.proxy(function(model) {
                this.add(model);
            }, this));
        },


        create: function() {
            // bind callbacks
            this.listenTo(ppma.View.Entry.Modal, 'submit', this._save);

            // unbind callbacks on Modal#hide
            this.listenTo(ppma.View.Entry.Modal, 'hide', function() {
                this.stopListening(ppma.View.Entry.Modal, 'submit', this._save);
            });

            // show modal
            ppma.View.Entry.Modal.show();
        },


        initialize: function() {
            // hide table
            this.$el.hide();

            // add callbacks
            this.listenTo(ppma.Collection.Entries, 'add', this.refresh);
            this.listenTo(ppma.Collection.Entries, 'sort', this.refresh);

            // show table after first load
            this.listenToOnce(ppma.Collection.Entries, 'sync', function() {
                this.$el.fadeIn();
            });
        },


        /**
         * @returns {boolean}
         * @private
         */
        _save: function() {
            var form  = ppma.View.Entry.Modal.$el;
            var model = new ppma.Model.Entry();

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


        sort: function(event) {
            ppma.Collection.Entries.sortAttribute = $(event.target).attr('rel');
            ppma.Collection.Entries.sort();
        }

    });

    ppma.View.Entry.Index = new Index();

});