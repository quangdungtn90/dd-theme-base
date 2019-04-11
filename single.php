<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package DD_Base
 * @since 1.0
 */
get_header();


/**
 * @hooked: dd_base_breadcrumb - 5
 * @hooked: dd_base_before_main_content - 10
 */
do_action( 'dd_base\before_main_content' );
?>

<div class="content-area">
	<main id="main" class="site-main">

		<?php
		/* Start the Loop */
		while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/post/content', 'single' );

			/**
			 * Display Related Posts
			 */
			if ( dd_base( 'content' )->show_biography ) {
				get_template_part( 'template-parts/post/biography' );
			}

			if ( dd_base( 'content' )->show_nav ) {
				the_post_navigation( array(
					'prev_text' => '<span class="screen-reader-text">' . esc_html__( 'Previous Post', 'dd-base' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . esc_html__( 'Previous', 'dd-base' ) . '</span> <span class="nav-title">%title</span>',
					'next_text' => '<span class="screen-reader-text">' . esc_html__( 'Next Post', 'dd-base' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . esc_html__( 'Next', 'dd-base' ) . '</span> <span class="nav-title">%title</span>',
				) );
			}

			/**
			 * Display Related Posts
			 */
			if ( dd_base( 'content' )->show_related ) {
				get_template_part( 'template-parts/post/related' );
			}

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->
</div><!-- .content-area -->

<?php
/**
 * @hooked: dd_base_after_main_content - 15
 */
do_action( 'dd_base\after_main_content' );

get_footer();
