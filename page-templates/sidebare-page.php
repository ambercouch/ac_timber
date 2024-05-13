<?php /** Template Name: Sidebar Page
 *
 * @package WordPress
 * @subpackage ac_timber
 */
$context = Timber::get_context();

/**  save the wordpress post **/
$WPPost = $post;

$templateSlug = 'page-sidebar';

$post = new TimberPost();
$context['post'] = $post;

$context['mainMod'] =  '--page-sidebar';
$context['template'] = $templateSlug;
$templates = array( 'page-sidebar-' . $post->post_name . '.twig', 'page-sidebar.twig', 'page.twig' );

if ( post_password_required( $post->ID ) ) {
    Timber::render( 'single-password.twig', $context );
} else {
    Timber::render( $templates, $context );
}
