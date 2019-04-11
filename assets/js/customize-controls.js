/**
 * Scripts within the customizer controls window.
 *
 * Contextually shows the color hue control and informs the preview
 * when users open or close the front page sections section.
 */

(function ($) {

    'use strict';

    wp.customize.bind('ready', function () {

        // Only show the color hue control when there's a custom color scheme.
        wp.customize('color_enable', function (setting) {

            wp.customize.control('primary_color', function (control) {
                var visibility = function () {
                    if (setting.get()) {
                        control.container.show();
                    } else {
                        control.container.hide();
                    }
                };

                visibility();
                setting.bind(visibility);
            });

            wp.customize.control('secondary_color', function (control) {
                var visibility = function () {
                    if (setting.get()) {
                        control.container.show();
                    } else {
                        control.container.hide();
                    }
                };

                visibility();
                setting.bind(visibility);
            });

            wp.customize.control('text_primary_color', function (control) {
                var visibility = function () {
                    if (setting.get()) {
                        control.container.show();
                    } else {
                        control.container.hide();
                    }
                };

                visibility();
                setting.bind(visibility);
            });

            wp.customize.control('text_secondary_color', function (control) {
                var visibility = function () {
                    if (setting.get()) {
                        control.container.show();
                    } else {
                        control.container.hide();
                    }
                };

                visibility();
                setting.bind(visibility);
            });

        });

    });

})(jQuery);
