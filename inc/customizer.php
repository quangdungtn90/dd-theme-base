<?php

/**
 * Customizer
 *
 * @package DD_Base
 * @since 1.0
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function dd_base_customize_register( $wp_customize ) {

	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	$wp_customize->selective_refresh->add_partial( 'blogname', array(
		'selector' => '.site-title a',
		'render_callback' => 'dd_base_customize_partial_blogname',
	) );

	$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
		'selector' => '.site-description',
		'render_callback' => 'dd_base_customize_partial_blogdescription',
	) );

	/**
	 * Remove Default Header Image
	 */
	$wp_customize->remove_section( 'header_image' );

	/*
	 * Remove Header text color
	 */
	$wp_customize->remove_control( 'header_textcolor' );

	/**
	 * Enable custom color
	 */
	$wp_customize->add_setting( 'color_enable', array(
		'default' => 0,
		'sanitize_callback' => 'absint',
		'transport' => 'refresh',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'color_enable', array(
		'label' => esc_html__( 'Enable customize colors?', 'dd-base' ),
		'section' => 'colors',
		'type' => 'checkbox'
	) ) );


	/**
	 * Custom colors.
	 * Primary Color
	 */
	$wp_customize->add_setting( 'primary_color', array(
		'default' => '#007acc',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport' => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'primary_color', array(
		'label' => esc_html__( 'Primary Color', 'dd-base' ),
		'description' => esc_html__( 'The main color of the website', 'dd-base' ),
		'section' => 'colors',
	) ) );

	/**
	 * Secondary Color
	 */
	$wp_customize->add_setting( 'secondary_color', array(
		'default' => '#f88a56',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport' => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'secondary_color', array(
		'label' => esc_html__( 'Secondary Color', 'dd-base' ),
		'description' => esc_html__( 'The secondary color includes link color, hover color...', 'dd-base' ),
		'section' => 'colors',
	) ) );


	/**
	 * Text Primary Color
	 */
	$wp_customize->add_setting( 'text_primary_color', array(
		'default' => '#222222',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport' => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'text_primary_color', array(
		'label' => esc_html__( 'Text Primary Color', 'dd-base' ),
		'section' => 'colors',
		'description' => esc_html__( 'Color for global text.', 'dd-base' )
	) ) );

	/**
	 * Text Secondary Color
	 */
	$wp_customize->add_setting( 'text_secondary_color', array(
		'default' => '#666666',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport' => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'text_secondary_color', array(
		'label' => esc_html__( 'Text Secondary Color', 'dd-base' ),
		'description' => esc_html__( 'The text secondary color includes metadata text color', 'dd-base' ),
		'section' => 'colors',
	) ) );

	/**
	 * 404 Page
	 */
	$wp_customize->add_section( 'page_404', array(
		'id' => 'page_404',
		'title' => esc_html__( 'Custom 404', 'dd-base' ),
		'priority' => 161,
		'description' => esc_html__( 'Settings for 404 page.', 'dd-base' )
	) );

	// Title
	$wp_customize->add_setting( '404_title', array(
		'default' => esc_html__( 'PAGE NOT FOUND', 'dd-base' ),
		'transport' => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field'
			)
	);

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, '404_title', array(
		'label' => esc_html__( 'Title', 'dd-base' ),
		'section' => 'page_404',
		'settings' => '404_title'
			)
	) );

	// Description
	$wp_customize->add_setting( '404_content', array(
		'default' => esc_textarea( __('The page are looking for has been moved or does not exist anymore, if you like you can return to our homepage. If the problem persists, please send us an email to <a href="mailto:support@themespond.com">support@themespond.com</a>','dd-base')),
		'transport' => 'postMessage',
		'sanitize_callback' => 'sanitize_textarea_field'
			)
	);

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, '404_content', array(
		'label' => esc_html__( 'Content', 'dd-base' ),
		'section' => 'page_404',
		'settings' => '404_content',
		'type' => 'textarea'
			)
	) );

	/**
	 * Add image breadcrumb
	 */
	$wp_customize->add_setting( 'breadcrumb_image_default', array(
			'transport'         => 'refresh',
			'sanitize_callback' => 'sanitize_text_field'
		)
	);

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'breadcrumb_image_default', array(
			'label'    => esc_html__( 'Breadcrumb image ', 'dd-base' ),
			'section'  => 'title_tagline',
			'priority' => 30
		)
	) );
}

add_action( 'customize_register', 'dd_base_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @since 1.0
 * @see dd_base_customize_register()
 *
 * @return void
 */
function dd_base_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @since 1.0
 * @see dd_base_customize_register()
 *
 * @return void
 */
function dd_base_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Bind JS handlers to instantly live-preview changes.
 */
function dd_base_customize_preview_js() {
	wp_enqueue_script( 'dd_base-customize-preview', get_theme_file_uri( '/assets/js/customize-preview.js' ), array( 'customize-preview' ), '1.0', true );
}

add_action( 'customize_preview_init', 'dd_base_customize_preview_js' );

/**
 * Load dynamic logic for the customizer controls area.
 */
function dd_base_customize_control_js() {
	wp_enqueue_script( 'dd_base-customize-controls', get_theme_file_uri( '/assets/js/customize-controls.js' ), array(), '1.0', true );
}

add_action( 'customize_controls_enqueue_scripts', 'dd_base_customize_control_js' );
