<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package DD_Base
 * @since 1.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
    <?php get_template_part('template-parts/header/header','mobile'); ?>
    <header id="masthead" class="site-header" role="banner">

		<?php if ( dd_base( 'header' )->topbar ): ?>

            <div class="site-header__topbar">
                <div class="container">
                    <div class="site-header__topbar-left">
						<?php

						if ( dd_base( 'header' )->topbar_show_link && $topbar_link_id = get_theme_mod( 'topbar_link' ) ) :

							wp_nav_menu( array(
								'menu'       => $topbar_link_id,
								'menu_class' => 'topbar_links',
								'container'  => false
							) );

						endif;
						?>
                    </div>

                    <div class="site-header__topbar-right">
						<?php
						if ( class_exists( 'WooCommerce' ) ) {
							if ( get_theme_mod( 'header_show_wishlist', 1 ) ) {
								dd_base_wishlist();
							}
							if ( get_theme_mod( 'header_show_minicart', 1 ) ) {
								dd_base_minicart();
							}
							if ( get_theme_mod( 'header_show_account_nav', 1 ) ) {
								dd_base_account_navigator();
							}
						}
						?>
                    </div>
                </div>
            </div>

		<?php endif; ?>

        <div class="site-header__mainbar">
            <div class="container">
                <div class="site-header__main">
                    <?php get_template_part( 'template-parts/header/site', 'branding' ); ?>
                    <div class="site-header-menu" id="site-header-menu">
                        <?php get_template_part( 'template-parts/header/navigation', 'top' ); ?>
                    </div>
                </div>
            </div>
        </div>

    </header><!-- #masthead -->

    <div class="site-content-contain">
