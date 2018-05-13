<?php
function  act_cpt() {
////ACTcpts
//    $labels = array(
//        'name' => _x('ACTcpts', 'post type general name'),
//        'singular_name' => _x('ACTcpt', 'post type singular name'),
//        'add_new' => _x('Add New', 'ACTcpt'),
//        'add_new_item' => __('Add New ACTcpt'),
//        'edit_item' => __('Edit ACTcpt'),
//        'new_item' => __('New ACTcpt'),
//        'all_items' => __('All ACTcpts'),
//        'view_item' => __('View ACTcpt'),
//        'search_items' => __('Search ACTcpts'),
//        'not_found' => __('No ACTcpts found'),
//        'not_found_in_trash' => __('No ACTcpts found in the trash'),
//        'parent_item_colon' => '',
//        'menu_name' => 'ACTcpts'
//    );
//    $args = array(
//        'labels' => $labels,
//        'menu_icon' => 'dashicons-store',
//        'description' => 'ACTcpts offered',
//        'public' => true,
//        'menu_position' => 20,
//        'supports' => array('title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'),
//        'has_archive' => 'actcpt'
//    );
//    register_post_type('actcpt', $args);
//
////ACTcpt Categories
//    $labels = array(
//        'name'              => _x( 'ACTcpt Categories', 'taxonomy general name' ),
//        'singular_name'     => _x( 'ACTcpt Category', 'taxonomy singular name' ),
//        'search_items'      => __( 'Search ACTcpt Categories' ),
//        'all_items'         => __( 'All ACTcpt Categories' ),
//        'edit_item'         => __( 'Edit ACTcpt Category' ),
//        'update_item'       => __( 'Update ACTcpt Category' ),
//        'add_new_item'      => __( 'Add New ACTcpt Category' ),
//        'new_item_name'     => __( 'New Tile ACTcpt Category' ),
//        'menu_name'         => __( 'ACTcpt Categories' ),
//    );
//
//    $args = array(
//        'hierarchical'      => false,
//        'labels'            => $labels,
//        'show_ui'           => true,
//        'show_admin_column' => true,
//        'query_var'         => true,
//        'rewrite'           => array( 'slug' => 'actcpt-category' ),
//    );
//
//    register_taxonomy( 'actcpt_category', array( 'actcpt' ), $args );
    
    //Services
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
        'supports' => array('title','editor','author','thumbnail','excerpt','custom-fields','revisions','page-attributes'),
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

    //Slides
    $labels = array(
        'name' => _x('Slides', 'post type general name'),
        'singular_name' => _x('Slide', 'post type singular name'),
        'add_new' => _x('Add New', 'Slide'),
        'add_new_item' => __('Add New Slide'),
        'edit_item' => __('Edit Slide'),
        'new_item' => __('New Slide'),
        'all_items' => __('All Slides'),
        'view_item' => __('View Slide'),
        'search_items' => __('Search Slides'),
        'not_found' => __('No Slides found'),
        'not_found_in_trash' => __('No Slides found in the trash'),
        'parent_item_colon' => '',
        'menu_name' => 'Slides'
    );
    $args = array(
        'labels' => $labels,
        'menu_icon' => 'dashicons-chart-area',
        'description' => 'Slides offered',
        'public' => true,
        'menu_position' => 20,
        'supports' => array('title','editor','author','revisions','page-attributes'),

        'has_archive' => 'slides'
    );
    register_post_type('slide', $args);

//Slide Categories
    $labels = array(
        'name'              => _x( 'Slide Groups', 'taxonomy general name' ),
        'singular_name'     => _x( 'Slide Group', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Slide Groups' ),
        'all_items'         => __( 'All Slide Groups' ),
        'edit_item'         => __( 'Edit Slide Group' ),
        'update_item'       => __( 'Update Slide Group' ),
        'add_new_item'      => __( 'Add New Slide Group' ),
        'new_item_name'     => __( 'New Tile Slide Group' ),
        'menu_name'         => __( 'Slide Groups' ),
    );

    $args = array(
        'hierarchical'      => false,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'slide-group' ),
    );

    register_taxonomy( 'slide_category', array( 'slide' ), $args );

}

add_action('init', 'act_cpt');

add_action( 'init', 'remove_custom_post_comment' );

function remove_custom_post_comment() {
//   remove_post_type_support( 'slide', 'title' );
//    remove_post_type_support( 'slide', 'editor' );
    remove_post_type_support( 'slide', 'comments' );
    remove_post_type_support( 'slide', 'discussion' );
}