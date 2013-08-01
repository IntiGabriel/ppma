$(function() {
    'use strict';

    var opts = {
        lines: 5, // The number of lines to draw
        length: 0, // The length of each line
        width: 11, // The line thickness
        radius: 0, // The radius of the inner circle
        corners: 1, // Corner roundness (0..1)
        rotate: 0, // The rotation offset
        direction: 1, // 1: clockwise, -1: counterclockwise
        color: '#AAA', // #rgb or #rrggbb
        speed: 1.5, // Rounds per second
        trail: 50, // Afterglow percentage
        shadow: false, // Whether to render a shadow
        hwaccel: false, // Whether to use hardware acceleration
        className: 'spinner', // The CSS class to assign to the spinner
        zIndex: 2e9, // The z-index (defaults to 2000000000)
        top: 'auto', // Top position relative to parent in px
        left: 'auto' // Left position relative to parent in px
    };
    var target = document.getElementById('ajax-load');
    var spinner = new Spinner(opts).spin(target);
    $('.spinner').hide();

    $(document).ajaxStart(function() {
        $('.spinner').fadeIn();
    })
    $(document).ajaxComplete(function() {
        $('.spinner').fadeOut();
    });

    window.ppma        = {};
    ppma.Collection    = {};
    ppma.Model         = {};
    ppma.View          = {};
    ppma.View.Entry    = {};
    ppma.View.Settings = {};

});