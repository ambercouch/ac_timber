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
    echo 'Timber not activated. Make sure you activate the plugin in <a href="/cms/wp-admin/plugins.php#timber">cms/wp-admin/plugins.php</a>';
    return;
}

$query_object = get_queried_object();
//echo '<pre>';
//print_r($query_object); die();

if(property_exists($query_object, 'slug'))
{
    $tax_query = array(
        array(
            'taxonomy' => 'gallery_type',
            'field'    => 'slug',
            'terms'    => $query_object->slug
        )
    );
}else{
    $tax_query = false;
}


global $paged;
if (!isset($paged) || !$paged){
    $paged = 1;
}

require_once get_theme_file_path() . '/lib/wp-timber/timber--nav-menu.php';

$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;

$args = array(
    'post_type' => 'gallery-item',
    'posts_per_page' => 10,
    'paged' => $paged,
    'tax_query' => $tax_query
);

$context['posts'] = new Timber\PostQuery($args);
$context['foo'] = 'bar';


$context['bannerImgPage'] = (get_field('banner_image', $post) == '') ?  false : get_field('banner_image', $post);


//ac_dd($post);

$templates = array('archive-gallery-item.twig', 'archive.twig', 'home.twig' );
//if ( is_home() ) {
//    array_unshift( $templates, 'home.twig' );
//}
Timber::render( $templates, $context );

//require_once get_theme_file_path() . '/lib/wp-timber/timber--nav-menu.php';
