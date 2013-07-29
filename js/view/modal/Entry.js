$(function() {
    'use strict';

    var Entry = Backbone.View.extend({

        el: '#modal-entry',

        _showClassName: '.show-entry-modal',


        initialize: function() {
            $(this._showClassName).click( $.proxy(this.show, this) );
        },


        show: function() {
            this.$el.modal('show');
            this.$el.find(':text').first().click().focus();
            return false;
        }

    });

    window.ppma.view.modal.Entry = new Entry();

});