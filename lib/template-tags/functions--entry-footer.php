<?php

//filters the_category_list to return only the first category
function _act_first_cat($cats)
{
    return [$cats[0]];
}
add_filter('the_category_list', '_act_first_cat');

if (!function_exists('_act_entry_footer')) :
    /**
     * Prints HTML with meta information for the categories, tags and comments.
     */
    function _act_entry_footer()
    {
// Hide category and tag text for pages.
        if ('post' === get_post_type())
        {
            /* translators: used between list items, there is a space after the comma */
            $categories_list = get_the_category_list(esc_html__(', ', '_act'));
            if ($categories_list && _s_categorized_blog())
            {
                printf('<span class="tagged__cat-links">' . esc_html__('Posted in %1$s', '_s') . '</span>', $categories_list); // WPCS: XSS OK.
            }
            /* translators: used between list items, there is a space after the comma */
            $tags_list = get_the_tag_list('', esc_html__(', ', '_act'));
            if ($tags_list)
            {
                printf('<span class="tagged__tag-links">' . esc_html__('Tagged %1$s', '_s') . '</span>', $tags_list); // WPCS: XSS OK.
            }
        }
//        if (!is_single() && !post_password_required() && (comments_open() || get_comments_number()))
//        {
//            echo '<span class="tagged__comment-links">';
//            comments_popup_link(esc_html__('Leave a comment', '_s'), esc_html__('1 Comment', '_s'), esc_html__('% Comments', '_s'));
//            echo '</span>';
//        }
    }
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function _s_categorized_blog() {
    if ( false === ( $all_the_cool_cats = get_transient( '_s_categories' ) ) ) {
        // Create an array of all the categories that are attached to posts.
        $all_the_cool_cats = get_categories( array(
            'fields'     => 'ids',
            'hide_empty' => 1,
            // We only need to know if there is more than one category.
            'number'     => 2,
        ) );
        // Count the number of categories that are attached to the posts.
        $all_the_cool_cats = count( $all_the_cool_cats );
        set_transient( '_s_categories', $all_the_cool_cats );
    }
    if ( $all_the_cool_cats > 1 ) {
        // This blog has more than 1 category so _s_categorized_blog should return true.
        return true;
    } else {
        // This blog has only 1 category so _s_categorized_blog should return false.
        return false;
    }
}