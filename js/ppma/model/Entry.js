$(function() {
    'use strict';

    ppma.Model.Entry = Backbone.Model.extend({

        defaults: {
            'id':       '',
            'name':     '',
            'username': '',
            'password': ''
        },

        url: 'index.php?r=api/entry',

        initialize: function() {
            // handle success-event
            this.on('sync', function(model) {
                var isError = model.get('error');

                // growl response
                ppma.Growl.processMessages(model.get('messages'), isError);

                if (!isError) {
                    // add model to collection
                    ppma.Collection.Entries.add(model);
                }
            });
        }


    });

});