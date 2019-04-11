<?php
/**
 * Displays top navigation
 *
 * @package DD_Base
 * @since 1.0
 */
?>
<nav id="site-navigation" class="main-navigation">

	<?php
	if ( has_nav_menu( 'primary' ) ) {
		wp_nav_menu( array(
			'theme_location' => 'primary',
			'menu_id'        => 'primary-menu',
			'menu_class'     => 'primary-menu'
		) );
	} else {
		if ( is_user_logged_in() && current_user_can( 'edit_posts' ) ) {
			echo '<div class="fallback-menu">';
			printf( esc_attr__( 'Ready to set Top Menu? %s', 'dd-base' ), '<a href="' . esc_url( admin_url( 'nav-menus.php' ) ) . '"> ' . esc_attr__( 'Get started here.', 'dd-base' ) . '</a>' );
			echo '</div>';
		} else {
			printf( '<div class="fallback-menu">%s</div>', esc_attr__( 'Primary Menu is not set', 'dd-base' ) );
		}
	}
	?>
</nav><!-- #site-navigation -->
