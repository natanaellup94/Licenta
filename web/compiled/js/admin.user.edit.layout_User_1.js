$(document).ready(function () {
    var plainPasswordInput = $('input[id$="_plainPassword"]');
    var plainPasswordLabel = $('label[for$="_plainPassword"]');
    var pageTitle = $('.navbar-header').text().trim();
    var form = $('form');

    if (pageTitle != 'Create') {
        plainPasswordLabel.attr('aria-required', 'false');
        plainPasswordLabel.removeClass('required');

        form.on('submit', function (event) {
            if (plainPasswordInput.val() === '' && plainPasswordInput.attr('disabled') != 'disabled') {
                plainPasswordInput.attr('disabled', 'disabled');
                event.preventDefault();
                $(this).trigger('submit');
            }
        });
    }
})
