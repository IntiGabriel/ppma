$(function() {

    $('.update-entry').live('click', function() {
        $('#entry-form-modal form').attr('action', $(this).attr('href'));

        $.ajax($(this).attr('rel'), {
            'success': function(response) {
                $.each(response, function(key, value) {
                    $('#entry-form-modal #' + key).val(value);
                });

                // clear checkboxes
                $.each($('#entry-form-modal .tree-box input[type=checkbox]'), function(index, element) {
                    if ($(element).is(':checked')) {
                        $(element).next().click();
                    }
                });

                // set checkboxes
                $.each(response.Entry_categoryIds, function(key, value) {
                    $('#Entry_categoryIds_' + value).next().click();
                });
            }
        });

        return false
    });

});