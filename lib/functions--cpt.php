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
    //register_post_type('project', $args);
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

    //Case Studies
    $labels = array(
        'name' => _x('Case Studies', 'post type general name'),
        'singular_name' => _x('Case Study', 'post type singular name'),
        'add_new' => _x('Add New', 'Case Study'),
        'add_new_item' => __('Add New Case Study'),
        'edit_item' => __('Edit Case Study'),
        'new_item' => __('New Case Study'),
        'all_items' => __('All Case Studies'),
        'view_item' => __('View Case Study'),
        'search_items' => __('Search Case Studies'),
        'not_found' => __('No Case Studies found'),
        'not_found_in_trash' => __('No Case Studies found in the trash'),
        'parent_item_colon' => '',
        'menu_name' => 'Case Studies'
    );
    $args = array(
        'labels' => $labels,
        'menu_icon' => 'dashicons-book-alt',
        'description' => 'Case Studies offered',
        'public' => true,
        'menu_position' => 20,
        'supports' => array('title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'),
        'has_archive' => 'case-study'
    );
    register_post_type('case-study', $args);

    //Stuff
    $labels = array(
        'name' => _x('Stuff', 'post type general name'),
        'singular_name' => _x('Stuff', 'post type singular name'),
        'add_new' => _x('Add New', 'Stuff'),
        'add_new_item' => __('Add New Stuff'),
        'edit_item' => __('Edit Stuff'),
        'new_item' => __('New Stuff'),
        'all_items' => __('All Stuff'),
        'view_item' => __('View Stuff'),
        'search_items' => __('Search Stuff'),
        'not_found' => __('No Stuff found'),
        'not_found_in_trash' => __('No Stuff found in the trash'),
        'parent_item_colon' => '',
        'menu_name' => 'Stuff'
    );
    $args = array(
        'labels' => $labels,
        'menu_icon' => 'dashicons-products',
        'description' => 'Stuff offered',
        'public' => true,
        'menu_position' => 20,
        'supports' => array('title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'),
        'has_archive' => 'case-study'
    );
    register_post_type('stuff', $args);

    //Post Collections
    $labels = array(
        'name'              => _x( 'Post Collection', 'taxonomy general name' ),
        'singular_name'     => _x( 'Post Collection', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Post Collections' ),
        'all_items'         => __( 'All Post Collections' ),
        'edit_item'         => __( 'Edit Post Collection' ),
        'update_item'       => __( 'Update Post Collection' ),
        'add_new_item'      => __( 'Add New Post Collection' ),
        'new_item_name'     => __( 'New Tile Post Collection' ),
        'menu_name'         => __( 'Post Collections' ),
    );

    $args = array(
        'hierarchical'      => false,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_rest'      => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'collection' ),
    );

    register_taxonomy( 'post_collection', array( 'post' ), $args );


}

add_action('init', 'act_cpt');
