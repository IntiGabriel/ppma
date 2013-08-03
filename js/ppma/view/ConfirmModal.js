$(function() {
    'use strict';

    var ConfirmModal = Backbone.View.extend({

        el: '#modal-confirm',

        events: {
            'click .btn-primary': 'submit',
            'click .cancel':      'cancel'
        },


        cancel: function() {
            this.trigger('cancel');
        },


        hide: function() {
            ppma.AjaxLoader.setActive( ppma.AjaxLoader.ACTIVE_CONTENT );
            this.$el.modal('hide');
        },


        show: function() {
            ppma.AjaxLoader.setActive( ppma.AjaxLoader.ACTIVE_MODAL );
            this.$el.modal('show');
        },


        setHeader: function(text) {
            this.$el.find('h3').text(text);
        },


        setMessage: function(msg) {
            this.$el.find('.message').text(msg);
        },


        submit: function() {
            this.trigger('submit');
            this.hide();
        }

    });


    ppma.View.ConfirmModal = new ConfirmModal();

});