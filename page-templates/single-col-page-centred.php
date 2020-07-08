<?php /** Template Name: Page Single Column
 *
 * @package WordPress
 * @subpackage ac_timber
 */
$templateSlug = 'page-single-col';
$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;
$context['primary_widgets'] = Timber::get_widgets('Primary');
$context['footer_widgets'] = Timber::get_widgets('Footer');
$context['template'] = $templateSlug;

//require_once get_template_directory() . '/lib/wp-timber/functions/timber--comment-form.php';
$templates = array( $templateSlug.'.twig', 'page.twig' );

if ( post_password_required( $post->ID ) ) {
    Timber::render( 'single-password.twig', $context );
} else {
    Timber::render( $templates, $context );
}
