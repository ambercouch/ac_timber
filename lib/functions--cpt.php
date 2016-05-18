<?php
function  tvb_tiles() {
    //course dates
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
    //course_dates

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

}

add_action('init', 'tvb_tiles');