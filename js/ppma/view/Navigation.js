$(function() {
    'use strict';

    var Navigation = Backbone.View.extend({

        el: '#navigation',

        events: {
            'click .show-entry-modal':    function() { ppma.View.Entry.Content.create(); },
            'click .show-password-modal': function() { ppma.View.Settings.Modal.show(); return false; }
        },


        initialize:  function() {
            this.$el.hide().fadeIn('slow');
        }


    });

    ppma.View.Navigation = new Navigation();

});