<?php

/*
 * Project
 */

// Registering the 'Project' Custom Post Type
$labels = array(
    'name' => _x('Projects', 'post type general name'),
    'singular_name' => _x('Project', 'post type singular name'),
    'add_new' => _x('Add New', 'project'),
    'add_new_item' => __('Add New Project'),
    'edit_item' => __('Edit Project'),
    'new_item' => __('New Project'),
    'all_items' => __('All Projects'),
    'view_item' => __('View Project'),
    'search_items' => __('Search Projects'),
    'not_found' => __('No projects found'),
    'not_found_in_trash' => __('No projects found in the Trash'),
    'parent_item_colon' => '',
    'menu_name' => 'Projects'
);

// Args for the Project post type
$args = array(
    'labels' => $labels,
    'description' => 'Holds our projects and project specific data',
    'menu_icon' => 'dashicons-portfolio',
    'public' => true,
    'menu_position' => 10,
    'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'comments', 'page-attributes'),
    'has_archive' => true,
);

register_post_type('act_project', $args);
