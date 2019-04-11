<?php
/**
 * Template for displaying search forms in Twenty Sixteen
 *
 * @package DD_Base
 * @since 1.0
 */
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
    <span class="screen-reader-text"><?php echo _x('Search for:', 'label', 'dd-base'); ?></span>
    <input type="search" class="search-field" placeholder="<?php echo esc_attr_x('Search &hellip;', 'placeholder', 'dd-base'); ?>" value="<?php echo get_search_query(); ?>" name="s" />
    <button type="submit" class="search-submit"><span class="screen-reader-text"><?php echo _x('Search', 'submit button', 'dd-base'); ?></span></button>
</form>
