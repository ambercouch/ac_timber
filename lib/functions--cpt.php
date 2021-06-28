<?php
function  act_cpt() {
    $labels = array(
        'name' => _x('Gallery Items', 'post type general name'),
        'singular_name' => _x('Gallery Item', 'post type singular name'),
        'add_new' => _x('Add New', 'gallery item'),
        'add_new_item' => __('Add New Gallery Item'),
        'edit_item' => __('Edit Gallery Item'),
        'new_item' => __('New Gallery Item'),
        'all_items' => __('All Gallery Items'),
        'view_item' => __('View Gallery Item'),
        'search_items' => __('Search Gallery Items'),
        'not_found' => __('No gallery items found'),
        'not_found_in_trash' => __('No gallery items found in the Trash'),
        'parent_item_colon' => '',
        'menu_name' => 'Gallery'
    );
    $args = array(
        'labels' => $labels,
        'description' => 'Cov19chronicles art work',
        'public' => true,
        'menu_position' => 5,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'comments','page-attributes' ),
        'has_archive' => true,
    );
    register_post_type('gallery-item', $args);

    $labels = array(
        'name'              => _x( 'Item Type', 'taxonomy general name' ),
        'singular_name'     => _x( 'Item Type', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Item Types' ),
        'all_items'         => __( 'All Item Types' ),
        'edit_item'         => __( 'Edit Item Type' ),
        'update_item'       => __( 'Update Item Type' ),
        'add_new_item'      => __( 'Add New Item Type' ),
        'new_item_name'     => __( 'New Item Type' ),
        'menu_name'         => __( 'Gallery Item Types' ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'gallery-type' ),
    );

    register_taxonomy( 'gallery_type', array( 'gallery-item' ), $args );

//    $labels = array(
//        'name' => _x('Testimonials', 'post type general name'),
//        'singular_name' => _x('Testimonial', 'post type singular name'),
//        'add_new' => _x('Add New', 'Testimonial'),
//        'add_new_item' => __('Add New Testimonial'),
//        'edit_item' => __('Edit Testimonial'),
//        'new_item' => __('New Testimonial'),
//        'all_items' => __('All Testimonials'),
//        'view_item' => __('View Testimonial'),
//        'search_items' => __('Search Testimonials'),
//        'not_found' => __('No Testimonials found'),
//        'not_found_in_trash' => __('No Testimonials found in the trash'),
//        'parent_item_colon' => '',
//        'menu_name' => 'Testimonials'
//    );
//    $args = array(
//        'labels' => $labels,
//        'menu_icon' => 'dashicons-format-quote',
//        'description' => 'Testimonials offered',
//        'public' => true,
//        'menu_position' => 20,
//        'supports' => array('title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'),
//        'has_archive' => 'testimonial'
//    );
//    register_post_type('testimonial', $args);

}

add_action('init', 'act_cpt');
