<?php
/**

 */


if ( ! class_exists( 'Timber' ) ) {
    echo 'Timber not activated. Make sure you activate the plugin in <a href="/wp-admin/plugins.php#timber">/wp-admin/plugins.php</a>';
    return;
}
$args = array(
    'taxonomy' => 'work_type',
    'hide_empty' => false,
);
$tags_array = get_terms($args);
$fillterItems['work_type']['name'] = "Type";
$fillterItems['work_type']['tags'] = $tags_array;

$context = Timber::get_context();
$context['posts'] = Timber::get_posts();
$context['footer_widgets'] = Timber::get_widgets('Footer');
$context['primary_widgets'] = Timber::get_widgets('Primary');
$context['template_class'] = '--archive-our-work';
$context['tags'] = '--archive-our-work';
$context['tile_filters'] = $fillterItems;
$templates = array( 'archive-our-work.twig' , 'index.twig');

Timber::render( $templates, $context );