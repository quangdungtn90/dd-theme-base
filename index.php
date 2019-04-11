<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
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

		if ( have_posts() ) :

			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/post/content', get_post_format() );

			endwhile;

		else :

			get_template_part( 'template-parts/post/content', 'none' );

		endif;
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
