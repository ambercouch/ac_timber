<?php
function  act_cpt() {
//Tiles
    $labels = array(
        'name' => _x('Events', 'post type general name'),
        'singular_name' => _x('Event', 'post type singular name'),
        'add_new' => _x('Add New', 'Event'),
        'add_new_item' => __('Add New Event'),
        'edit_item' => __('Edit Event'),
        'new_item' => __('New Event'),
        'all_items' => __('All Events'),
        'view_item' => __('View Event'),
        'search_items' => __('Search Events'),
        'not_found' => __('No Events found'),
        'not_found_in_trash' => __('No Events found in the trash'),
        'parent_item_colon' => '',
        'menu_name' => 'Events'
    );
    $args = array(
        'labels' => $labels,
        'menu_icon' => 'dashicons-format-chat',
        'description' => 'Events offered',
        'public' => true,
        'menu_position' => 20,
        'supports' => array('title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'),
        'has_archive' => 'event'
    );
    register_post_type('event', $args);

//Event Categories
    $labels = array(
        'name'              => _x( 'Event Categories', 'taxonomy general name' ),
        'singular_name'     => _x( 'Event Category', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Event Categories' ),
        'all_items'         => __( 'All Event Categories' ),
        'edit_item'         => __( 'Edit Event Category' ),
        'update_item'       => __( 'Update Event Category' ),
        'add_new_item'      => __( 'Add New Event Category' ),
        'new_item_name'     => __( 'New Tile Event Category' ),
        'menu_name'         => __( 'Event Categories' ),
    );

    $args = array(
        'hierarchical'      => false,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'event-category' ),
    );

    register_taxonomy( 'event_category', array( 'event' ), $args );

    //Event Locations
    $labels = array(
        'name'              => _x( 'Event Locations', 'taxonomy general name' ),
        'singular_name'     => _x( 'Event Location', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Event Locations' ),
        'all_items'         => __( 'All Event Locations' ),
        'edit_item'         => __( 'Edit Event Location' ),
        'update_item'       => __( 'Update Event Location' ),
        'add_new_item'      => __( 'Add New Event Location' ),
        'new_item_name'     => __( 'New Tile Event Location' ),
        'menu_name'         => __( 'Event Locations' ),
    );

    $args = array(
        'hierarchical'      => false,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'event-location' ),
    );

    register_taxonomy( 'event_location', array( 'event' ), $args );

}

add_action('init', 'act_cpt');