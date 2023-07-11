<?php /** Template Name: Two Col Page
 *
 * @package WordPress
 * @subpackage ac_timber
 */
$templateSlug = 'page-two-col';
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
