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
$context = Timber::get_context();
$post = Timber::query_post();
$context['post'] = $post;
$context['mainMod'] = '--'.$post->post_type;
$context['contentMod'] = '--'.$post->post_type;
$context['template'] = $post->post_type;
$context['postType'] = $post->post_type;
$season_content = get_field('season_content', $post->ID);
$context['season_content'] = Timber::get_posts($post->meta('season_content'));
//$context['season_content'] = $season_content ? array_map(function($post_id) {
//    return new Timber\Post($post_id);
//}, wp_list_pluck($season_content, 'ID')) : [];
$context['is_admin'] = current_user_can('administrator');

require_once get_template_directory() . '/lib/wp-timber/timber--comment-form.php';

if ( post_password_required( $post->ID ) ) {
	Timber::render( 'single-password.twig', $context );
} else {
	Timber::render( array( 'single-' . $post->ID . '.twig', 'single-' . $post->post_type . '.twig', 'single.twig' ), $context );
}
