<?php /** Template Name: Feature Categories
 *
 * @package WordPress
 * @subpackage ac_timber
 */

$context = Timber::get_context();
//$post = new TimberPost();
$cat_ids = array(1,2);

foreach ($cat_ids as $cat_id)
{
    $args = array(
        // Get all posts
        'posts_per_page' => 5,
        'cat' => $cat_id
    );
    $fCats[$cat_id]['title'] = get_cat_name($cat_id);
    $fCats[$cat_id]['posts'] = Timber::get_posts($args);
}

//ac_dd($fCats);

$context['feature_cats'] = $fCats;
$context['primary_widgets'] = Timber::get_widgets('Primary');
$context['footer_widgets'] = Timber::get_widgets('Footer');
$context['template_class'] = '--feature-cats';

//require_once get_template_directory() . '/lib/wp-timber/functions/timber--comment-form.php';
$templates = array( 'feature-categories.twig' );
Timber::render( $templates, $context );
