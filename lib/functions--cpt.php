<?php
function act_cpt() {

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
        'menu_position' => 20,
        'supports' => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'page-attributes', 'post-formats'),
        'has_archive' => 'service'
    );
    //register_post_type('service', $args);

    // Registering the 'Member Type' Taxonomy
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
    //register_taxonomy('service_group', array('service'), $args);

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
        'menu_position' => 20,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'comments', 'page-attributes'),
        'has_archive' => true,
    );
    //register_post_type('project', $args);

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
        'menu_position' => 20,
        'supports' => array('title', 'thumbnail', 'excerpt'),
        'has_archive' => true,
        'menu_icon' => 'dashicons-groups',
        'show_in_rest' => false // Enables Gutenberg support
    );
    //register_post_type('team_member', $args);

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
        'menu_position' => 20,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
        'has_archive' => true,
        'menu_icon' => 'dashicons-businessman',
        'show_in_rest' => false // Enables Gutenberg support
    );
    //register_post_type('vacancy', $args);

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
        'menu_position' => 20,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
        'has_archive' => true,
        'menu_icon' => 'dashicons-format-quote',
        'show_in_rest' => false // Enables Gutenberg support
    );
    //register_post_type('testimonial', $args);

    // Registering the 'Season' Custom Post Type
    $labels = array(
        'name' => _x('Seasons', 'post type general name'),
        'singular_name' => _x('Season', 'post type singular name'),
        'add_new' => _x('Add New', 'Season'),
        'add_new_item' => __('Add New Season'),
        'edit_item' => __('Edit Season'),
        'new_item' => __('New Season'),
        'all_items' => __('All Seasons'),
        'view_item' => __('View Season'),
        'search_items' => __('Search Seasons'),
        'not_found' => __('No Seasons found'),
        'not_found_in_trash' => __('No Seasons found in the trash'),
        'parent_item_colon' => '',
        'menu_name' => 'Seasons'
    );
    // Args for the Season post type
    $args = array(
        'labels' => $labels,
        'menu_icon' => 'dashicons-calendar-alt',
        'description' => 'Lists seasons offered',
        'public' => true,
        'menu_position' => 20,
        'supports' => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'page-attributes', 'post-formats'),
        'has_archive' => 'season'
    );
    register_post_type('season', $args);


}

add_action('init', 'act_cpt');
