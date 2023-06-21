<?php
/**
 * The Template for displaying all single posts
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */



$context = Timber::get_context();
$post = Timber::query_post();
$post_cats = get_the_category();
if(is_array($post_cats)){
    $post_cat_slug = get_the_category()[0]->slug;
}else{
    $post_cat_slug = 'uncategorized';
}

$context['post'] = $post;
$context['mainMod'] = '--single'.$post->post_type;
$context['contentMod'] = '--single-'.$post->post_type;
$context['template'] = 'single-'.$post->post_type;
$context['postType'] = $post->post_type;
$context['postType'] = $post->post_type;

require_once get_template_directory() . '/lib/wp-timber/timber--comment-form.php';

if ( post_password_required( $post->ID ) ) {
	Timber::render( 'single-password.twig', $context );
} else {
	Timber::render( array( 'single-' . $post->ID . '.twig', 'single-cat' . $post_cat_slug . '.twig', 'single-' . $post->post_type . '.twig', 'single.twig' ), $context );
}
