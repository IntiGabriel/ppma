$(function() {
    'use strict';

    // ajax loader
    $('.ajax-load').spin('modal', '#AAA');
    $('.ajax-load').hide();

    $(document).ajaxStart(function() {
        $('.ajax-load').fadeIn();
    })
    $(document).ajaxComplete(function() {
        $('.ajax-load').fadeOut();
    });

    window.ppma        = {};
    ppma.Collection    = {};
    ppma.Model         = {};
    ppma.View          = {};
    ppma.View.Entry    = {};
    ppma.View.Settings = {};

});