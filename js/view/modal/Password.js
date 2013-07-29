$(function() {
    'use strict';

    var Password = Backbone.View.extend({

        el: '#modal-password',

        _showClassName: '.show-password-modal',


        initialize: function() {
            $(this._showClassName).click( $.proxy(this.show, this) );
        },

        
        show: function() {
            this.$el.modal('show');
            this.$el.find(':password').first().click().focus();
            return false;
        }

    });

    window.ppma.view.modal.Password = new Password();

});