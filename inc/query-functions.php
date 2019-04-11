<?php

/**
 * Get current hook
 *
 * @since 1.0
 * @return string
 */
function dd_base_get_current_hook() {

    $id = '';
    $group = 'blog';

    if (is_front_page() && is_home()) {
        $id = 'latest_posts';
    } else if (is_front_page() && is_page()) {
        $id = 'front_page';
        $group = 'page';
    } else if (is_home() && get_queried_object()) {
        $id = 'blog_page';
    } else if (is_singular()) {
        $id = get_post_type();
        if ($id != 'post') {
            $group = get_post_type();
        }
    } else if (is_search()) {
        /**
         * Search post type
         */
        if ($obj = get_queried_object()) {
            $id = 'search_' . $obj->name;
            $group = 'search';
        }

        $id = 'search';
    } else if (is_404()) {
        $id = '404';
        $group = 'page';
    } else if (is_author()) {
        $id = 'archive_author';
    } else if (is_post_type_archive() && $obj = get_queried_object()) {
        $id = 'archive_' . $obj->name;
        $group = $obj->name;
    } else if (is_archive() && $obj = get_queried_object()) {
        $id = $obj->taxonomy;
    } else if (is_archive()) {
        $id = 'archive';
    }

    return array(
        'id' => $id,
        'group' => $group
    );
}

/**
 * Global DD Base Query
 * @since 1.0
 * @return void
 */
function dd_base_query() {

    if (is_admin()) {
        return;
    }

    $defaults = array(
        'hook' => dd_base_get_current_hook(),
        'header' => array(
            'style' => 'default',
            'topbar' => false,
            'topbar_show_link' => false
        ),
        'sidebar' => array(
            'id' => 'sidebar',
            'position' => 'right',
        ),
        'breadcrumb' => array(
            'enable' => 'yes',
            'image' => get_theme_mod('breadcrumb_image_default','')
        ),
        'content' => array(
            'spacing' => 'yes',
            'show_title' => true,
        ),
        'footer' => array(
            'style' => 'default',
            'widgets_enable' => true,
            'widgets' => array('sidebar-footer', 'sidebar-footer-2', 'sidebar-footer-3', 'sidebar-footer-4')
        )
    );

    if ($defaults['hook']['group'] == 'blog') {

        $defaults['content']['show_author_link'] = true;
        $defaults['content']['show_date'] = true;
        $defaults['content']['show_comment_count'] = true;
        $defaults['content']['show_sharing'] = true;
        $defaults['content']['show_categories'] = false;
        $defaults['content']['show_tags'] = false;
        $defaults['content']['show_readmore'] = true;
    }

    if (is_singular()) {

        $defaults['content']['show_nav'] = true;
        $defaults['content']['show_related'] = true;
        $defaults['content']['show_biography'] = true;

        $defaults['content']['related_limit'] = 3;
        $defaults['content']['related_ids'] = '';
        $defaults['content']['related_by'] = 'category';
    }

    global $dd_base_query;

    $query = apply_filters('dd_base\query', $defaults);

    if ($query['footer']['widgets_enable']) {

        $widgets = $query['footer']['widgets'];
        $query['footer']['widgets_enable'] = false;

        foreach ($widgets as $key => $value) {
            if (is_active_sidebar($value)) {
                $query['footer']['widgets_enable'] = true;
                break;
            }
        }
    }

    $dd_base_query = $query;
}

/**
 * DD Base Query
 * @since 1.0
 * @return object|false
 */
function dd_base($make = null) {

    global $dd_base_query;

    if (isset($dd_base_query[$make])) {
        if (is_array($dd_base_query[$make])) {
            return (object) $dd_base_query[$make];
        }

        return $dd_base_query[$make];
    }

    return $dd_base_query;
}
