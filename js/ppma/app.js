$(function() {
    'use strict';

    ppma.Collection.Entries.fetch();

    // add shortcuts
    keymage('alt-c', $.proxy(ppma.View.Entry.Modal.show, ppma.View.Entry.Modal));

});