<?php
/**
 * Displays header site branding
 *
 * @package DD_Base
 * @since 1.0
 */
?>
<div class="site-branding">
	<div class="logo">
		<?php the_custom_logo(); ?>
	</div>

	<div class="site-branding-text">
		<?php if ( is_front_page() ) : ?>
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
		<?php else : ?>
			<div class="site-title h1"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></div>
		<?php endif; ?>

		<?php
		$description = get_bloginfo( 'description', 'display' );
		if ( $description || is_customize_preview() ) :
			?>
			<p class="site-description"><?php echo esc_html( $description ); ?></p>
		<?php endif; ?>
	</div><!-- .site-branding-text -->
</div>
