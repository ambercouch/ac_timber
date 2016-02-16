<?php
if (!function_exists('_act_posted_on')) :
    /**
     * Prints HTML with meta information for the current post-date/time and author.
     */
    function _act_posted_on($post_id = null)
    {
        $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
        if (get_the_time('U') !== get_the_modified_time('U'))
        {
            $time_string = '<time class="post-meta__date--published entry-date published" datetime="%1$s">%2$s</time><time class="post-meta__date--updated" datetime="%3$s">%4$s</time>';
        }
        $time_string = sprintf($time_string, esc_attr(get_the_date('c', $post_id)), esc_html(get_the_date(get_option('date_format'), $post_id)), esc_attr(get_the_modified_date('c', $post_id)), esc_html(get_the_modified_date()));
        $posted_on = sprintf(esc_html_x('%s', 'post date', '_s'), '<a title="Published" href="' . esc_url(get_permalink()) . '" rel="bookmark">' . $time_string . '</a>');
        //$byline = sprintf(esc_html_x('by %s', 'post author', '_s'), '<span class="author vcard"><a class="url fn n" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a></span>');
        echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.
    }
endif;