$(function() {
    'use strict';

    ppma.Model.Entry = Backbone.Model.extend({

        defaults: {
            'name':       '',
            'categoryId': '1',
            'username':   '',
            'password':   '',
            'url'     :   '',
            'comment' :   '',
            'tagList' :   ''
        }

    });

});