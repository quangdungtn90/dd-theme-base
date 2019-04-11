<?php
/**
 * Custom DD Base template tags
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @since 1.0
 */
if ( ! function_exists( 'dd_base_entry_meta' ) ) :

	/**
	 * Prints HTML with meta information for the categories, tags.
	 *
	 * Create your own dd_base_entry_meta() function to override in a child theme.
	 *
	 * @since 1.0
	 */
	function dd_base_entry_meta() {

		/**
		 * Display Author link
		 */
		if ( 'post' === get_post_type() && dd_base( 'content' )->show_author_link ) {
			$author_avatar_size = apply_filters( 'dd_base_author_avatar_size', 48 );
			printf( '<span class="byline"><span class="author vcard">%1$s<span class="screen-reader-text">%2$s </span> <a class="url fn n" href="%3$s">%4$s</a></span></span>', get_avatar( get_the_author_meta( 'user_email' ), $author_avatar_size ), esc_html_x( 'Author', 'Used before post author name.', 'dd-base' ), esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ), get_the_author()
			);
		}

		/**
		 * Display Time link
		 */
		if ( in_array( get_post_type(), array( 'post', 'attachment' ) ) && dd_base( 'content' )->show_date ) {
			echo dd_base_time_link();
		}

		if ( 'post' === get_post_type() ) {
			/**
			 * Display categories
			 */
			if ( dd_base( 'content' )->show_categories ) {
				$categories_list = get_the_category_list( esc_html_x( ', ', 'Used between list items, there is a space after the comma.', 'dd-base' ) );
				if ( $categories_list && dd_base_categorized_blog() ) {
					printf( '<span class="cat-links"><span class="screen-reader-text">%1$s </span>%2$s</span>', esc_html_x( 'Categories', 'Used before category names.', 'dd-base' ), $categories_list
					);
				}
			}

			/**
			 * Display tags
			 */
			if ( dd_base( 'content' )->show_tags ) {
				if ( $tags_list = get_the_tag_list( '', esc_html_x( ', ', 'Used between list items, there is a space after the comma.', 'dd-base' ) ) ) {
					printf( '<span class="tags-links"><span class="screen-reader-text">%1$s </span>%2$s</span>', esc_html_x( 'Tags', 'Used before tag names.', 'dd-base' ), $tags_list
					);
				}
			}
		}

		/**
		 * Display comment count
		 */
		if ( dd_base( 'content' )->show_comment_count && comments_open() ) {
			echo '<span class="comments-link">';
			comments_popup_link( '0 comment', '1 comment', '% comments', '' );
			echo '</span>';
		}
	}

endif;

if ( ! function_exists( 'dd_base_entry_share' ) ) {

	function dd_base_entry_share() {
		/**
		 * Display social sharing
		 */
		if ( function_exists( 'dd_base_toolkit_social_sharing' ) && dd_base( 'content' )->show_sharing ):
			dd_base_toolkit_social_sharing();
		endif;
	}

}

if ( ! function_exists( 'dd_base_time_link' ) ) :

	/**
	 * Prints HTML with date information for current post.
	 *
	 * Create your own dd_base_time_link() function to override in a child theme.
	 *
	 * @since 1.0
	 */
	function dd_base_time_link() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string, get_the_date( DATE_W3C ), get_the_date(), get_the_modified_date( DATE_W3C ), get_the_modified_date()
		);

		// Wrap the time string in a link, and preface it with 'Posted on'.
		return sprintf( '<span class="post-on"><span class="screen-reader-text">%s</span> %s', esc_html__( 'Posted on', 'dd-base' ), '<a href="' . esc_url( get_permalink() ) . '">' . $time_string . '</a></span>'
		);
	}

endif;


if ( ! function_exists( 'dd_base_post_thumbnail' ) ) :

	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 *
	 * Create your own dd_base_post_thumbnail() function to override in a child theme.
	 *
	 * @since 1.0
	 */
	function dd_base_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			?>

            <div class="post-thumbnail">
				<?php the_post_thumbnail(); ?>
            </div><!-- .post-thumbnail -->

		<?php else : ?>

            <a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
				<?php the_post_thumbnail( 'post-thumbnail', array( 'alt' => the_title_attribute( 'echo=0' ) ) ); ?>
            </a>

			<?php
		endif; // End is_singular()
	}

endif;

if ( ! function_exists( 'dd_base_excerpt' ) ) :

	/**
	 * Displays the optional excerpt.
	 *
	 * Wraps the excerpt in a div element.
	 *
	 * Create your own dd_base_excerpt() function to override in a child theme.
	 *
	 * @since 1.0
	 *
	 * @param string $class Optional. Class string of the div element. Defaults to 'entry-summary'.
	 */
	function dd_base_excerpt( $class = 'entry-summary' ) {

		if ( has_excerpt() || is_search() ) :
			?>
            <div class="<?php echo esc_attr( $class ); ?>">
				<?php the_excerpt(); ?>
            </div>
			<?php
		endif;
	}

endif;

if ( ! function_exists( 'dd_base_excerpt_more' ) && ! is_admin() ) :

	/**
	 * Replaces "[...]" (appended to automatically generated excerpts) with ... and
	 * a 'Continue reading' link.
	 *
	 * Create your own dd_base_excerpt_more() function to override in a child theme.
	 *
	 * @since 1.0
	 *
	 * @return string 'Continue reading' link prepended with an ellipsis.
	 */
	function dd_base_excerpt_more() {
		$link = sprintf( '<a href="%1$s" class="more-link">%2$s</a>', esc_url( get_permalink( get_the_ID() ) ), esc_html__( 'Continue reading', 'dd-base' ) );

		return ' &hellip; ' . $link;
	}

	add_filter( 'excerpt_more', 'dd_base_excerpt_more' );
endif;


if ( ! function_exists( 'dd_base_the_custom_logo' ) ) :

	/**
	 * Displays the optional custom logo.
	 *
	 * Does nothing if the custom logo is not available.
	 *
	 * @since 1.0
	 */
	function dd_base_the_custom_logo() {
		if ( function_exists( 'the_custom_logo' ) ) {
			the_custom_logo();
		}
	}

endif;

if ( ! function_exists( 'dd_base_breadcrumb' ) ) :

	/**
	 * Output the Breadcrumb.
	 * @since 1.0
	 */
	function dd_base_breadcrumb() {

		$args = apply_filters( 'dd_base\breadcrumb_defaults', array(
			'delimiter' => '&nbsp;&#47;&nbsp;', //&nbsp;&#47;&nbsp;
			'before'    => '',
			'after'     => '',
			'home'      => esc_html__( 'Home', 'dd-base' )
		) );

		$breadcrumbs = new DD_Base_Breadcrumb();

		if ( ! empty( $args['home'] ) ) {
			$breadcrumbs->add_crumb( $args['home'], esc_url( home_url() ) );
		}

		if ( ( is_singular( 'post' ) || is_archive() && ! is_post_type_archive() ) && $blog_id = get_option( 'page_for_posts' ) ) {
			$breadcrumbs->add_crumb( esc_html__( 'Blog', 'dd-base' ), esc_url( get_permalink( $blog_id ) ) );
		}

		$args['breadcrumb'] = $breadcrumbs->generate();

		extract( $args );

		/**
		 * Breadcrumb output
		 */
		$output = '<nav class="dd-base-breadcrumb">';

		foreach ( $breadcrumb as $key => $crumb ) {

			$output .= $before;

			if ( ! empty( $crumb[1] ) ) {
				$output .= '<a href="' . esc_url( $crumb[1] ) . '">' . esc_html( $crumb[0] ) . '</a>';
			} else {
				$output .= esc_html( wp_trim_words( $crumb[0], 5 ) );
			}

			$output .= $after;

			if ( sizeof( $breadcrumb ) !== $key + 1 ) {
				$output .= $delimiter;
			}
		}
		$output .= '</nav>';

		echo apply_filters( 'dd_base\breadcrumb', $output );
	}

endif;

if ( ! function_exists( 'dd_base_content_header' ) ):

	function dd_base_content_header() {
		get_template_part( 'template-parts/global/content', 'header' );
	}

endif;

if ( ! function_exists( 'dd_base_before_main_content' ) ):

	/**
	 * Before the site content
	 *
	 * @since 1.0
	 */
	function dd_base_before_main_content() {
		echo '<div id="content" class="site-content">
				<div class="wrap container">
					<div class="row">';

		$cssClass = dd_base( 'sidebar' )->position == 'none' ? 'col-lg-12' : 'col-lg-9';

		printf( '<div id="primary" class="%s">', $cssClass );
	}

endif;

if ( ! function_exists( 'dd_base_after_main_content' ) ):

	/**
	 * After the site content
	 *
	 * @since 1.0
	 */
	function dd_base_after_main_content() {

		echo '</div>';

		if ( dd_base( 'sidebar' )->position != 'none' ) {
			get_sidebar();
		}

		echo '</div>
			</div>
			</div>';
	}

endif;

if ( ! function_exists( 'dd_base_pagination' ) ):

	/**
	 * Pagination
	 *
	 * @since 1.0
	 */
	function dd_base_pagination() {

		if ( ! is_singular() && current_theme_supports( 'loop-pagination' ) ) {
			global $wp_query, $wp_rewrite;

			$total = $wp_query->max_num_pages;

			if ( $total > 1 ) {
				$current = ( intval( get_query_var( 'paged' ) ) ) ? intval( get_query_var( 'paged' ) ) : 1;

				$pagination_args = array(
					'base'      => @add_query_arg( 'paged', '%#%' ),
					'format'    => '',
					'current'   => $current,
					'total'     => $total,
					'end_size'  => 2,
					'mid_size'  => 1,
					'type'      => 'array',
					'prev_next' => true,
					'prev_text' => sprintf( '<span class="screen-reader-text">%s</span>', esc_attr__( 'Prev', 'dd-base' ) ),
					'next_text' => sprintf( '<span class="screen-reader-text">%s</span>', esc_attr__( 'Next', 'dd-base' ) ),
				);

				if ( $wp_rewrite->using_permalinks() ) {
					$pagination_args['base'] = user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' );
				}

				if ( ! empty( $wp_query->query_vars['s'] ) ) {
					$pagination_args['add_args'] = array( 's' => urlencode( get_query_var( 's' ) ) );
				}

				$page_links = paginate_links( $pagination_args );
				?>

                <nav class="navigation pagination">
                    <div class="nav-links">
						<?php echo join( '', $page_links ) ?>
                    </div>
                </nav>
				<?php
			}
		}
	}

endif;


if ( ! function_exists( 'dd_base_site_info' ) ):

	/**
	 * Footer copy right text
	 * @since 1.0
	 */
	function dd_base_site_info() {
		$default   = wp_kses_post( sprintf( __( 'Designed and built with all the love in the world by %s', 'dd-base' ), sprintf( '<a href="%s" target="_blank">%s</a>', esc_url( '//themespond.com/' ), esc_html__( 'ThemesPond', 'dd-base' ) ) ) );
		$copyright = get_theme_mod( 'footer_copyright', $default );

		echo '<div class="site-copyright">';

		echo wp_kses_post( $copyright );

		echo '</div>';
	}

endif;

if ( ! function_exists( 'dd_base_edit_link' ) ):
	/**
	 * Link edit post when user login
	 * @since 1.0
	 */
    function dd_base_edit_link() {

        edit_post_link(
            sprintf( '%s<span class="screen-reader-text"> "%s"</span>', esc_attr__( 'Edit', 'dd-base' ), get_the_title()
            ), '<span class="edit-link">', '</span>'
        );
    }
endif;
