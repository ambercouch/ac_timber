<?php

if ( ! class_exists( 'Timber' ) ) {
    echo 'Timber not activated. Make sure you activate the plugin in <a href="/wp-admin/plugins.php#timber">/wp-admin/plugins.php</a>';

    return;
}

$context            = Timber::context();
$context['sidebar'] = Timber::get_widgets( 'shop-sidebar' );


if ( is_singular( 'product' ) ) {

    $product_badge_position = get_field('product_badge_position');

    $context['post']    = Timber::get_post();
    $product            = wc_get_product( $context['post']->ID );
    $context['product'] = $product;
    if ($product_badge_position and $product_badge_position != 'hidden'){
        $context['image_product_badge'] = get_field('image_product_badge');
        $context['product_badge_position'] =  $product_badge_position;
    }

    // Get related products
    $related_limit               = wc_get_loop_prop( 'columns' );
    $related_ids                 = wc_get_related_products( $context['post']->id, $related_limit );
    $context['related_products'] = Timber::get_posts( $related_ids );

    // Restore the context and loop back to the main query loop.
    wp_reset_postdata();

    Timber::render( 'woocommerce/single-product.twig', $context );
} else {
    $context['post']    = Timber::get_post(6);
    $posts = Timber::get_posts();
    $context['products'] = $posts;

    if ( is_product_category() ) {
        $queried_object = get_queried_object();
        $term_id = $queried_object->term_id;
        $term = get_term( $term_id, 'product_cat' );
        $context['category'] = $term;
        $context['title'] = single_term_title( '', false );
    }

    if(is_shop()){
        $context['collectionMod'] = 'all';
    } else {
        $context['collectionMod'] = $term;
    }

    Timber::render( 'woocommerce/archive.twig', $context );
}
