<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package DD_Base
 * @since 1.0
 */

get_header();


/**
 * @hooked: dd_base_before_main_content - 10
 * @hooked: dd_base_breadcrumb - 5
 */
do_action( 'dd_base\before_main_content');
?>

	<div class="content-area">
		<main id="main" class="site-main">

			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/page/content', 'page' );

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
 * @hooked: dd_base_pagination - 10
 * @hooked: dd_base_after_main_content - 15
 */
do_action( 'dd_base\after_main_content' );


get_footer();
