<?php
/**
 * Template Name: Parent Page
 *
 * @package WordPress
 * @subpackage ac_timber
 */



$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;
$context['primary_widgets'] = Timber::get_widgets('Primary');
$context['footer_widgets'] = Timber::get_widgets('Footer');
$context['template_class'] = '--parent-page';
//require_once get_template_directory() . '/lib/wp-timber/functions/timber--comment-form.php';
$templates = array( 'page-parent-page.twig', 'page.twig' );
Timber::render( $templates, $context );
