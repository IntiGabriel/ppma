$(function() {
    'use strict';

    var Entries = Backbone.Collection.extend({

        model: ppma.model.Entry,

        url: 'index.php?r=entry/api'

    });

    ppma.collection.Entries = new Entries();

});