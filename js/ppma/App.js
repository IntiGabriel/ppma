// @TODO move to bootstrap
// set template settings
_.templateSettings = {
    interpolate : /\{\{(.+?)\}\}/g
};


$(function() {
    'use strict';

    // add shortcuts


    // fetch all entries
    ppma.Collection.Entries.fetch();

});