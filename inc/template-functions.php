<?php

/**
 * Additional features to allow styling of the templates
 *
 * @package DD_Base
 * @since 1.0
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 *
 * @return array
 */
function dd_base_body_classes( $classes ) {

	// Add class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Add class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Add class if we're viewing the Customizer for easier styling of theme options.
	if ( is_customize_preview() ) {
		$classes[] = 'dd-base-customizer';
	}

	// Add class if the site title and tagline is hidden.
	if ( 'blank' === get_header_textcolor() ) {
		$classes[] = 'title-tagline-hidden';
	}

	$classes[] = 'sidebar-position-' . dd_base( 'sidebar' )->position;
	$classes[] = 'content-spacing-' . dd_base( 'content' )->spacing;

	return $classes;
}

add_filter( 'body_class', 'dd_base_body_classes' );

if ( ! function_exists( 'dd_base_register_required_plugins' ) ):

	/**
	 * Plugins are required for the theme
	 * @since 1.0
	 * @return void
	 */
	function dd_base_register_required_plugins() {

		$plugins = array(
			array(
				'name'     => esc_html__( 'TP Framework', 'dd-base' ),
				'slug'     => 'tp-framework',
				'required' => false
			),
		);

		$config = array(
			'has_notices'  => true,
			'is_automatic' => false
		);

		tgmpa( $plugins, $config );
	}

endif;

/**
 * Related post args
 *
 * @since 1.0
 * @return array
 */
function dd_base_post_related_args() {

	global $post;
	$limit  = dd_base( 'content' )->related_limit;
	$get_by = dd_base( 'content' )->related_by;
	$ids    = dd_base( 'content' )->related_ids;

	$args = array(
		'post_type'           => array( $post->post_type ),
		'post__not_in'        => array( $post->ID ),
		'ignore_sticky_posts' => 1,
	);

	if ( 'category' == $get_by ) {
		$cats = get_the_category( $post->ID );
		if ( $cats ) {
			$ids = array();
			foreach ( $cats as $cat ) {
				$ids[] = $cat->term_id;
			}
			$args['tax_query'][]    = array(
				'taxonomy' => 'category',
				'field'    => 'id',
				'terms'    => $ids,
			);
			$args['posts_per_page'] = $limit;
		}
	} else if ( 'tags' == $get_by ) {

		$tags = get_the_tags( $post->ID );

		if ( $tags ) {

			$ids = array();

			foreach ( $tags as $tag ) {
				$ids[] = $tag->term_id;
			}

			$args['tax_query'][]    = array(
				'taxonomy' => 'post_tag',
				'field'    => 'id',
				'terms'    => $ids,
			);
			$args['posts_per_page'] = $limit;
		}
	} else if ( 'ids' == $get_by && ! empty( $ids ) ) {
		$args['post__in'] = explode( ',', $ids );
	}

	return apply_filters( 'dd_base\post_related_args', $args );
}

/**
 * Custom title in breadcrumb
 */
function dd_base_breadcrumb_title( $title ) {

	$title = '<h2 class="page-title">' . $title . '</h2>';

	$hook = dd_base( 'hook' )->id;

	switch ( $hook ) {
		case 'latest_posts':
		case 'post':
		case 'archive':
		case 'category':
		case 'post_tag':
			$title = '<h2 class="page-title">' . esc_html__( 'Blog', 'dd-base' ) . '</h2>';
			break;
		case 'search':
			$title = '<h1 class="page-title">' . esc_html__( 'Search results', 'dd-base' ) . '</h1>';
			break;
		case '404':
			$title = '<h1 class="page-title">' . esc_html__( '404 Page not found', 'dd-base' ) . '</h1>';
			break;
		case 'front_page':
		case 'page':
			$title = '<h1 class="page-title">' . get_the_title() . '</h1>';
			break;
	}

	return $title;
}


/**
 * Determines whether blog/site has more than one category.
 *
 * Create your own dd_base_categorized_blog() function to override in a child theme.
 *
 * @since 1.0
 *
 * @return bool True if there is more than one category, false otherwise.
 */
function dd_base_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'dd_base_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields' => 'ids',
			// We only need to know if there is more than one category.
			'number' => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'dd_base_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so dd_base_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so dd_base_categorized_blog should return false.
		return false;
	}
}


/**
 * Flushes out the transients used in dd_base_categorized_blog().
 *
 * @since 1.0
 */
function dd_base_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'dd_base_categories' );
}

/**
 * Get total posts count by author
 * @since 1.0
 *
 * @param int $author_id
 * @param string $post_type
 *
 * @return int
 */
function dd_base_get_author_posts_count( $author_id, $post_type = 'post' ) {
	$count = get_the_author_meta( 'posts_count' );
	if ( $count === '' || $count === null ) {
		$count = count_user_posts( $author_id, $post_type, true );
		update_user_meta( $author_id, 'posts_count', $count );
	}

	return $count;
}

/**
 * Flushes out the user meta used in dd_base_get_author_posts_count().
 *
 * @since 1.0
 */
function dd_base_get_author_posts_count_flusher( $post_id, $post ) {
	update_user_meta( $post->post_author, 'posts_count', null );
}


/**
 * Get total comments count for the author
 * @since 1.0
 *
 * @param int $author_id
 *
 * @return int
 */
function dd_base_get_author_comments_count( $author_id ) {

	$count = get_the_author_meta( 'comments_count' );

	if ( $count === '' || $count === null ) {
		global $wpdb;
		$count = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(*) AS total FROM $wpdb->comments WHERE comment_approved = 1 AND user_id = %d", $author_id ) );

		update_user_meta( $author_id, 'comments_count', $count );
	}

	return $count;
}

/**
 * Flushes out the user meta used in dd_base_get_author_comments_count().
 *
 * @since 1.0
 */
function dd_base_get_author_comments_count_flusher( $comment_ID, $comment ) {

	if ( $comment->user_id ) {
		update_user_meta( $comment->user_id, 'comments_count', null );
	}

}
