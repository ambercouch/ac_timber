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


    //STAFF

    $labels = array(
        'name' => _x('Staff', 'post type general name'),
        'singular_name' => _x('Staff', 'post type singular name'),
        'add_new' => _x('Add New', 'Staff'),
        'add_new_item' => __('Add New Staff'),
        'edit_item' => __('Edit Staff'),
        'new_item' => __('New Staff'),
        'all_items' => __('All Staff'),
        'view_item' => __('View Staff'),
        'search_items' => __('Search Staff'),
        'not_found' => __('No Staff found'),
        'not_found_in_trash' => __('No Staff found in the trash'),
        'parent_item_colon' => '',
        'menu_name' => 'Staff'
    );
    $args = array(
        'labels' => $labels,
        'menu_icon' => 'dashicons-groups',
        'description' => 'Staff members',
        'public' => true,
        'menu_position' => 20,
        'supports' => array('title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'),
        'has_archive' => 'staff'
    );
    register_post_type('staff', $args);

//Staff Categories
    $labels = array(
        'name'              => _x( 'Staff Categories', 'taxonomy general name' ),
        'singular_name'     => _x( 'Staff Category', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Staff Categories' ),
        'all_items'         => __( 'All Staff Categories' ),
        'edit_item'         => __( 'Edit Staff Category' ),
        'update_item'       => __( 'Update Staff Category' ),
        'add_new_item'      => __( 'Add New Staff Category' ),
        'new_item_name'     => __( 'New Tile Staff Category' ),
        'menu_name'         => __( 'Staff Categories' ),
    );

    $args = array(
        'hierarchical'      => false,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'staff-category' ),
    );

    register_taxonomy( 'staff_category', array( 'staff' ), $args );

    //CASE STUDIES

    $labels = array(
        'name' => _x('Case Studies', 'post type general name'),
        'singular_name' => _x('Case Study', 'post type singular name'),
        'add_new' => _x('Add New', 'Case Study'),
        'add_new_item' => __('Add New Case Study'),
        'edit_item' => __('Edit Case Study'),
        'new_item' => __('New Case Study'),
        'all_items' => __('All Case Study'),
        'view_item' => __('View Case Study'),
        'search_items' => __('Search Case Study'),
        'not_found' => __('No Case Studys found'),
        'not_found_in_trash' => __('No Case Studys found in the trash'),
        'parent_item_colon' => '',
        'menu_name' => 'Case Studys'
    );
    $args = array(
        'labels' => $labels,
        'menu_icon' => 'dashicons-heart',
        'description' => 'Case Study members',
        'public' => true,
        'menu_position' => 20,
        'supports' => array('title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'),
        'has_archive' => 'case-study'
    );
    register_post_type('case-study', $args);

//Case Study Categories
    $labels = array(
        'name'              => _x( 'Case Study Categories', 'taxonomy general name' ),
        'singular_name'     => _x( 'Case Study Category', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Case Study Categories' ),
        'all_items'         => __( 'All Case Study Categories' ),
        'edit_item'         => __( 'Edit Case Study Category' ),
        'update_item'       => __( 'Update Case Study Category' ),
        'add_new_item'      => __( 'Add New Case Study Category' ),
        'new_item_name'     => __( 'New Tile Case Study Category' ),
        'menu_name'         => __( 'Case Study Categories' ),
    );

    $args = array(
        'hierarchical'      => false,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'case-study-category' ),
    );

    register_taxonomy( 'case-study_category', array( 'case-study' ), $args );

}

add_action('init', 'act_cpt');
