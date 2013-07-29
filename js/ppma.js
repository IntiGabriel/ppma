var Navigation = Backbone.Model.extend({

    el: null,

    initialize: function() {
        this.el = $('#navigation');

        // entry modal
        this.el.find('.show-entry-modal').click(this.showEntryModal);

        // password modal
        this.el.find('.show-password-modal').click(this.showPasswordModal);
    },


    showEntryModal: function() {
        var modal = $('#modal-entry');
        modal.modal('show');
        modal.find(':text').first().click().focus();
        return false;
    },


    showPasswordModal: function() {
        var modal = $('#modal-password');
        modal.modal('show');
        modal.find(':password').first().click().focus();
        return false;
    }

});

$(function() {
    window.navigation = new Navigation();
});
