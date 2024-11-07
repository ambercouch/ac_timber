<?php

/*
 * Services
 */

// Registering the 'Service' Custom Post Type
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

// Args for the Service post type
$args = array(
    'labels' => $labels,
    'menu_icon' => 'dashicons-store',
    'description' => 'Lists services offered',
    'public' => true,
    'menu_position' => 10,
    'supports' => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'page-attributes', 'post-formats'),
    'has_archive' => 'service'
);
register_post_type('service', $args);

// Registering the 'Service groups' Taxonomy
$labels = array(
    'name'              => _x('Service Groups', 'taxonomy general name'),
    'singular_name'     => _x('Service Group', 'taxonomy singular name'),
    'search_items'      => __('Search Service Groups'),
    'all_items'         => __('All Service Groups'),
    'parent_item'       => __('Parent Service Group'),
    'parent_item_colon' => __('Parent Service Group:'),
    'edit_item'         => __('Edit Service Group'),
    'update_item'       => __('Update Service Group'),
    'add_new_item'      => __('Add New Service Group'),
    'new_item_name'     => __('New Member Service Group'),
    'menu_name'         => __('Service Groups'),
);
$args = array(
    'hierarchical'      => true, // Behaves like categories (set to false if it behaves like tags)
    'labels'            => $labels,
    'show_ui'           => true,
    'show_admin_column' => true,
    'query_var'         => true,
    'rewrite'           => array('slug' => 'service-group'),
    'show_in_rest'      => false // Enables Gutenberg support for taxonomy
);
register_taxonomy('service_group', array('service'), $args);
