<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package DD_Base
 */
get_header();

/**
 * @hooked: dd_base_before_main_content - 10
 * @hooked: dd_base_breadcrumb - 5
 */
do_action( 'dd_base\before_main_content' );
?>
<header class="entry-header">
	<?php if ( have_posts() ) : ?>
		<h1 class="entry-title"><?php echo esc_html__( 'Search Results for: ', 'dd-base' ) ?> <span> <?php echo esc_html( get_search_query() ) ?> </span></h1>
	<?php else : ?>
		<h1 class="entry-title"><?php echo esc_html__( 'Nothing Found', 'dd-base' ); ?></h1>
	<?php endif; ?>
</header><!-- .page-header -->

<div class="content-area">
	<main id="main" class="site-main">

		<?php if ( have_posts() ) : ?>

			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'template-parts/post/content', 'excerpt' );

			endwhile;

		else :

			get_template_part( 'template-parts/post/content', 'none' );

		endif;
		?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php
/**
 * @hooked: dd_base_pagination - 10
 * @hooked: dd_base_after_main_content - 15
 */
do_action( 'dd_base\after_main_content' );

get_footer();
