$(function() {
    'use strict';

    var Entries = Backbone.Collection.extend({

        model: ppma.Model.Entry,

        url: 'index.php?r=api/entry'

    });

    ppma.Collection.Entries = new Entries();

});