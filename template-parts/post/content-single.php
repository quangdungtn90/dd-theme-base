<?php
/**
 * The template part for displaying single posts
 *
 * @package DD_Base
 * @since 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<?php dd_base_excerpt(); ?>

	<?php dd_base_post_thumbnail(); ?>

	<div class="entry-content">
		<?php
		the_content();

		wp_link_pages( array(
			'before' => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'dd-base' ) . '</span>',
			'after' => '</div>',
			'link_before' => '<span>',
			'link_after' => '</span>',
			'pagelink' => '<span class="screen-reader-text">' . esc_html__( 'Page', 'dd-base' ) . ' </span>%',
			'separator' => '<span class="screen-reader-text">, </span>',
		) );

		if ( '' !== get_the_author_meta( 'description' ) ) {
			get_template_part( 'template-parts/biography' );
		}
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
        <div class="entry-meta">
	        <?php dd_base_entry_meta(); ?>
	        <?php dd_base_edit_link();?>
        </div>
        <div class="entry-share">
            <?php echo sprintf('<span>%s</span>', esc_html__('Share:','dd-base'));?>
			<?php dd_base_entry_share(); ?>
        </div>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
