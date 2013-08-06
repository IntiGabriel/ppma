$(function() {
    'use strict';

    ppma.View.Sidebar.RecentEntries = Backbone.View.extend({

        _template:    _.template($('#sidebar-recent-entries-template').html()),

        _rowTemplate: _.template($('#sidebar-recent-entries-row-template').html()),


        events: {
            'click a': 'update'
        },


        _spinner: function() {
            // create spinner
            this.$el.find('.load').spin({
                lines: 5,
                length: 0,
                width: 2,
                radius: 4,
                speed: 1.8,
                color: '#888'
            });

            // hide spinner
            this.hideSpinner();
        },


        hideSpinner: function() {
            this.$el.find('.load').hide();
        },


        initialize: function() {
            this.listenTo(ppma.Collection.RecentEntries, 'sync', this.refresh);

            // fetch last entries
            ppma.Collection.RecentEntries.fetch();

            // refresh last entries every 5 seconds
            var delay   = 5000;
            var refresh = $.proxy(function() {
                // show spinner
                this.showSpinner();

                // get last entries
                ppma.Collection.RecentEntries.fetch();

                // call this function in `delay` again
                _.delay(refresh, delay);
            }, this);
            _.delay(refresh, delay);

            // refresh last entries after every "add" and "remove" to Entry-Collection
            this.listenToOnce(ppma.Collection.Entries, 'sync', function() {
                this.listenTo(ppma.Collection.Entries, 'sync', function() {
                    ppma.Collection.RecentEntries.fetch();
                });
                this.listenTo(ppma.Collection.Entries, 'remove', function() {
                    ppma.Collection.RecentEntries.fetch();
                })
            })
        },


        refresh: function(collection) {
            this.$el.find('li').not('.nav-header').remove();
            this.hideSpinner();

            _.each(collection.models, $.proxy(function(model) {
                // render to <li>
                var entry = $( this._rowTemplate(model.toJSON()) );

                // add id
                entry.data('id', model.id);

                // add to dom
                this.$el.find('li.nav-header').after(entry);
            }, this))
        },


        render: function() {
            this.$el.html( this._template() );

            // add ajax-spin
            this._spinner();

            // make chainable
            return this;
        },


        showSpinner: function() {
            this.$el.find('.load').fadeIn();
        },


        update: function(event) {
            var id    = $(event.target).parent().data('id');
            var model = ppma.Collection.Entries.get(id);

            ppma.View.Entry.Modal.update(model);
        }

    });

});