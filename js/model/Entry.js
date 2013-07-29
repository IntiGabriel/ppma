$(function() {
    'use strict';

    ppma.model.Entry = Backbone.Model.extend({

        defaults: {
            'id':       '',
            'name':     '',
            'username': '',
            'password': ''
        }

    });

});