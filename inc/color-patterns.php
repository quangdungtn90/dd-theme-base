<?php

/**
 * DD Base: Color Patterns
 *
 * @package DD_Base
 * @since 1.0
 */

/**
 * Generate the CSS for the current custom color scheme.
 */
function dd_base_custom_colors_css() {

	if ( !get_theme_mod( 'color_enable', 0 ) ) {
		return '';
	}

	$css = WP_DEBUG ? '' : get_transient( 'dd_base_custom_colors_css' );

	$primary_color = '';
	$secondary_color = '';
	$text_primary_color = '';
	$text_secondary_color = '';

	if ( empty( $css ) || is_customize_preview() ) {

		$primary_color = esc_attr( get_theme_mod( 'primary_color', '' ) );
		$secondary_color = esc_attr( get_theme_mod( 'secondary_color', '' ) );
		$text_primary_color = esc_attr( get_theme_mod( 'text_primary_color', '' ) );
		$text_secondary_color = esc_attr( get_theme_mod( 'text_secondary_color', '' ) );

		$css = '
	/**
	 * DD Base: Color Patterns
	 *
	 * 1. Primary Color
	 * 2. Secondary Color
	 * 3. Text Primary Color
	 * 4. Text Secondary Color
	 */
				
	.primary_color, a, .biography__title a:hover, .entry-meta a:hover, .site-header-menu .primary-menu .menu-item:hover > a, .site-branding-text .site-title a:hover, .widget-title a:hover, .widget_calendar .calendar_wrap table tfoot a, .minilist .buttons a.checkout:hover, .minicart__content .buttons a.checkout:hover, .miniwishlist__content .buttons a.checkout:hover, .minilist .buttons a:hover, .minicart__content .buttons a:hover, .miniwishlist__content .buttons a:hover, .account_nav__content li a:hover, .site-footer .site-info .social-navigation a:hover{
        color:'.$primary_color.';
    }
    .primary_bg_color, .dd-base-btn, #comments .comment-list .comment .comment-body .reply .comment-reply-link, #comments #respond .comment-form .form-submit .submit, .post-password-form input[type="submit"], .dd-base-btn.dd-base-btn--secondary:hover, .post-password-form input.dd-base-btn--secondary[type="submit"]:hover, .site-breadcrumb, .entry-header .sticky-post, .comments-pagination .nav-links .page-numbers.current, .comments-pagination .nav-links .page-numbers:hover, .pagination .nav-links .page-numbers.current, .pagination .nav-links .page-numbers:hover, .page-links > span, .minilist .buttons a.checkout, .minicart__content .buttons a.checkout, .miniwishlist__content .buttons a.checkout{
        background-color:'.$primary_color.';
    }
    .primary_bd_color, input[type="email"]:focus, input[type="number"]:focus, input[type="password"]:focus, input[type="tel"]:focus, input[type="url"]:focus, input[type="text"]:focus, input[type="search"]:focus, select:focus, textarea:focus, .dd-base-btn, #comments .comment-list .comment .comment-body .reply .comment-reply-link, #comments #respond .comment-form .form-submit .submit, .post-password-form input[type="submit"], .dd-base-btn.dd-base-btn--secondary:hover, .post-password-form input.dd-base-btn--secondary[type="submit"]:hover, .minilist .buttons a.checkout, .minicart__content .buttons a.checkout, .miniwishlist__content .buttons a.checkout, .minilist .buttons a.checkout:hover, .minicart__content .buttons a.checkout:hover, .miniwishlist__content .buttons a.checkout:hover, .minilist .buttons a:hover, .minicart__content .buttons a:hover, .miniwishlist__content .buttons a:hover{
        border-color: '.$primary_color.';
    }
        
	
	/**
	 * @Secondary
	 */
    .secondary_color, a:hover, a:focus, a:active, .site-breadcrumb .dd-base-breadcrumb a:hover, .site-breadcrumb .woocommerce-breadcrumb a:hover, #comments .comment-list .comment .comment-body .comment-meta .comment-author .fn a:hover, #comments .comment-list .comment .comment-body .comment-meta .comment-metadata a:hover, blockquote:before, .search-form button:hover, .widget ul li a:hover, .widget_calendar .calendar_wrap table tfoot a:hover, .widget_tag_cloud .tagcloud a:hover, .social-links li a:hover, .social-navigation ul li a:hover, .user-contact-methods li a:hover {
        color:'.$secondary_color.';
    }
    .secondary_bg_color, .dd-base-btn:hover, #comments .comment-list .comment .comment-body .reply .comment-reply-link:hover, #comments #respond .comment-form .form-submit .submit:hover, .post-password-form input[type="submit"]:hover, .dd-base-btn.dd-base-btn--secondary, #comments .comment-list .comment .comment-body .reply .dd-base-btn--secondary.comment-reply-link, #comments #respond .comment-form .form-submit .dd-base-btn--secondary.submit, .post-password-form input.dd-base-btn--secondary[type="submit"], .widget-title:after{
        background-color: '.$secondary_color.';
    }
	
    .secondary_bd_color, .dd-base-btn:hover, #comments .comment-list .comment .comment-body .reply .comment-reply-link:hover, #comments #respond .comment-form .form-submit .submit:hover, .post-password-form input[type="submit"]:hover, .dd-base-btn.dd-base-btn--secondary, #comments .comment-list .comment .comment-body .reply .dd-base-btn--secondary.comment-reply-link, #comments #respond .comment-form .form-submit .dd-base-btn--secondary.submit, .post-password-form input.dd-base-btn--secondary[type="submit"], .widget_tag_cloud .tagcloud a:hover, .minilist ul li a.remove:hover, .minicart__content ul li a.remove:hover, .miniwishlist__content ul li a.remove:hover{
        border-color: '.$secondary_color.';
    }
		
	
	/**
	 * @Primary Text Color
	 */
	.primary_text_color, body, .biography__content .user-contact-methods, .comments-pagination .nav-links .page-numbers, .pagination .nav-links .page-numbers, .post-navigation a, .minicart__content, .miniwishlist__content, .account_nav__content li a {
        color: '.$text_primary_color.';
    }
        
    /**
	 * @Primary Text Color
	 */
	
	.secondary_text_color, .wp-caption-text, caption, .biography__weburl, .biography__body, #comments .comment-list .comment .comment-body .comment-meta .comment-metadata a, .entry-footer .entry-share a, .entry-meta a, .post-navigation .nav-subtitle, .site-branding-text .site-description, .widget_recent_entries ul li .post-date, .widget.dd_base_widget_posts ul li .post-date, .widget.dd_base_widget_posts .post-comment, .minicart__content .widget.widget_shopping_cart .cart_list .mini_cart_item .quantity, .minicart__content .widget.widget_shopping_cart .total strong, .minilist ul li .amount, .minicart__content ul li .amount, .miniwishlist__content ul li .amount, .miniwishlist .miniwishlist__item-empty {
            color: '.$text_secondary_color.';
        }
	';
		if ( !WP_DEBUG ) {
			set_transient( 'dd_base_custom_colors_css', $css );
		}
	}

	/**
	 * Filters DD Base custom colors CSS.
	 *
	 * @since 1.0
	 *
	 * @param $css        string Base theme colors CSS.
	 * @param $hue        int    The user's selected color hue.
	 * @param $saturation string Filtered theme color saturation level.
	 */
	return apply_filters( 'dd_base\custom_colors_css', $css, $primary_color, $secondary_color, $text_primary_color, $text_secondary_color );
}
