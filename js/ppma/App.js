$(function() {
    'use strict';

    // add shortcuts
    Mousetrap.bind('alt+c', $.proxy(ppma.View.Entry.Index.create, ppma.View.Entry.Index));

    // set template settings
    _.templateSettings = {
        interpolate : /\{\{(.+?)\}\}/g
    };

    // fetch all entries
    ppma.Collection.Entries.fetch();



});