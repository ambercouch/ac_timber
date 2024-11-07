<?php
/*
 * Case Study
 */

// Registering the 'Case Study' Custom Post Type
$labels = array(
    'name' => _x('Faqs', 'post type general name'),
    'singular_name' => _x('Case Study', 'post type singular name'),
    'add_new' => _x('Add New', 'faq'),
    'add_new_item' => __('Add New Case Study'),
    'edit_item' => __('Edit Case Study'),
    'new_item' => __('New Case Study'),
    'all_items' => __('All Faqs'),
    'view_item' => __('View Faq'),
    'search_items' => __('Search Faqs'),
    'not_found' => __('No case Studies found'),
    'not_found_in_trash' => __('No case Studies found in the Trash'),
    'parent_item_colon' => '',
    'menu_name' => 'Faqs'
);
$args = array(
    'labels' => $labels,
    'description' => 'Holds our case Studies and faq specific data',
    'public' => true,
    'menu_position' => 10,
    'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
    'has_archive' => true,
    'menu_icon' => 'dashicons-editor-help',
    'show_in_rest' => false // Enables Gutenberg support
);

register_post_type('act_faq', $args);

// Registering the 'Service groups' Taxonomy
$labels = array(
    'name'              => _x('FAQ Categories', 'taxonomy general name'),
    'singular_name'     => _x('Service Group', 'taxonomy singular name'),
    'search_items'      => __('Search FAQ Categories'),
    'all_items'         => __('All FAQ Categories'),
    'parent_item'       => __('Parent Service Group'),
    'parent_item_colon' => __('Parent Service Group:'),
    'edit_item'         => __('Edit Service Group'),
    'update_item'       => __('Update Service Group'),
    'add_new_item'      => __('Add New Service Group'),
    'new_item_name'     => __('New Member Service Group'),
    'menu_name'         => __('FAQ Categories'),
);
$args = array(
    'hierarchical'      => true, // Behaves like categories (set to false if it behaves like tags)
    'labels'            => $labels,
    'show_ui'           => true,
    'show_admin_column' => true,
    'query_var'         => true,
    'rewrite'           => array('slug' => 'faq-category'),
    'show_in_rest'      => false // Enables Gutenberg support for taxonomy
);
register_taxonomy('faq_category', array('act_faq'), $args);

