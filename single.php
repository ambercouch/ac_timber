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
$context['template'] = 'single-'.$post->post_type;
$context['postType'] = $post->post_type;


if (false) { __('Be the first to leave a comment!', '_act'); }
if (false) { __('Submit a comment', '_act'); }
if (false) { __('comments for this post are closed', '_act'); }
if (false) { __('says', '_act'); }

if ( post_password_required( $post->ID ) ) {
	Timber::render( 'single-password.twig', $context );
} else {
	Timber::render( array( 'single-' . $post->ID . '.twig', 'single-' . $post->post_type . '.twig', 'single.twig' ), $context );
}
