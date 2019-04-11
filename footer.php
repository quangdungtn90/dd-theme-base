<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package DD_Base
 * @since 1.0
 */
?>

</div><!-- #content -->

<?php if ( dd_base( 'footer' )->style != 'none' ):
	$footerClass = array( 'site-footer' );
	$footerClass[] = 'site-footer--' . dd_base( 'footer' )->style;
	$footerClass[] = 'site-footer--' . ( dd_base( 'footer' )->widgets_enable ? 'enable' : 'disable' );
	$footerClass = apply_filters( 'dd_base\footer_css_class', $footerClass );

	$template = array( 0 => 'col-lg-3', 1 => 'col-lg-3', 2 => 'col-lg-3', 'col-lg-3' );
	?>
    <footer class="<?php echo implode( ' ', $footerClass ) ?>">
		<?php
		if ( dd_base( 'footer' )->widgets_enable ) :
			?>
            <div class="widget-area container">
                <div class="row">
					<?php

					foreach ( dd_base( 'footer' )->widgets as $key => $value ):
						echo '<div class="' . esc_attr( $template[ $key ] ) . '">';
						dynamic_sidebar( $value );
						echo '</div>';
					endforeach;
					?>

                </div>
            </div>
			<?php
		endif;
		?>

        <div class="site-info">
            <div class="container">

				<?php dd_base_site_info() ?>

				<?php if ( has_nav_menu( 'social' ) ) : ?>
                    <nav class="social-navigation">
						<?php
						wp_nav_menu( array(
							'theme_location' => 'social',
							'menu_class'     => 'social-links-menu',
							'depth'          => 1,
							'link_before'    => '<span class="screen-reader-text">',
							'link_after'     => '</span>' . dd_base_get_icon( 'chain' ),
						) );
						?>
                    </nav><!-- .social-navigation -->
				<?php endif; ?>

            </div>
        </div>

    </footer>
<?php endif; ?>
</div><!-- #page -->
<?php wp_footer(); ?>
</body>
</html>
