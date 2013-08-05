$(function() {
    'use strict';

    ppma.View.Entry.Index = Backbone.View.extend({

        _template: _.template($('#entry-index-template').html()),

        views: {
            grid: new ppma.View.Entry.Grid()
        },


        render: function() {
            // set template
            this.$el.html(this._template());

            // add views
            this.$el.find('.grid').append( this.views.grid.render().el );

            // make chainable
            return this;
        }

    });

});