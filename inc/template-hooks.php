<?php

/**
 * Custom template hook for this theme
 *
 * @package DD_Base
 * @since 1.0
 */
/**
 * Init Hook
 * @since 1.0
 */
add_filter( 'body_class', 'dd_base_body_classes' );

add_action( 'dd_base\before_main_content', 'dd_base_content_header' );

add_action( 'dd_base\before_main_content', 'dd_base_before_main_content' );

add_action( 'dd_base\after_main_content', 'dd_base_pagination', 10 );

add_action( 'dd_base\after_main_content', 'dd_base_after_main_content', 15, 2 );

add_filter( 'wp_title', 'dd_base_breadcrumb_title' );

add_action( 'edit_category', 'dd_base_category_transient_flusher' );
add_action( 'save_post', 'dd_base_category_transient_flusher' );
add_action( 'save_post_post', 'dd_base_get_author_posts_count_flusher', 10, 2 );
add_action( 'edit_comment', 'dd_base_get_author_comments_count_flusher', 10, 2 );

add_action( 'tgmpa_register', 'dd_base_register_required_plugins' );

add_action( 'template_redirect', 'dd_base_query', 5 );

