// @TODO move to bootstrap
// set template settings
_.templateSettings = {
    interpolate : /\{\{(.+?)\}\}/g
};


$(function() {
    'use strict';

    // @TODO move to an own class
    /*
    $('aside').sortable({
        containerSelector: 'aside',
        itemSelector: '.well',
        placeholder: '<div>placeh</div>'
    });
    */

    $( 'aside' ).sortable({
        handle: '.icon-move',
        revert: true,
        forcePlaceholderSize: true,
        opacity: 0.75
    });


    // fetch all entries
    ppma.Collection.Entries.fetch();

});