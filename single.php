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
$context['template'] = $post->post_type;
$context['postType'] = $post->post_type;

//Page Quoutes show a testiomnial on a case study page
$pageQuote = new TimberPost(get_field('page_testimonial'));

$quoteImg = get_field('quote_background_image', $pageQuote->ID);

$quoteText = get_the_excerpt($pageQuote->ID);
$quoteName = get_field('citation_name', $pageQuote->ID);
$quoteInfo = get_field('citation_info', $pageQuote->ID);

$context['pageQuote'] = array(
    'quoteImg' => $quoteImg,
    'quoteText' => $quoteText,
    'quoteName' => $quoteName,
    'quoteInfo' => $quoteInfo
);

//ac_dd($quoteImg);

require_once get_template_directory() . '/lib/wp-timber/timber--comment-form.php';

if ( post_password_required( $post->ID ) ) {
	Timber::render( 'single-password.twig', $context );
} else {
	Timber::render( array( 'single-' . $post->ID . '.twig', 'single-' . $post->post_type . '.twig', 'single.twig' ), $context );
}
