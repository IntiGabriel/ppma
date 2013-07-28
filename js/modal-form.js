$(function() {

    $('.modal-footer .btn-primary').click(function() {
        var modal = $(this).closest('.modal');
        var form  = modal.find('form');

        form.one('submit', function() {

            // send form
            $.ajax(form.attr('action'), {
                type: 'POST',
                data: form.serialize(),
                dataType: 'json',
                success: function(response) {
                    var growlType = 'success';

                    if (response.error) {
                        growlType = 'error';
                    }

                    // growl messages
                    $.each(response.messages, function(index, value) {
                        $.bootstrapGrowl(value, { type: growlType });
                    });

                    if (growlType == 'success') {
                        modal.modal('hide');
                    }
                }
            });

            // cancel submitting of form
            return false;
        })

        form.submit();
    });

});