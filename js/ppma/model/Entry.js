$(function() {
    'use strict';

    ppma.Model.Entry = Backbone.Model.extend({

        defaults: {
            'name':     '',
            'username': '',
            'password': '',
            'url'     : '',
            'comment' : '',
            'tagList' : ''
        }

    });

});