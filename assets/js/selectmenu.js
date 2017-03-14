$(document).ready(function() {

    $(window).resize(responsive);
    $(window).trigger('resize');

});

function responsive() {

    // get resolution
    var resolution = document.documentElement.clientWidth;

    // mobile layout
    if (resolution < 979) {

        if ($('.select-menu').length === 0) {

            // create select menu
            var select = $('<select></select>');

            // add classes to select menu
            select.addClass('select-menu input-block-level');

            // each link to option tag
            $('.navbar-nav li a').each(function() {
                // create element option
                var option = $('<option></option>');

                // add href value to jump
                option.val(this.href);

                // add text
                option.text($(this).text());

                // append to select menu
                select.append(option);
            });

            // add change event to select
            select.change(function() {
                window.location.href = this.value;
            });

            // add select element to dom, hide the .nav-tabs
            $('.navbar-nav').before(select).hide();

        }

    }

    // max width 979px
    if (resolution > 979) {
        $('.select-menu').remove();
        $('.navbar-nav').show();
    }

}