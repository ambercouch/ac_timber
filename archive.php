<?php

/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since   Timber 0.2
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
} elseif (is_tax()){

    $q = get_queried_object();
    $tax_slug = strtr($q->taxonomy, '_', '-');
    $context['termTitle'] = $q->name;
    array_unshift( $templates, 'archive-' .  $tax_slug . '.twig' );
}

$page_for_posts = get_option( 'page_for_posts' );

$post = new Timber\Post( $page_for_posts );

$context['post'] = $post;

$context['posts'] = new Timber\PostQuery();

Timber::render( $templates, $context );
