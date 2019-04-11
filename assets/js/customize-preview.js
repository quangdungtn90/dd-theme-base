/**
 * File customize-preview.js.
 *
 * Instantly live-update customizer settings in the preview for improved user experience.
 */

(function ($) {

    'use strict';

    // Site title and description.
    wp.customize('blogname', function (value) {
        value.bind(function (to) {
            $('.site-title a').text(to);
        });
    });
    wp.customize('blogdescription', function (value) {
        value.bind(function (to) {
            $('.site-description').text(to);
        });
    });


    // Header text color.
    wp.customize('header_textcolor', function (value) {
        value.bind(function (to) {
            if ('blank' === to) {
                $('.site-title, .site-description').css({
                    clip: 'rect(1px, 1px, 1px, 1px)',
                    position: 'absolute'
                });
                // Add class for different logo styles if title and description are hidden.
                $('body').addClass('title-tagline-hidden');
            } else {
                $('.site-title, .site-description').css({
                    clip: 'auto',
                    position: 'relative'
                });
                // Add class for different logo styles if title and description are visible.
                $('body').removeClass('title-tagline-hidden');
            }
        });
    });


    String.prototype.replaceAll = function (str1, str2, ignore) {
        return this.replace(new RegExp(str1.replace(/([\/\,\!\\\^\$\{\}\[\]\(\)\.\*\+\?\|\<\>\-\&])/g, "\\$&"), (ignore ? "gi" : "g")), (typeof (str2) == "string") ? str2.replace(/\$/g, "$$$$") : str2);
    }

    // Custom Primary color
    wp.customize('primary_color', function (value) {
        value.bind(function (to) {
            console.log();
            // Update custom color CSS.
            var style = $('#dd-base-style-inline-css'),
                    color = dd_base_color.primary_color,
                    css = style.html();

            // Equivalent to css.replaceAll, with hue followed by comma to prevent values with units from being changed.

            css = css.replaceAll(color, to);
            dd_base_color.primary_color = to;
            style.html(css);
        });
    });

    // Custom Secondary color
    wp.customize('secondary_color', function (value) {
        value.bind(function (to) {
            // Update custom color CSS.
            var style = $('#dd-base-style-inline-css'),
                    color = dd_base_color.secondary_color,
                    css = style.html();

            // Equivalent to css.replaceAll, with hue followed by comma to prevent values with units from being changed.

            css = css.replaceAll(color, to);
            dd_base_color.secondary_color = to;
            style.html(css);
        });
    });

    // Custom Primary Color
    wp.customize('text_primary_color', function (value) {
        value.bind(function (to) {
            // Update custom color CSS.
            var style = $('#dd-base-style-inline-css'),
                    color = dd_base_color.text_primary_color,
                    css = style.html();

            // Equivalent to css.replaceAll, with hue followed by comma to prevent values with units from being changed.

            css = css.replaceAll(color, to);
            dd_base_color.text_primary_color = to;
            style.html(css);
        });
    });

    // Custom Text secondary
    wp.customize('text_secondary_color', function (value) {
        value.bind(function (to) {
            // Update custom color CSS.
            var style = $('#dd-base-style-inline-css'),
                    color = dd_base_color.text_secondary_color,
                    css = style.html();

            // Equivalent to css.replaceAll, with hue followed by comma to prevent values with units from being changed.

            css = css.replaceAll(color, to);
            dd_base_color.text_secondary_color = to;
            style.html(css);
        });
    });


    /**
     * 404 Page
     */
    wp.customize('404_title', function (value) {
        value.bind(function (to) {
            $('.error-404 .entry-title').text(to);
        });
    });

    wp.customize('404_content', function (value) {
        value.bind(function (to) {
            $('.error-404 .description').text(to);
        });

    });

})(jQuery);
