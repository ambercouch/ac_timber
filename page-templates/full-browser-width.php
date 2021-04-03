<?php /** Template Name: Full Browser Width
 *
 * @package WordPress
 * @subpackage ac_timber
 */

$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;
$context['primary_widgets'] = Timber::get_widgets('Primary');
$context['footer_widgets'] = Timber::get_widgets('Footer');
$context['template'] = 'full-browser-width';

//require_once get_template_directory() . '/lib/wp-timber/functions/timber--comment-form.php';
$templates = array( 'full-browser-width.twig', 'page.twig' );
Timber::render( $templates, $context );
