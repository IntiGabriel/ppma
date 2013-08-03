$(function() {
    'use strict';

    // add shortcuts
    keymage('alt-c', $.proxy(ppma.View.Entry.Modal.show, ppma.View.Entry.Modal));

    // fetch all entries
    ppma.Collection.Entries.fetch();

});