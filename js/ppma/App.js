$(function() {
    'use strict';

    // add shortcuts
    Mousetrap.bind('alt+c', $.proxy(ppma.View.Entry.Modal.show, ppma.View.Entry.Modal));

    // fetch all entries
    ppma.Collection.Entries.fetch();

});