<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package DD_Base
 * @since 1.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">
		<?php if ( is_sticky() && is_home() && !is_paged() ) : ?>
			<span class="sticky-post"><?php echo esc_html__( 'Featured', 'dd-base' ); ?></span>
		<?php endif; ?>

		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
	</header><!-- .entry-header -->

	<?php dd_base_excerpt() ?>
    <?php if ( has_post_thumbnail() ):?>
	<div class="post-thumbnail">
		<?php the_post_thumbnail(); ?>
	</div><!-- .post-thumbnail -->
    <?php endif;?>
	<div class="entry-content">
		<?php
		/* translators: %s: Name of current post */
		the_content( sprintf( '<span class="more-link">%s</span>', esc_html__( 'Continue reading', 'dd-base' ) ) );

		wp_link_pages( array(
			'before' => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'dd-base' ) . '</span>',
			'after' => '</div>',
			'link_before' => '<span>',
			'link_after' => '</span>',
			'pagelink' => '<span class="screen-reader-text">' . esc_html__( 'Page', 'dd-base' ) . ' </span>%',
			'separator' => '<span class="screen-reader-text">, </span>',
		) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
        <div class="entry-meta">
	        <?php dd_base_entry_meta(); ?>
	        <?php dd_base_edit_link(); ?>
        </div>
        <div class="entry-share">
	        <?php dd_base_entry_share(); ?>
        </div>

	</footer><!-- .entry-footer -->

</article>
