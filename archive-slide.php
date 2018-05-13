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

global $post;

$archive = get_queried_object();

$archive_slug = $archive->rewrite['slug'];

$context = Timber::get_context();

$args = array(
    // Get post type project
    'post_type' => $archive_slug,
    // Get all posts
    'posts_per_page' => -1,
    // Gest post by "graphic" category
//    'meta_query' => array(
//        array(
//            'key' => 'project_category',
//            'value' => 'graphic',
//            'compare' => 'LIKE'
//        )
//    ),
    // Order by post date
    'orderby' => array(
        'date' => 'ASC'
    ),
);


$context['posts'] = Timber::get_posts($args);

$context['template'] = 'archive';



$context['archive'] = $archive;

$context['archiveSlug'] = $archive_slug;

$context['archiveEmpty'] = ($post)? 'has-posts' : 'is-empty';

$templates = array( 'archive-'.$archive_slug.'.twig' , 'archive.twig' , 'index.twig');


Timber::render( $templates, $context );