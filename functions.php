<?php

/**
 * Themebase functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package DD_Base
 * @since 1.0
 */
/**
 * DD Base only works in WordPress 4.7 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.7-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';

	return;
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function dd_base_setup() {


	/*
	 * Make theme available for translation.
	 */
	load_theme_textdomain( 'dd-base' );

	/*
	 * Support WooCommerce
	 */
	add_theme_support( 'woocommerce' );


	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );


	add_theme_support( 'loop-pagination' );

	// Set the default content width.
	$GLOBALS['content_width'] = 1170;

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'dd-base' ),
		'social'  => esc_html__( 'Social Links Menu', 'dd-base' ),
	) );
	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
		'gallery',
		'audio',
	) );

	// Add theme support for Custom Logo.
	add_theme_support( 'custom-logo', array(
		'width'      => 269,
		'height'     => 45,
		'flex-width' => true,
	) );

	//Support custom header
	add_theme_support( 'custom-header' );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}

add_action( 'after_setup_theme', 'dd_base_setup' );

/**
 * Register custom fonts.
 */
function dd_base_fonts_url() {

	$fonts_url     = '';
	$font_families = array();
	/**
	 * Translators: If there are characters in your language that are not
	 * supported by Libre Franklin, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$primary = esc_html_x( 'on', 'Open Sans font', 'dd-base' );
	if ( 'off' !== $primary ) {
		$font_families[] = 'Open Sans:300,400,600,700,800';
	}

	$secondary = esc_html_x( 'on', 'Roboto Slab font', 'dd-base' );
	if ( 'off' !== $secondary ) {
		$font_families[] = 'Roboto Slab:400,700';
	}


	if ( ! empty( $font_families ) ) {
		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );

		$fonts_url = apply_filters( 'dd_base\fonts_url', $fonts_url );
	}

	return esc_url_raw( $fonts_url );
}

/**
 * Add preconnect for Google Fonts.
 *
 * @since DD_Base 1.0
 *
 * @param array $urls URLs to print for resource hints.
 * @param string $relation_type The relation type the URLs are printed.
 *
 * @return array $urls           URLs to print for resource hints.
 */
function dd_base_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'dd-base-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}

	return $urls;
}

add_filter( 'wp_resource_hints', 'dd_base_resource_hints', 10, 2 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function dd_base_widgets_init() {

	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'dd-base' ),
		'id'            => 'sidebar',
		'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'dd-base' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	$footer_column = apply_filters( 'dd_base\footer_column', 4 );

	register_sidebars( $footer_column, array(
		'name'          => esc_html__( 'Footer %d', 'dd-base' ),
		'id'            => 'sidebar-footer',
		'description'   => esc_html__( 'Add widgets here to appear in your footer column.', 'dd-base' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
}

add_action( 'widgets_init', 'dd_base_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function dd_base_scripts() {

	$min = WP_DEBUG ? '' : '.min';

	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'dd-base-fonts', dd_base_fonts_url(), array(), null );

	wp_enqueue_style( 'bootstrap', get_theme_file_uri( '/assets/css/bootstrap' . $min . '.css' ), array(), '4.0.0' );
	wp_enqueue_script( 'bootstrap', get_theme_file_uri( '/assets/js/bootstrap' . $min . '.js' ), array( 'jquery' ), '4.0.0', true );

	wp_enqueue_style( 'font-awesome', get_theme_file_uri( '/assets/css/font-awesome' . $min . '.css' ), array(), '4.7.0' );

	// Load the html5 shiv.
	wp_enqueue_script( 'html5', get_theme_file_uri( '/assets/js/html5.js' ), array(), '3.7.3' );
	wp_script_add_data( 'html5', 'conditional', 'lt IE 9' );

	// Theme stylesheet.
	wp_enqueue_style( 'dd-base-style', get_stylesheet_uri(), array( 'bootstrap' ), '1.0' );

	wp_enqueue_script( 'dd-base-global', get_theme_file_uri( '/assets/js/global' . $min . '.js' ), array( 'jquery' ), '1.0', true );

	$localize = apply_filters( 'dd_base\localize', array(
		'ajax_url' => admin_url( 'admin-ajax.php' )
	) );

	wp_localize_script( 'dd_base-global', 'dd_base_var', $localize );

	if ( get_theme_mod( 'color_enable', 0 ) || is_customize_preview() ) {
		$custom_css = dd_base_custom_colors_css();
		wp_add_inline_style( 'dd-base-style', $custom_css );
	}

	if ( is_customize_preview() ) {

		wp_localize_script( 'dd-base-global', 'dd_base_color', array(
			'primary_color'        => esc_attr( get_theme_mod( 'primary_color', '' ) ),
			'secondary_color'      => esc_attr( get_theme_mod( 'secondary_color', '' ) ),
			'text_primary_color'   => esc_attr( get_theme_mod( 'text_primary_color', '' ) ),
			'text_secondary_color' => esc_attr( get_theme_mod( 'text_secondary_color', '' ) )
		) );
	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_localize_script( 'dd-base-global', 'screenReaderText', array(
		'expand'   => esc_html__( 'expand child menu', 'dd-base' ),
		'collapse' => esc_html__( 'collapse child menu', 'dd-base' ),
	) );

	wp_localize_script( 'dd-base-global', 'dd_base_var', array(
		'ajax_url' => esc_url( admin_url( 'admin-ajax.php' ) )
	) );
}

add_action( 'wp_enqueue_scripts', 'dd_base_scripts' );

/**
 * Fix itemprop attribute custom logo
 */
function dd_base_get_custom_logo( $html ) {
	$html = str_replace( 'itemprop="url"', '', $html );
	$html = str_replace( 'itemprop="logo"', '', $html );
	return $html;
}
add_filter( 'get_custom_logo', 'dd_base_get_custom_logo' );

/**
 * Plugin installation and activation for the theme
 */
require get_parent_theme_file_path( '/inc/class-tgm-plugin-activation.php' );

/**
 * Breadcrumb.
 */
require get_parent_theme_file_path( '/inc/class-breadcrumb.php' );

/**
 * Custom template tags for this theme.
 */
require get_parent_theme_file_path( '/inc/template-tags.php' );

/**
 * Additional features to allow styling of the templates.
 */
require get_parent_theme_file_path( '/inc/template-functions.php' );

/**
 * Global template query for the theme
 */
require get_parent_theme_file_path( '/inc/query-functions.php' );

/**
 * Customizer additions.
 */
require get_parent_theme_file_path( '/inc/customizer.php' );

/**
 * Front icons functions and filters.
 */
require get_parent_theme_file_path( '/inc/icon-functions.php' );

/**
 * Custom color
 */
require get_parent_theme_file_path( '/inc/color-patterns.php' );

/**
 * Template Hook for this theme
 */
require get_parent_theme_file_path( '/inc/template-hooks.php' );

// Load theme update checker - needs loaded only once due to being used in child themes



//// Add page Settings API
//require_once get_parent_theme_file_path( '/updater/PageSettings.php' );

if ( class_exists( 'WooCommerce' ) ) {
	/**
	 * WooCommerce class support for this theme
	 */
	require get_parent_theme_file_path( '/inc/class-support-woocommerce.php' );

	/**
	 * WooCommerce Template Tags for this theme
	 */
	require get_parent_theme_file_path( '/inc/woocommerce-tags.php' );
}


