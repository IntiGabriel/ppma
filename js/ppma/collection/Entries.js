$(function() {
    'use strict';

    var Entries = Backbone.Collection.extend({

        model: ppma.Model.Entry,

        url: 'index.php?r=entry/api'

    });

    ppma.Collection.Entries = new Entries();

});