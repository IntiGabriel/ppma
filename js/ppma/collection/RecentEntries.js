$(function() {
    'use strict';

    var RecentEntries = Backbone.Collection.extend({

        model: ppma.Model.Entry,

        url: 'index.php?r=api/entry/recent',

        parse: function(response) {
            return response.data;
        }

    });

    ppma.Collection.RecentEntries = new RecentEntries();

});