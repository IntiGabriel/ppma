$(function() {
    'use strict';

    ppma.View.Entry.Grid = Backbone.View.extend({

        _template: _.template($('#entry-grid-template').html()),

        events: {
            'click th.sortable': 'sort'
        },


        add: function(model) {
            // create row
            var row = new ppma.View.Entry.Row({ model: model });

            // add row to table
            this.$el.find('tbody').prepend( row.render().el );
        },


        refresh: function() {
            this.$el.find('tbody').empty();

            this.$el.find('table').attr('class', 'table table-striped');
            this.$el.find('td').removeAttr('class');

            _.each(ppma.Collection.Entries.models, $.proxy(function(model) {
                this.add(model);
            }, this));
        },


        initialize: function() {
            // add callbacks
            this.listenTo(ppma.Collection.Entries, 'add', this.refresh);
            this.listenTo(ppma.Collection.Entries, 'sort', this.refresh);
        },


        render: function() {
            this.$el.html( this._template() );
            return this;
        },


        sort: function(event) {
            ppma.Collection.Entries.sortAttribute = $(event.target).attr('rel');
            ppma.Collection.Entries.sort();
        }

    });

});