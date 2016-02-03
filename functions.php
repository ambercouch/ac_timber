<?php
//Love, love, love, love all you functions.

require_once get_template_directory() . '/lib/functions--timber.php';
require_once get_template_directory() . '/lib/functions--theme-setup.php';
require_once get_template_directory() . '/lib/functions--enqueue.php';
require_once get_template_directory() . '/lib/functions--template-tags.php';


add_action('pre_get_posts', '_set_offset_on_front_page');
function _set_offset_on_front_page(&$query)
{
    if (is_front_page() && is_paged()) {
        $posts_per_page = isset($query->query_vars['posts_per_page']) ? $query->query_vars['posts_per_page'] : get_option('posts_per_page');
        // If you want to use 'offset', set it to something that passes empty()
        // 0 will not work, but adding 0.1 does (it gets normalized via absint())
        // I use + 1, so it ignores the first post that is already on the front page
        $query->query_vars['offset'] = (($query->query_vars['paged'] - 2) * $posts_per_page) + 3;
    }
}
//add_action('pre_get_posts', '_set_home_post_count');
//function _set_home_post_count(&$query)
//{
////    global $wp_query;
////    $p = $wp_query->query_vars['paged'];
////    echo $p; die;
//    if(is_front_page() || !is_paged())
//    {
//        //echo 'tester'; die();
//    }
//}