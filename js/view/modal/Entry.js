$(function() {
    'use strict';

    var Entry = Backbone.View.extend({

        el: '#modal-entry',


        show: function() {
            this.$el.modal('show');
            this.$el.find(':text').first().click().focus();
        }

    });

    window.ppma.view.modal.Entry = new Entry();

});