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
$context = Timber::get_context();
$context['post'] = new TimberPost();
$context['posts'] = new Timber\PostQuery();
$context['foo'] = 'bar';

$postPageId = get_option( 'page_for_posts' );

$context['pageBannerImg'] = get_field('page_banner_image', $postPageId);
$context['pageBannerContent'] = get_field('page_banner_content', $postPageId);
$context['pageBannerLogo'] = get_field('page_banner_logo', $postPageId);

$context['cssPageBannerImageSaturation'] = get_field('page_banner_image_saturation', $postPageId);
$context['cssPageBannerColourCast'] = get_field('page_banner_image_colour_cast', $postPageId);
$context['cssPageBannerColourCastColour'] = get_field('page_banner_image_colour_cast_colour', $postPageId);
$context['cssPageBannerColourCastOpacity'] = get_field('page_banner_image_colour_cast_opacity', $postPageId);
$context['cssPageBannerColourCastMode'] = get_field('page_banner_image_colour_cast_mode', $postPageId);
$context['cssPageBannerImageHeight'] = get_field('page_banner_image_height', $postPageId);
$context['cssPageBannerImagePositionHorizontal'] = get_field('page_banner_image_position_horizontal', $postPageId);


if (is_category()){
    $context['catTitle'] = post_type_archive_title( '', false );;
    $context['catDescription'] = category_description();
}

$templates = array( 'index.twig' );
if ( is_home() ) {
    array_unshift( $templates, 'home.twig' );
}
Timber::render( $templates, $context );
