<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package DD_Base
 * @since 1.0
 */
if ( !is_active_sidebar( dd_base( 'sidebar' )->id) ) {
	return;
}
?>
<div id="secondary" class="col-lg-3 ">
	<aside class="widget-area">
		<?php dynamic_sidebar( dd_base( 'sidebar' )->id ); ?>
	</aside><!-- #secondary -->
</div>
