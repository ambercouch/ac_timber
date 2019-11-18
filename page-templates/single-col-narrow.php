<?php /** Template Name: Single Column Narrow
 *
 * @package WordPress
 * @subpackage ac_timber
 */
$template = 'single-col-narrow';
$postType = 'page';


$context = Timber::get_context();
$post = new TimberPost();


$context['post'] = $post;

$context['template'] = $template;
$context['postType'] = $postType;
$context['main_mod'] = '--'.$template;

$context['primary_widgets'] = Timber::get_widgets('Primary');
$context['footer_widgets'] = Timber::get_widgets('Footer');

//require_once get_template_directory() . '/lib/wp-timber/functions/timber--comment-form.php';
$templates = array( 'single-col-narrow.twig', 'page.twig' );
Timber::render( $templates, $context );
