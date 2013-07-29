$(function() {
    'use strict';

    var Entry = Backbone.Model.extend({

        defaults: {
            'name':     '',
            'password': ''
        },

        urlRoot: 'index.php?r=entry/api'

    });

    window.ppma.model.Entry = new Entry();

});