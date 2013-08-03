$(function() {
    'use strict';

    ppma.Model.Password = Backbone.Model.extend({

        defaults: {
            password: ''
        },


        url: function() {
            var base = 'index.php?r=api/password';

            if (this.isNew()) {
                return base;
            } else {
                return base + '/' + this.id;
            }
        }

    });

});