<?php
function  act_cpt() {
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
    $args = array(
        'labels' => $labels,
        'description' => 'Ambercouch Projects',
        'public' => true,
        'menu_position' => 5,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'comments','page-attributes' ),
        'has_archive' => true,
    );
    register_post_type('project', $args);
//Services
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
    $args = array(
        'labels' => $labels,
        'menu_icon' => 'dashicons-store',
        'description' => 'Services offered',
        'public' => true,
        'menu_position' => 20,
        'supports' => array('title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'),
        'has_archive' => 'service'
    );
    register_post_type('service', $args);

//Service Categories
    $labels = array(
        'name'              => _x( 'Service Categories', 'taxonomy general name' ),
        'singular_name'     => _x( 'Service Category', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Service Categories' ),
        'all_items'         => __( 'All Service Categories' ),
        'edit_item'         => __( 'Edit Service Category' ),
        'update_item'       => __( 'Update Service Category' ),
        'add_new_item'      => __( 'Add New Service Category' ),
        'new_item_name'     => __( 'New Tile Service Category' ),
        'menu_name'         => __( 'Service Categories' ),
    );

    $args = array(
        'hierarchical'      => false,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'service-category' ),
    );

    register_taxonomy( 'service_category', array( 'service' ), $args );

//    $labels = array(
//        'name' => _x('Testimonials', 'post type general name'),
//        'singular_name' => _x('Testimonial', 'post type singular name'),
//        'add_new' => _x('Add New', 'Testimonial'),
//        'add_new_item' => __('Add New Testimonial'),
//        'edit_item' => __('Edit Testimonial'),
//        'new_item' => __('New Testimonial'),
//        'all_items' => __('All Testimonials'),
//        'view_item' => __('View Testimonial'),
//        'search_items' => __('Search Testimonials'),
//        'not_found' => __('No Testimonials found'),
//        'not_found_in_trash' => __('No Testimonials found in the trash'),
//        'parent_item_colon' => '',
//        'menu_name' => 'Testimonials'
//    );
//    $args = array(
//        'labels' => $labels,
//        'menu_icon' => 'dashicons-format-quote',
//        'description' => 'Testimonials offered',
//        'public' => true,
//        'menu_position' => 20,
//        'supports' => array('title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'),
//        'has_archive' => 'testimonial'
//    );
//    register_post_type('testimonial', $args);

}

add_action('init', 'act_cpt');
