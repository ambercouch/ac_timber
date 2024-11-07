<?php

/*
 * Team Members
 */

// Registering the 'Team Member' Custom Post Type
$labels = array(
    'name' => _x('Team Members', 'post type general name'),
    'singular_name' => _x('Team Member', 'post type singular name'),
    'add_new' => _x('Add New', 'team member'),
    'add_new_item' => __('Add New Team Member'),
    'edit_item' => __('Edit Team Member'),
    'new_item' => __('New Team Member'),
    'all_items' => __('All Team Members'),
    'view_item' => __('View Team Member'),
    'search_items' => __('Search Team Members'),
    'not_found' => __('No team members found'),
    'not_found_in_trash' => __('No team members found in the Trash'),
    'parent_item_colon' => '',
    'menu_name' => 'Team Members'
);
// Args for the 'Team Member' post type
$args = array(
    'labels' => $labels,
    'description' => 'Holds our team members and their specific data',
    'public' => true,
    'menu_position' => 10,
    'supports' => array('title', 'thumbnail', 'excerpt'),
    'has_archive' => true,
    'menu_icon' => 'dashicons-groups',
    'show_in_rest' => false // Enables Gutenberg support
);

register_post_type('act_team_member', $args);

// Registering the 'Member Type' Taxonomy
$labels = array(
    'name'              => _x('Member Types', 'taxonomy general name'),
    'singular_name'     => _x('Member Type', 'taxonomy singular name'),
    'search_items'      => __('Search Member Types'),
    'all_items'         => __('All Member Types'),
    'parent_item'       => __('Parent Member Type'),
    'parent_item_colon' => __('Parent Member Type:'),
    'edit_item'         => __('Edit Member Type'),
    'update_item'       => __('Update Member Type'),
    'add_new_item'      => __('Add New Member Type'),
    'new_item_name'     => __('New Member Type Name'),
    'menu_name'         => __('Member Types'),
);
$args = array(
    'hierarchical'      => true, // Behaves like categories (set to false if it behaves like tags)
    'labels'            => $labels,
    'show_ui'           => true,
    'show_admin_column' => true,
    'query_var'         => true,
    'rewrite'           => array('slug' => 'member-type'),
    'show_in_rest'      => false // Enables Gutenberg support for taxonomy
);

//register_taxonomy('member_type', array('team_member'), $args);

add_image_size ( 'teamMember600', 600, 900, true );
add_image_size ( 'teamMember300', 300, 450, true );
