<?php
/**
 * Created by PhpStorm.
 * User: owner
 * Date: 31/05/2016
 * Time: 11:16
 */
if ( ! class_exists( 'Timber' ) ) {
    echo 'Timber not activated. Make sure you activate the plugin in <a href="/wp-admin/plugins.php#timber">/wp-admin/plugins.php</a>';
    return;
}

$tile_colours = get_the_terms($post->ID, 'tile_colour');
foreach ($tile_colours as $key => $colour){
    $tile_colours[$key] = $colour->name;
}

$tile_material = get_the_terms($post->ID, 'tile_material');
foreach ($tile_material as $key => $material){
    $tile_material[$key] = $material->name;
}

$context = Timber::get_context();
$context['posts'] = Timber::get_posts();
$context['footer_widgets'] = Timber::get_widgets('Footer');
$context['primary_widgets'] = Timber::get_widgets('Primary');
$context['template_class'] = '--tile';
$context['tile_colour'] = $tile_colours;
$context['tile_material'] = $tile_material;
//echo '<pre>';
//print_r($context['tile_colour']);
//die;
$templates = array( 'tile.twig' , 'single.twig');

Timber::render( $templates, $context );