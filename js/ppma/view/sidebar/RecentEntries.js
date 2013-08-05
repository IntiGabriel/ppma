$(function() {
    'use strict';

    ppma.View.Sidebar.RecentEntries = Backbone.View.extend({

        _template:    _.template($('#sidebar-recent-entries-template').html()),

        _rowTemplate: _.template($('#sidebar-recent-entries-row-template').html()),


        events: {
            'click a': 'update'
        },


        add: function(model) {
            // render to <li>
            var entry = $( this._rowTemplate(model.toJSON()) );

            // add id
            entry.data('id', model.id);

            // add to dom
            this.$el.find('ul').append(entry);
        },


        initialize: function() {
            this.listenTo(ppma.Collection.Entries, 'add', this.add);
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