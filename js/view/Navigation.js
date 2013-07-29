$(function() {
    'use strict';

    var Navigation = Backbone.View.extend({

        el: '#navigation',

        events: {
            'click .show-entry-modal':    function() { ppma.view.modal.Entry.show(); return false; },
            'click .show-password-modal': function() { ppma.view.modal.Password.show(); return false; }
        }

    });

    ppma.view.Navigation = new Navigation();

});