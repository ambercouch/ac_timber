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

$context = Timber::get_context();
$context['posts'] = Timber::get_posts();
$context['footer_widgets'] = Timber::get_widgets('Footer');
$context['primary_widgets'] = Timber::get_widgets('Primary');
$context['template_class'] = '--tile';
$templates = array( 'tile.twig' , 'single.twig');

Timber::render( $templates, $context );