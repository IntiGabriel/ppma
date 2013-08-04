$(function() {
    'use strict';

    var Entries = Backbone.Collection.extend({

        model: ppma.Model.Entry,

        url: 'index.php?r=api/entry',

        sortAttribute: 'id',

        sortDirection: 'asc',

        comparator: function(a, b) {
            return a.get(this.sortAttribute);

            a = a.get(this.sortAttribute);
            b = b.get(this.sortAttribute);
            var x = 0;

            if (a > b) {
                x = -1;
            } else if (b > a) {
                x = 1;
            }

            if (this.sortDirection == 'desc') {
                x = x * -1;
            }

            return x;
            //return a.get(this.sortAttribute);
        },


        parse: function(response) {
            return response.data;
        }

    });



    ppma.Collection.Entries = new Entries();

});