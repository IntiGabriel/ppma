$(function() {
    'use strict';

    var Entries = Backbone.Collection.extend({

        model: ppma.Model.Entry,

        url: 'index.php?r=api/entry',

        parse: function(response) {
            return response.data;
        }

    });



    ppma.Collection.Entries = new Entries();

});