// based on http://jquery-howto.blogspot.kr/2009/10/javascript-jquery-password-generator.html
$.extend({
    password: function (length, special) {
        var iteration = 0;
        var password = "";
        var randomNumber;

        if(special == undefined) {
            var special = true;
        }

        while(iteration < length) {
            randomNumber = (Math.floor((Math.random() * 100)) % 94) + 33;
            if(!special) {
                if ((randomNumber >= 33) && (randomNumber <= 47)) { continue; }
                if ((randomNumber >= 58) && (randomNumber <= 64)) { continue; }
                if ((randomNumber >= 91) && (randomNumber <= 96)) { continue; }
                if ((randomNumber >= 123) && (randomNumber <= 126)) { continue; }
            }

            iteration++;
            password += String.fromCharCode(randomNumber);
        }

        return password;
    }
});

$(function() {

    $('.generate-password').click(function() {
        // show password field if not shown
        if ($(this).parent().parent().find('input:first').attr('type') == 'password') {
            $('.show-hide-password:first').click();
        }

        // generate and set password
        $(this).parent().parent().find('input:first').val($.password(10));

        $(this).parent().parent().find('input:first').select();
    });

});