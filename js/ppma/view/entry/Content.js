$(function() {
    'use strict';

    var Content = Backbone.View.extend({

        el: '#content',

        views: {
            index: new ppma.View.Entry.Index()
        },


        /**
         * @returns {boolean}
         * @private
         */
        _save: function() {
            var form  = ppma.View.Entry.Modal.$el;
            var model = new ppma.Model.Entry();

            // get attribues
            var attributes = {
                name:       form.find(':input.name').val(),
                username:   form.find(':input.username').val(),
                password:   form.find(':input.password').val(),
                url:        form.find(':input.url').val(),
                comment:    form.find(':input.comment').val(),
                tagList:    form.find(':input.tagList').val(),
                categoryId: form.find(':input.categoryId').val()
            };

            // set attributes to model
            model.set(attributes);

            // save modal and add to collection
            ppma.Collection.Entries.create(model, {
                add: false,
                wait: true,
                success: function(model, response) {
                    // set id to model
                    model.set('id', response.get('data').id);

                    // no errors
                    if (!response.get('error')) {
                        // add model to collection
                        ppma.Collection.Entries.add(model);

                        // hide modal
                        ppma.View.Entry.Modal.hide();

                        // growl success message
                        ppma.Growl.processMessages(response.get('messages'), false);
                    }
                    else {
                        // growl error messages
                        ppma.Growl.processMessages(response.get('messages'), true);
                    }
                }
            });

            return false;
        },


        create: function() {
            // bind callbacks
            this.listenTo(ppma.View.Entry.Modal, 'submit', this._save);

            // unbind callbacks on Modal#hide
            this.listenTo(ppma.View.Entry.Modal, 'hide', function() {
                this.stopListening(ppma.View.Entry.Modal, 'submit', this._save);
            });

            // show modal
            ppma.View.Entry.Modal.show();
        },


        initialize: function() {
            // add shortcut
            Mousetrap.bind('alt+c', $.proxy(this.create, this));

            // hide content
            this.$el.hide();

            // render view
            this.$el.append( this.views.index.render().el );

            // show content
            this.$el.fadeIn('slow');
        }


    });

    ppma.View.Entry.Content = new Content();

});