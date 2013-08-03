$(function() {
    'use strict';

    // add shortcuts
    Mousetrap.bind('alt+c', $.proxy(ppma.View.Entry.Modal.show, ppma.View.Entry.Modal));

    // set template settings
    _.templateSettings = {
        interpolate : /\{\{(.+?)\}\}/g
    };

    // fetch all entries
    ppma.Collection.Entries.fetch();



});