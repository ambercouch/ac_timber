<?php

/*
 * Vacancies
 */

// Registering the 'Vacancy' Custom Post Type
$labels = array(
    'name' => _x('Vacancies', 'post type general name'),
    'singular_name' => _x('Vacancy', 'post type singular name'),
    'add_new' => _x('Add New', 'vacancy'),
    'add_new_item' => __('Add New Vacancy'),
    'edit_item' => __('Edit Vacancy'),
    'new_item' => __('New Vacancy'),
    'all_items' => __('All Vacancies'),
    'view_item' => __('View Vacancy'),
    'search_items' => __('Search Vacancies'),
    'not_found' => __('No vacancies found'),
    'not_found_in_trash' => __('No vacancies found in the Trash'),
    'parent_item_colon' => '',
    'menu_name' => 'Vacancies'
);
$args = array(
    'labels' => $labels,
    'description' => 'Lists current job vacancies',
    'public' => true,
    'menu_position' => 10,
    'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
    'has_archive' => true,
    'menu_icon' => 'dashicons-businessman',
    'show_in_rest' => false // Enables Gutenberg support
);

register_post_type('vacancy', $args);
