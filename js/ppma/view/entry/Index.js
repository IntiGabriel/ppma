$(function() {
    'use strict';

    var Index = Backbone.View.extend({

        el: '#entry-list',

        _rowTemplate: null,

        initialize: function() {
            this.$el.hide();
            this._rowTemplate = this.$el.find('.template.record');

            ppma.Collection.Entries.on('add', $.proxy(function(model) {
                var row = this._rowTemplate.clone().removeClass('hide').hide();

                // set date
                row.find('.name').html(model.get('name'));
                row.find('.username').html(model.get('username'));
                row.find('.tags').html(model.get('tags'));

                this._rowTemplate.after(row.fadeIn());

                // show table
                this.$el.fadeIn();
            }), this);
        }

    });

    ppma.View.Entry.Index = new Index();

});