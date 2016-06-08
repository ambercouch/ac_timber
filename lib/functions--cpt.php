<?php
function  tvb_tiles() {
//Tiles
    $labels = array(
        'name' => _x('Tiles', 'post type general name'),
        'singular_name' => _x('Tile', 'post type singular name'),
        'add_new' => _x('Add New', 'Tile'),
        'add_new_item' => __('Add New Tile'),
        'edit_item' => __('Edit Tile'),
        'new_item' => __('New Tile'),
        'all_items' => __('All Tiles'),
        'view_item' => __('View Tile'),
        'search_items' => __('Search Tiles'),
        'not_found' => __('No Tiles found'),
        'not_found_in_trash' => __('No Tiles found in the trash'),
        'parent_item_colon' => '',
        'menu_name' => 'Tiles'
    );
    $args = array(
        'labels' => $labels,
        'menu_icon' => 'dashicons-layout',
        'description' => 'Tiles for the tile gallery',
        'public' => true,
        'menu_position' => 20,
        'supports' => array('title'),
        'has_archive' => 'tiles'
    );
    register_post_type('tile', $args);

//Tile colours
    $labels = array(
        'name'              => _x( 'Tile Colours', 'taxonomy general name' ),
        'singular_name'     => _x( 'Tile Colour', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Tile Colours' ),
        'all_items'         => __( 'All Tile Colours' ),
        'edit_item'         => __( 'Edit Tile Colour' ),
        'update_item'       => __( 'Update Tile Colour' ),
        'add_new_item'      => __( 'Add New Tile Colour' ),
        'new_item_name'     => __( 'New Tile Colour Name' ),
        'menu_name'         => __( 'Tile Colour' ),
    );

    $args = array(
        'hierarchical'      => false,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'colour' ),
    );

    register_taxonomy( 'tile_colour', array( 'tile' ), $args );
//Tile Material
    $labels = array(
        'name'              => _x( 'Tile Material', 'taxonomy general name' ),
        'singular_name'     => _x( 'Tile Material', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Tile Material' ),
        'all_items'         => __( 'All Tile Material' ),
        'edit_item'         => __( 'Edit Tile Material' ),
        'update_item'       => __( 'Update Tile Material' ),
        'add_new_item'      => __( 'Add New Tile Material' ),
        'new_item_name'     => __( 'New Tile Material Name' ),
        'menu_name'         => __( 'Tile Material' ),
    );

    $args = array(
        'hierarchical'      => false,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'colour' ),
    );

    register_taxonomy( 'tile_material', array( 'tile' ), $args );
//Tile size
    $labels = array(
        'name'              => _x( 'Tile Size', 'taxonomy general name' ),
        'singular_name'     => _x( 'Tile Size', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Tile Size' ),
        'all_items'         => __( 'All Tile Sizes' ),
        'edit_item'         => __( 'Edit Tile Size' ),
        'update_item'       => __( 'Update Tile Size' ),
        'add_new_item'      => __( 'Add New Tile Size' ),
        'new_item_name'     => __( 'New Tile Size' ),
        'menu_name'         => __( 'Tile Size' ),
    );

    $args = array(
        'hierarchical'      => false,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'size' ),
    );

    register_taxonomy( 'tile_size', array( 'tile' ), $args );

}

add_action('init', 'tvb_tiles');


function  tvb_work() {
//Tiles
    $labels = array(
        'name' => _x('Our Work', 'post type general name'),
        'singular_name' => _x('Our Work', 'post type singular name'),
        'add_new' => _x('Add New', 'Work'),
        'add_new_item' => __('Add New Work'),
        'edit_item' => __('Edit Work'),
        'new_item' => __('New Work'),
        'all_items' => __('All Work'),
        'view_item' => __('View Work'),
        'search_items' => __('Search Work'),
        'not_found' => __('No Work found'),
        'not_found_in_trash' => __('No Work found in the trash'),
        'parent_item_colon' => '',
        'menu_name' => 'Our Work'
    );
    $args = array(
        'labels' => $labels,
        'menu_icon' => 'dashicons-awards',
        'description' => 'Thomas Vaughan work galleries',
        'public' => true,
        'menu_position' => 20,
        'supports' => array('title', 'editor'),
        'has_archive' => 'thomas-vaughan-gallery'
    );
    register_post_type('our-work', $args);

//Work Type
    $labels = array(
        'name'              => _x( 'Work Type', 'taxonomy general name' ),
        'singular_name'     => _x( 'Work Type', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Types' ),
        'all_items'         => __( 'All Types' ),
        'edit_item'         => __( 'Edit Type' ),
        'update_item'       => __( 'Update Type' ),
        'add_new_item'      => __( 'Add New Type' ),
        'new_item_name'     => __( 'New Type' ),
        'menu_name'         => __( 'Work Type' ),
    );

    $args = array(
        'hierarchical'      => false,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'work-type' ),
    );

    register_taxonomy( 'work_type', array( 'our-work' ), $args );
}

add_action('init', 'tvb_work');