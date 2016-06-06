<?php
/**
 * The main template file
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since   Timber 0.1
 */

if ( ! class_exists( 'Timber' ) ) {
    echo 'Timber not activated. Make sure you activate the plugin in <a href="/wp-admin/plugins.php#timber">/wp-admin/plugins.php</a>';
    return;
}
$args = array(
    'taxonomy' => 'tile_material',
    'hide_empty' => false,
);
$tags_array = get_terms($args);
$fillterItems['tile_material']['name'] = "Tile Material";
$fillterItems['tile_material']['tags'] = $tags_array;

$args = array(
    'taxonomy' => 'tile_colour',
    'hide_empty' => false,
);
$tags_array = get_terms($args);
$fillterItems['tile_colour']['name'] = "Tile Colour";
$fillterItems['tile_colour']['tags'] = $tags_array;

$args = array(
    'taxonomy' => 'tile_size',
    'hide_empty' => false,
);
$tags_array = get_terms($args);
$fillterItems['tile_size']['name'] = "Tile Size";
$fillterItems['tile_size']['tags'] = $tags_array;

$context = Timber::get_context();
$context['posts'] = Timber::get_posts();
$context['footer_widgets'] = Timber::get_widgets('Footer');
$context['primary_widgets'] = Timber::get_widgets('Primary');
$context['template_class'] = '--archive-tile';
$context['tags'] = '--archive-tile';
$context['tile_filters'] = $fillterItems;
$templates = array( 'archive-tile.twig' , 'index.twig');

Timber::render( $templates, $context );