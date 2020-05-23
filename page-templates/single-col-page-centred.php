<?php /** Template Name: Single Col Page Centred
 *
 * @package WordPress
 * @subpackage ac_timber
 */
$templateSlug = 'single-col-page-centred';
$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;
$context['template'] = $templateSlug;
$context['mainMod'] = is_front_page() ? '--front-page' : '--'.$templateSlug;

//require_once get_template_directory() . '/lib/wp-timber/functions/timber--comment-form.php';
$templates = array( $templateSlug.'.twig', 'page.twig' );

if ( post_password_required( $post->ID ) ) {
    Timber::render( 'single-password.twig', $context );
} else {
    Timber::render( $templates, $context );
}
