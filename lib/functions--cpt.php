<?php
function  act_cpt() {
//Tiles
    $labels = array(
        'name' => _x('Treatments', 'post type general name'),
        'singular_name' => _x('Treatment', 'post type singular name'),
        'add_new' => _x('Add New', 'Treatment'),
        'add_new_item' => __('Add New Treatment'),
        'edit_item' => __('Edit Treatment'),
        'new_item' => __('New Treatment'),
        'all_items' => __('All Treatments'),
        'view_item' => __('View Treatment'),
        'search_items' => __('Search Treatments'),
        'not_found' => __('No Treatments found'),
        'not_found_in_trash' => __('No Treatments found in the trash'),
        'parent_item_colon' => '',
        'menu_name' => 'Treatments'
    );
    $args = array(
        'labels' => $labels,
        'menu_icon' => 'dashicons-store',
        'description' => 'Treatments offered',
        'public' => true,
        'menu_position' => 20,
        'supports' => array('title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'),
        'has_archive' => 'treatment'
    );
    register_post_type('treatment', $args);

//Treatment Categories
    $labels = array(
        'name'              => _x( 'Treatment Categories', 'taxonomy general name' ),
        'singular_name'     => _x( 'Treatment Category', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Treatment Categories' ),
        'all_items'         => __( 'All Treatment Categories' ),
        'edit_item'         => __( 'Edit Treatment Category' ),
        'update_item'       => __( 'Update Treatment Category' ),
        'add_new_item'      => __( 'Add New Treatment Category' ),
        'new_item_name'     => __( 'New Tile Treatment Category' ),
        'menu_name'         => __( 'Treatment Categories' ),
    );

    $args = array(
        'hierarchical'      => false,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'treatment-category' ),
    );

    register_taxonomy( 'treatment_category', array( 'treatment' ), $args );

}

add_action('init', 'act_cpt');