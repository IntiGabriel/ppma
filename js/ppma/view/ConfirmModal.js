$(function() {
    'use strict';

    /**
     * @fires submit will be triggered if form is submitted
     * @fires hide   will be triggered if modal is hidden
     * @fires show   will be triggered if modal is shown
     * @fires cancel will be triggered if form is canceled
     * @type {object}
     */
    var ConfirmModal = Backbone.View.extend({

        el: '#modal-confirm',

        events: {
            'click .btn-primary': 'submit',
            'click .cancel':      'cancel'
        },


        bindShortcuts: function() {
            Mousetrap.bind('esc', $.proxy(this.cancel, this));
            Mousetrap.bind('y', $.proxy(this.submit, this));
        },



        cancel: function() {
            this.trigger('cancel');
            this.hide();
        },


        hide: function() {
            this.trigger('hide');
            this.unbindShortcuts();
            ppma.AjaxLoader.setActive( ppma.AjaxLoader.ACTIVE_CONTENT );
            this.$el.modal('hide');
        },


        show: function() {
            this.trigger('hide');
            this.bindShortcuts();
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
        },


        unbindShortcuts: function() {
            Mousetrap.unbind('esc');
            Mousetrap.unbind('y');
        }

    });


    ppma.View.ConfirmModal = new ConfirmModal();

});