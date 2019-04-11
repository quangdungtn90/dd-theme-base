/**
 * Custom js
 *
 * Package: 1.0
 * Auth: quangdung.tn90@gmail.com
 *
 **/

(function ($) {
    'use strict';

    // Header Mobile
    if($('#primary-menu').length){
        var primary_menu = $('#primary-menu').clone();
        $('.site-header-mobile__nav').html('<ul class="site-header-mobile__primary-menu">' + primary_menu.html() + '</ul>');
    }


    (function () {
        var menu = $('.menu-item-has-children');
        var winWidth = $(window).width();
        menu.children().each(function() {
            if ($(this).hasClass('sub-menu')) {
                var outerWidth = $(this).outerWidth();
                var rightEdge = $(this).offset().left + outerWidth;
                if( rightEdge > winWidth ) {
                    // CSS:
                    // .submenu--right { left: auto; right: 0; }
                    $(this).addClass('right');
                }
            }
        });
    })();

    //Mobile menu
    $('.site-header-mobile__primary-menu li.menu-item-has-children').append('<span class="toggle-submenu"> </span>');
    $('.toggle-submenu').on('click',function () {
        $(this).toggleClass('open',300);
        $(this).parent().find('> .sub-menu').slideToggle(500);
    });

    $('.site-header-mobile__close-content i').on('click',function () {
        $(this).parent().parent().removeClass('show-content');
        $('.site-content-contain').removeClass('content-overlay');
    });

    $('.site-header-mobile__button-left').on('click',function () {
        $('.site-header-mobile__content-left').addClass('show-content');
        $('.site-content-contain').addClass('content-overlay');
    });

    $('#search-modal').on('shown.bs.modal',function(){
        $(this).find('.search-form input').focus();
    });

    $('.site-header-mobile__button-right').on('click',function () {
        $('.site-header-mobile__content-right').addClass('show-content');
        $('.site-content-contain').addClass('content-overlay');
    });

    $('.site-content-contain').on('click',function () {
        if($(this).hasClass('content-overlay')){
            $('.site-content-contain').removeClass('content-overlay');
            $('.site-header-mobile__content-left').removeClass('show-content');
            $('.site-header-mobile__content-right').removeClass('show-content');
        }
    });

    $(document).ready(function(){
        var e = $('.post .entry-content iframe');
        e.addClass('embed-responsive-item');
        e.parent().addClass('embed-responsive embed-responsive-16by9');

    });
})(jQuery);

