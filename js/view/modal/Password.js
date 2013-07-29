$(function() {
    'use strict';

    var Password = Backbone.View.extend({

        el: '#modal-password',

        show: function() {
            this.$el.modal('show');
            this.$el.find(':password').first().click().focus();
        }

    });

    window.ppma.view.modal.Password = new Password();

});