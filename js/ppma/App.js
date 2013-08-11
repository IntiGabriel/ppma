// @TODO move to bootstrap
// set template settings
_.templateSettings = {
    interpolate : /\{\{(.+?)\}\}/g
};


$(function() {
    'use strict';

    // @TODO move to an own class
    $( 'aside' ).sortable({
        handle: '.icon-move',
        revert: true,
        forcePlaceholderSize: true,
        opacity: 0.75
    });


    var App = Backbone.Router.extend({

        routes: {
            'categories': 'categories',
            'entries':    'entries',
            '*path':      'default'
        },


        categories: function() {

        },


        default: function() {
            this.navigate('entries');
        },


        entries: function() {
            ppma.Collection.Entries.fetch();
            ppma.View.Entry.Content.show();
        },


        initialize: function() {
            Backbone.history.start();
        }

    });

    ppma.App = new App();

});