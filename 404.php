<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package DD_Base
 * @since 1.0
 */

get_header();



$title = get_theme_mod( '404_title', esc_html__( 'Oops! That page can&rsquo;t be found.', 'dd-base' ) );
$content = get_theme_mod( '404_content', esc_html__( 'It looks like nothing was found at this location. Maybe try a search?', 'dd-base' ) );
?>

    <div class="container">
        <div id="primary" class="content-area">
            <main id="main" class="site-main">
                <section class="error-404 not-found">
                    <header class="entry-header">
                        <h1 class="entry-title"><?php echo esc_html( $title ) ?></h1>
                    </header><!-- .page-header -->
                    <div class="entry-content">
                        <p class="description"><?php echo wp_kses_post( $content ) ?></p>
						<?php get_search_form(); ?>
                    </div><!-- .page-content -->
                </section><!-- .error-404 -->
            </main><!-- #main -->
        </div><!-- #primary -->
    </div><!-- .container -->

<?php get_footer();
