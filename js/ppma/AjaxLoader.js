$(function() {
    'use strict';

    var AjaxLoader = Backbone.View.extend({

        ACTIVE_CONTENT: 'content',

        ACTIVE_MODAL: 'dialog',

        el: '.ajax-load',

        active: 'content',


        hide: function() {
            this.$el.fadeOut();
        },


        initialize: function() {
            // create spinner
            this.$el.spin({
                lines: 5,
                length: 0,
                width: 11,
                radius: 0,
                trail: 50,
                speed: 1.5,
                color: '#AAA'
            });

            // hide spinner
            this.$el.hide();

            // bind callbacks to ajax events
            $(document).ajaxStart($.proxy(this.show, this));
            $(document).ajaxComplete($.proxy(this.hide, this));
        },


        setActive: function(active) {
            this.active = active;
        },


        show: function() {
            this.$el.filter('.' + this.active).fadeIn();
        }

    });

    ppma.AjaxLoader = new AjaxLoader();

});