<?php
/**
 * The main template file
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since   Timber 0.1
 */

if ( ! class_exists( 'Timber' ) ) {
    echo 'Timber not activated. Make sure you activate the plugin in <a href="/wp-admin/plugins.php#timber">/wp-admin/plugins.php</a>';
    return;
}

//TODO : move this in out of the template and in to a function file
if(is_home() && !is_paged()){
    global $query_string;
    parse_str( $query_string, $args );
    $args['posts_per_page'] = 3;
    query_posts($args);
}

//if (is_front_page() && is_paged()) {
//    $posts_per_page = isset($query->query_vars['posts_per_page']) ? $query->query_vars['posts_per_page'] : get_option('posts_per_page');
//    // If you want to use 'offset', set it to something that passes empty()
//    // 0 will not work, but adding 0.1 does (it gets normalized via absint())
//    // I use + 1, so it ignores the first post that is already on the front page
//    $query->query_vars['offset'] = (($query->query_vars['paged'] - 2) * $posts_per_page) + 1;
//}
$context = Timber::get_context();
$context['posts'] = Timber::get_posts();
$context['foo'] = 'bar';
$context['footer_widgets'] = Timber::get_widgets('Footer');
//$context['wp_oembed_get'] = TimberHelper::function_wrapper( 'wp_oembed_get', array('https://www.youtube.com/watch?v=FV96XY7Etmo', ['width'=>780]) );
$templates = array( 'index.twig' );
if ( is_home() ) {
    array_unshift( $templates, 'home.twig' );
}



Timber::render( $templates, $context );

