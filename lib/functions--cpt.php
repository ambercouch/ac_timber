<?php
function  act_cpt() {
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
        'menu_icon' => 'dashicons-admin-plugins',
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

    //Projects
    $labels = array(
        'name' => _x('Projects', 'project type general name'),
        'singular_name' => _x('Project', 'project type singular name'),
        'add_new' => _x('Add New', 'Project'),
        'add_new_item' => __('Add New Project'),
        'edit_item' => __('Edit Project'),
        'new_item' => __('New Project'),
        'all_items' => __('All Projects'),
        'view_item' => __('View Project'),
        'search_items' => __('Search Projects'),
        'not_found' => __('No Projects found'),
        'not_found_in_trash' => __('No Projects found in the trash'),
        'parent_item_colon' => '',
        'menu_name' => 'Projects'
    );
    $args = array(
        'labels' => $labels,
        'menu_icon' => 'dashicons-admin-home',
        'description' => 'Projects offered',
        'public' => true,
        'menu_position' => 20,
        'supports' => array('title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','project-formats'),
        'has_archive' => 'project'
    );
    register_post_type('project', $args);

    //Project Categories
    $labels = array(
        'name'              => _x( 'Project Categories', 'taxonomy general name' ),
        'singular_name'     => _x( 'Project Category', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Project Categories' ),
        'all_items'         => __( 'All Project Categories' ),
        'edit_item'         => __( 'Edit Project Category' ),
        'update_item'       => __( 'Update Project Category' ),
        'add_new_item'      => __( 'Add New Project Category' ),
        'new_item_name'     => __( 'New Tile Project Category' ),
        'menu_name'         => __( 'Project Categories' ),
    );

    $args = array(
        'hierarchical'      => false,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'project-category' ),
    );

    register_taxonomy( 'project_category', array( 'project' ), $args );

    //FAQs
    $labels = array(
        'name' => _x('Faqs', 'faq type general name'),
        'singular_name' => _x('Faq', 'faq type singular name'),
        'add_new' => _x('Add New', 'Faq'),
        'add_new_item' => __('Add New Faq'),
        'edit_item' => __('Edit Faq'),
        'new_item' => __('New Faq'),
        'all_items' => __('All Faqs'),
        'view_item' => __('View Faq'),
        'search_items' => __('Search Faqs'),
        'not_found' => __('No Faqs found'),
        'not_found_in_trash' => __('No Faqs found in the trash'),
        'parent_item_colon' => '',
        'menu_name' => 'Faqs'
    );
    $args = array(
        'labels' => $labels,
        'menu_icon' => 'dashicons-format-chat',
        'description' => 'Faqs offered',
        'public' => true,
        'menu_position' => 20,
        'supports' => array('title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','faq-formats'),
        'has_archive' => 'faq'
    );
    register_post_type('faq', $args);

    //Faq Categories
    $labels = array(
        'name'              => _x( 'Faq Categories', 'taxonomy general name' ),
        'singular_name'     => _x( 'Faq Category', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Faq Categories' ),
        'all_items'         => __( 'All Faq Categories' ),
        'edit_item'         => __( 'Edit Faq Category' ),
        'update_item'       => __( 'Update Faq Category' ),
        'add_new_item'      => __( 'Add New Faq Category' ),
        'new_item_name'     => __( 'New Tile Faq Category' ),
        'menu_name'         => __( 'Faq Categories' ),
    );

    $args = array(
        'hierarchical'      => false,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'faq-category' ),
    );

    register_taxonomy( 'faq_category', array( 'faq' ), $args );

}

add_action('init', 'act_cpt');