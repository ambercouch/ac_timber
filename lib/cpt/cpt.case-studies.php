<?php
/*
 * Case Study
 */

// Registering the 'Case Study' Custom Post Type
$labels = array(
    'name' => _x('Case Studies', 'post type general name'),
    'singular_name' => _x('Case Study', 'post type singular name'),
    'add_new' => _x('Add New', 'case-study'),
    'add_new_item' => __('Add New Case Study'),
    'edit_item' => __('Edit Case Study'),
    'new_item' => __('New Case Study'),
    'all_items' => __('All Case Studies'),
    'view_item' => __('View Case Study'),
    'search_items' => __('Search Case Studies'),
    'not_found' => __('No case Studies found'),
    'not_found_in_trash' => __('No case Studies found in the Trash'),
    'parent_item_colon' => '',
    'menu_name' => 'Case Studies'
);
$args = array(
    'labels' => $labels,
    'description' => 'Holds our case Studies and case-study-specific data',
    'public' => true,
    'menu_position' => 10,
    'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
    'has_archive' => true,
    'menu_icon' => 'dashicons-media-spreadsheet',
    'show_in_rest' => false // Enables Gutenberg support
);

register_post_type('act_case_study', $args);
