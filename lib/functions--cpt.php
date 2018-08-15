<?php
function  act_cpt() {

    $labels = array(
        'name' => _x('Services', 'post type general name'),
        'singular_name' => _x('Service', 'post type singular name'),
        'add_new' => _x('Add New', 'Service'),
        'add_new_item' => __('Add New Service'),
        'edit_item' => __('Edit Service'),
        'new_item' => __('New Service'),
        'all_items' => __('All Services'),
        'view_item' => __('View Service'),
        'search_items' => __('Search Services'),
        'not_found' => __('No Services found'),
        'not_found_in_trash' => __('No Services found in the trash'),
        'parent_item_colon' => '',
        'menu_name' => 'Services'
    );
    $args = array(
        'labels' => $labels,
        'menu_icon' => 'dashicons-store',
        'description' => 'Services offered',
        'public' => true,
        'menu_position' => 20,
        'supports' => array('title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'),
        'has_archive' => 'service'
    );
    register_post_type('service', $args);

//Service Categories
    $labels = array(
        'name'              => _x( 'Service Categories', 'taxonomy general name' ),
        'singular_name'     => _x( 'Service Category', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Service Categories' ),
        'all_items'         => __( 'All Service Categories' ),
        'edit_item'         => __( 'Edit Service Category' ),
        'update_item'       => __( 'Update Service Category' ),
        'add_new_item'      => __( 'Add New Service Category' ),
        'new_item_name'     => __( 'New Tile Service Category' ),
        'menu_name'         => __( 'Service Categories' ),
    );

    $args = array(
        'hierarchical'      => false,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'service-category' ),
    );

    register_taxonomy( 'service_category', array( 'service' ), $args );
    
    //BRANDS

    $labels = array(
        'name' => _x('Brands', 'post type general name'),
        'singular_name' => _x('Brand', 'post type singular name'),
        'add_new' => _x('Add New', 'Brand'),
        'add_new_item' => __('Add New Brand'),
        'edit_item' => __('Edit Brand'),
        'new_item' => __('New Brand'),
        'all_items' => __('All Brands'),
        'view_item' => __('View Brand'),
        'search_items' => __('Search Brands'),
        'not_found' => __('No Brands found'),
        'not_found_in_trash' => __('No Brands found in the trash'),
        'parent_item_colon' => '',
        'menu_name' => 'Brands'
    );
    $args = array(
        'labels' => $labels,
        'menu_icon' => 'dashicons-products',
        'description' => 'Brands offered',
        'public' => true,
        'menu_position' => 20,
        'supports' => array('title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'),
        'has_archive' => 'brand'
    );
    register_post_type('brand', $args);

//Brand Categories
    $labels = array(
        'name'              => _x( 'Brand Categories', 'taxonomy general name' ),
        'singular_name'     => _x( 'Brand Category', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Brand Categories' ),
        'all_items'         => __( 'All Brand Categories' ),
        'edit_item'         => __( 'Edit Brand Category' ),
        'update_item'       => __( 'Update Brand Category' ),
        'add_new_item'      => __( 'Add New Brand Category' ),
        'new_item_name'     => __( 'New Tile Brand Category' ),
        'menu_name'         => __( 'Brand Categories' ),
    );

    $args = array(
        'hierarchical'      => false,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'brand-category' ),
    );

    register_taxonomy( 'brand_category', array( 'brand' ), $args );

}

add_action('init', 'act_cpt');