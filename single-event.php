<?php
/**
 * The Template for displaying all single posts
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */

if ( ! class_exists( 'Timber' ) ) {
    echo 'Timber not activated. Make sure you activate the plugin in <a href="/wp-admin/plugins.php#timber">/wp-admin/plugins.php</a>';
    return;
}

$context = Timber::get_context();
$post = Timber::query_post();
$context['post'] = $post;

require_once get_template_directory() . '/lib/wp-timber/functions/timber--comment-form.php';


$event_venue = eo_get_venue_address();

$context['event_venue_address'] =  isset($event_venue['address']) ? $event_venue['address'] : '';
$context['event_venue_city'] =  isset($event_venue['city']) ? $event_venue['city'] : '';
$context['event_venue_postcode'] =  isset($event_venue['postcode']) ? $event_venue['postcode'] : '';

$date_format = get_option('date_format');
$time_format = get_option('time_format');

$format = (eo_is_all_day() ? $date_format : $date_format . ' ' . $time_format);

$context['event_date'] = eo_get_the_start($date_format);
$context['event_time'] = eo_get_the_start($time_format);



if ( post_password_required( $post->ID ) ) {
    Timber::render( 'single-password.twig', $context );

} else {

    Timber::render( array( 'single-' . $post->ID . '.twig', 'single-event.twig', 'single.twig' , 'index.twig' ), $context );
}

