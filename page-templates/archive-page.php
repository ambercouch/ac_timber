<?php

use Timber\Post;
use Timber\PostQuery;

/** Template Name: Archive Page
 *
 * @package WordPress
 * @subpackage ac_timber
 */


require_once get_theme_file_path() . '/lib/wp-timber/timber--nav-menu.php';

$templates = array('archive.twig', 'home.twig' );

$context = Timber::context();

$context['title'] = 'Archive';
if ( is_day() ) {
    $context['title'] = 'Archive: ' . get_the_date( 'D M Y' );
} elseif ( is_month() ) {
    $context['title'] = 'Archive: ' . get_the_date( 'M Y' );
} elseif ( is_year() ) {
    $context['title'] = 'Archive: ' . get_the_date( 'Y' );
} elseif ( is_tag() ) {
    $context['title'] = single_tag_title( '', false );
} elseif ( is_category() ) {
    $cate = get_the_category();
    $tax = $cate[0]->taxonomy;
    $cate_slug = $cate[0]->slug;
    $context['title'] = single_cat_title( '', false );
    array_unshift( $templates, 'archive-' . get_query_var( 'cat' ) . '.twig' );
    array_unshift( $templates,  'archive-' . $cate_slug . '.twig' );
    $context['cate'] = $tax.'-'.$cate_slug;
} elseif ( is_post_type_archive() ) {
    $context['title'] = post_type_archive_title( '', false );
    array_unshift( $templates, 'archive-' . get_post_type() . '.twig' );
}

$page_for_posts = get_option( 'page_for_posts' );

$post = new Timber\Post( $page_for_posts );

$context['post'] = $post;

$context['posts'] = new Timber\PostQuery();

Timber::render( $templates, $context );
