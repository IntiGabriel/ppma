$(function() {
    'use strict';

    var Content = Backbone.View.extend({

        el: 'aside',

        views: {
            recentEntries: new ppma.View.Sidebar.RecentEntries()
        },


        initialize: function() {
            // render view
            this.$el.append( this.views.recentEntries.render().el );

            // show content
            this.$el.hide().fadeIn('slow');
        }


    });

    ppma.View.Sidebar.Content = new Content();

});