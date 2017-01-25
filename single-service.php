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
$context['post'] = $post;

$service_category = wp_get_post_terms($post->ID, 'service_category');


$context['serviceCategory']  = $service_category[0];

$context['serviceImage'] = get_field('service_image');

if (get_field('banner_image') != '')
{
    $context['bannerImage'] = get_field('banner_image');
}

if(get_field('content_image') != '')
{
    $context['contentImage'] = get_field('content_image');
    //ac_dd( $context['contentImage']);
}

$context['serviceFooter'] = get_field('service_footer');

//if (has_post_thumbnail() && get_field('banner_image') == '' )
//{
//    $thumb_id = get_post_thumbnail_id();
//    $thumb_src = wp_get_attachment_image_url($thumb_id);
//    $thumb_alt = get_post_meta( $thumb_id, '_wp_attachment_image_alt', true);
//}
//ac_dd($context['serviceBanner']);


require_once get_template_directory() . '/lib/wp-timber/timber--comment-form.php';

if ( post_password_required( $post->ID ) ) {
	Timber::render( 'single-password.twig', $context );
} else {
	Timber::render( array( 'single-' . $post->ID . '.twig', 'single-' . $post->post_type . '.twig', 'single.twig' ), $context );
}
