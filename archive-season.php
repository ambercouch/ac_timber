<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since   Timber 0.2
 */

$templates = array( 'archive-season.twig', 'archive.twig', 'index.twig' );

$context = Timber::context();

$context['title'] = 'Seasons';

$context['posts'] = Timber::get_posts();

Timber::render( $templates, $context );
