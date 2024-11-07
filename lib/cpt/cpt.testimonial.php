<?php
/*
 * Testimonial
 */

// Registering the 'Testimonial' Custom Post Type
$labels = array(
    'name' => _x('Testimonials', 'post type general name'),
    'singular_name' => _x('Testimonial', 'post type singular name'),
    'add_new' => _x('Add New', 'testimonial'),
    'add_new_item' => __('Add New Testimonial'),
    'edit_item' => __('Edit Testimonial'),
    'new_item' => __('New Testimonial'),
    'all_items' => __('All Testimonials'),
    'view_item' => __('View Testimonial'),
    'search_items' => __('Search Testimonials'),
    'not_found' => __('No testimonials found'),
    'not_found_in_trash' => __('No testimonials found in the Trash'),
    'parent_item_colon' => '',
    'menu_name' => 'Testimonials'
);
$args = array(
    'labels' => $labels,
    'description' => 'Holds our testimonials and testimonial-specific data',
    'public' => true,
    'menu_position' => 10,
    'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
    'has_archive' => true,
    'menu_icon' => 'dashicons-format-quote',
    'show_in_rest' => false // Enables Gutenberg support
);

register_post_type('testimonial', $args);
