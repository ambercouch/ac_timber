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

}

add_action('init', 'tvb_tiles');