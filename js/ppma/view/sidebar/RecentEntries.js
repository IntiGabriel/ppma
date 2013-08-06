$(function() {
    'use strict';

    ppma.View.Sidebar.RecentEntries = Backbone.View.extend({

        _template:    _.template($('#sidebar-recent-entries-template').html()),

        _rowTemplate: _.template($('#sidebar-recent-entries-row-template').html()),


        events: {
            'click a': 'update'
        },


        initialize: function() {
            this.listenTo(ppma.Collection.RecentEntries, 'sync', this.refresh);

            // fetch last entries
            ppma.Collection.RecentEntries.fetch();

            // refresh last entries every 5 seconds
            var delay   = 5000;
            var refresh = function() {
                ppma.Collection.RecentEntries.fetch();
                _.delay(refresh, delay);
            }
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
            return this;
        },


        update: function(event) {
            var id    = $(event.target).parent().data('id');
            var model = ppma.Collection.Entries.get(id);

            ppma.View.Entry.Modal.update(model);
        }

    });

});