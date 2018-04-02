<?php
function  tvb_tile_ranges() {
//Tiles
    $labels = array(
        'name' => _x('Tile Ranges', 'post type general name'),
        'singular_name' => _x('Tile Range', 'post type singular name'),
        'add_new' => _x('Add New', 'Range'),
        'add_new_item' => __('Add New Range'),
        'edit_item' => __('Edit Tile Range'),
        'new_item' => __('New Range'),
        'all_items' => __('All Ranges'),
        'view_item' => __('View Tile Range'),
        'search_items' => __('Search Tile Ranges'),
        'not_found' => __('No Tile Ranges found'),
        'not_found_in_trash' => __('No Tile Ranges found in the trash'),
        'parent_item_colon' => '',
        'menu_name' => 'Tile Ranges'
    );
    $args = array(
        'labels' => $labels,
        'menu_icon' => 'dashicons-layout',
        'description' => 'Tile Ranges for the tile gallery',
        'public' => true,
        'menu_position' => 20,
        'supports' => array('title'),
        'has_archive' => 'tile-ranges'
    );
    register_post_type('tile-range', $args);


}

add_action('init', 'tvb_tile_ranges');

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
        'menu_icon' => 'dashicons-admin-page',
        'description' => 'Tiles for the tile gallery',
        'public' => true,
        'menu_position' => 20,
        'supports' => array('title'),
        'has_archive' => 'tiles'
    );
    register_post_type('tile', $args);

//Tile Groups
    //Remove because it does not work as a Taxonomy
    $labels = array(
        'name'              => _x( 'Tile Groups', 'taxonomy general name' ),
        'singular_name'     => _x( 'Tile Group', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Tile Groups' ),
        'all_items'         => __( 'All Tile Groups' ),
        'edit_item'         => __( 'Edit Tile Group' ),
        'update_item'       => __( 'Update Tile Group' ),
        'add_new_item'      => __( 'Add New Tile Group' ),
        'new_item_name'     => __( 'New Tile Group Name' ),
        'menu_name'         => __( 'Tile Group' ),
    );

    $args = array(
        'hierarchical'      => false,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'group' ),
    );

    //register_taxonomy( 'tile_group', array( 'tile' ), $args );


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