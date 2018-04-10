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





//var_dump(get_field('call-to-action'));
//die;
$context = Timber::get_context();
$context['posts'] = Timber::get_posts();;
$context['footer_widgets'] = Timber::get_widgets('Footer');
$context['primary_widgets'] = Timber::get_widgets('Primary');
$context['template_class'] = '--tile-range';

$tile_groups = get_field('tile_groups',$post->id);

foreach ($tile_groups as $key => $group){

    $tiles = $group['tiles'];

    foreach ($tiles as $tile){
        $tile->image_tile = get_field('image_tile', $tile->ID);
        //ac_dd($tile);
    }
}

$context['tile_groups'] = $tile_groups;


//$cta = get_field('call-to-action');
//var_dump($cta);
//
//$context['cta'] = do_shortcode($cta);
//var_dump($context['cta']);
//die;
//echo '<pre>';
//print_r($context['tile_colour']);
//die;

$templates = array( 'single-tile-range.twig' , 'single.twig');

Timber::render( $templates, $context );