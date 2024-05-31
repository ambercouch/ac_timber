<?php /** Template Name: Full Width Page
 *
 * @package WordPress
 * @subpackage ac_timber
 */

$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;
$context['primary_widgets'] = Timber::get_widgets('Primary');
$context['footer_widgets'] = Timber::get_widgets('Footer');
$context['template_class'] = '--full-width';

//require_once get_template_directory() . '/lib/wp-timber/functions/timber--comment-form.php';
$templates = array( 'page-full-width.twig', 'page.twig' );
Timber::render( $templates, $context );
