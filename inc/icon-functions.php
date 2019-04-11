<?php

/**
 * Returns an array of supported social links (URL and icon name).
 *
 * @return array $social_links_icons
 */
function dd_base_social_links_icons() {
	// Supported social links icons.
	$social_links_icons = array(
		'behance.net'     => 'behance',
		'codepen.io'      => 'codepen',
		'deviantart.com'  => 'deviantart',
		'digg.com'        => 'digg',
		'dribbble.com'    => 'dribbble',
		'dropbox.com'     => 'dropbox',
		'facebook.com'    => 'facebook',
		'flickr.com'      => 'flickr',
		'foursquare.com'  => 'foursquare',
		'plus.google.com' => 'google-plus',
		'github.com'      => 'github',
		'instagram.com'   => 'instagram',
		'linkedin.com'    => 'linkedin',
		'mailto:'         => 'envelope-o',
		'medium.com'      => 'medium',
		'pinterest.com'   => 'pinterest-p',
		'getpocket.com'   => 'get-pocket',
		'reddit.com'      => 'reddit-alien',
		'skype.com'       => 'skype',
		'skype:'          => 'skype',
		'slideshare.net'  => 'slideshare',
		'snapchat.com'    => 'snapchat-ghost',
		'soundcloud.com'  => 'soundcloud',
		'spotify.com'     => 'spotify',
		'stumbleupon.com' => 'stumbleupon',
		'tumblr.com'      => 'tumblr',
		'twitch.tv'       => 'twitch',
		'twitter.com'     => 'twitter',
		'vimeo.com'       => 'vimeo',
		'vine.co'         => 'vine',
		'vk.com'          => 'vk',
		'wordpress.org'   => 'wordpress',
		'wordpress.com'   => 'wordpress',
		'yelp.com'        => 'yelp',
		'youtube.com'     => 'youtube',
	);

	/**
	 * Filter DD Base social links icons.
	 *
	 * @since 1.0
	 *
	 * @param array $social_links_icons
	 */
	return apply_filters( 'dd_base\social_links_icons', $social_links_icons );
}


/**
 * Return Icon markup.
 *
 * @param string $icon Required icon filename.
 *
 * @return string Icon markup.
 */
function dd_base_get_icon( $icon ) {
	if ( empty( $icon ) ) {
		return __( 'Please define icon', 'dd-base' );
	}

	return '<i class="fa fa-' . esc_attr( $icon ) . '"></i>';
}

/**
 * Display font-awesome icons in social links menu.
 *
 * @param  string $item_output The menu item output.
 * @param  WP_Post $item Menu item object.
 * @param  int $depth Depth of the menu.
 * @param  array $args wp_nav_menu() arguments.
 *
 * @return string  $item_output The menu item output with social icon.
 */
function dd_base_nav_menu_social_icons( $item_output, $item, $depth, $args ) {

	// Get supported social icons.
	$social_icons = dd_base_social_links_icons();
	// Change font-awesome icon inside social links menu if there is supported URL.
	if ( isset( $args->theme_location ) && 'social' === $args->theme_location ) {
		foreach ( $social_icons as $attr => $value ) {
			if ( false !== strpos( $item_output, $attr ) ) {
				$item_output = str_replace( $args->link_after, '</span>' . dd_base_get_icon( $value ), $item_output );
			}
		}
	}

	return $item_output;
}

add_filter( 'walker_nav_menu_start_el', 'dd_base_nav_menu_social_icons', 10, 4 );
