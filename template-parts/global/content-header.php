<?php
/**
 * DD Base breadcrumb
 *
 * @see dd_base_content_header()
 * @since 1.0
 */
$class = 'site-breadcrumb';
if ( dd_base( 'breadcrumb' )->enable == 'yes' ):
	if ( dd_base( 'breadcrumb' )->image ) {
		$class .= ' site-breadcrumb--bg-image';
	}
	?>
	<div class="<?php echo esc_attr( $class ); ?>" style="background-image:url(' <?php echo esc_url( dd_base( 'breadcrumb' )->image ) ?>')">
		<div class="container">

			<?php
			/**
			 * Display page title
			 */
			wp_title( '' );

			/**
			 * Display breadcrumb
			 */
			dd_base_breadcrumb();
			?>

		</div>
	</div>
	<?php



endif;
