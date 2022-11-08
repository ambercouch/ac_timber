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
        'menu_icon' => 'dashicons-store',
        'description' => 'Services offered',
        'public' => true,
        'menu_position' => 20,
        'show_in_rest' => true,
        'hierarchical' => true,
        'has_archive' => false,
        //'rewrite'   => array( 'slug' => '/', 'with_front' => true ),
        'supports' => array('title','editor','author','thumbnail','excerpt','custom-fields','revisions','page-attributes'),
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

    $labels = array(
        'name' => _x('Testimonials', 'post type general name'),
        'singular_name' => _x('Testimonial', 'post type singular name'),
        'add_new' => _x('Add New', 'Testimonial'),
        'add_new_item' => __('Add New Testimonial'),
        'edit_item' => __('Edit Testimonial'),
        'new_item' => __('New Testimonial'),
        'all_items' => __('All Testimonials'),
        'view_item' => __('View Testimonial'),
        'search_items' => __('Search Testimonials'),
        'not_found' => __('No Testimonials found'),
        'not_found_in_trash' => __('No Testimonials found in the trash'),
        'parent_item_colon' => '',
        'menu_name' => 'Testimonials'
    );
    $args = array(
        'labels' => $labels,
        'menu_icon' => 'dashicons-format-quote',
        'description' => 'Testimonials recieved',
        'public' => true,
        'menu_position' => 20,
        'supports' => array('title','editor','author','excerpt','custom-fields','comments','revisions','page-attributes'),
        'has_archive' => 'testimonial'
    );
    //register_post_type('testimonial', $args);

    //Testimonial tag
    $labels = array(
        'name'              => _x( 'Testimonail Tags', 'taxonomy general name' ),
        'singular_name'     => _x( 'Testimonial Tag', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Testimonail Tags' ),
        'all_items'         => __( 'All Testimonail Tags' ),
        'edit_item'         => __( 'Edit Testimonail Tag' ),
        'update_item'       => __( 'Update Testimonail Tag' ),
        'add_new_item'      => __( 'Add New Testimonail Tag' ),
        'new_item_name'     => __( 'New Tile Testimonail Tag' ),
        'menu_name'         => __( 'Testimonail Tags' ),
    );

    $args = array(
        'hierarchical'      => false,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'testmonial-tag' ),
    );

    //register_taxonomy( 'testimonial_tag', array( 'testimonial' ), $args );

}

add_action('init', 'act_cpt');

/**
 * Remove the slug from published post permalinks. Only affect our custom post type, though.
 */
function ac_remove_cpt_slug( $post_link, $post ) {

    if ( 'service' === $post->post_type && 'publish' === $post->post_status ) {
        $post_link = str_replace( '/' . $post->post_type . '/', '/', $post_link );
    }

    return $post_link;
}
add_filter( 'post_type_link', 'ac_remove_cpt_slug', 10, 2 );

/**
 * Have WordPress match postname to any of our public post types (post, page, race).
 * All of our public post types can have /post-name/ as the slug, so they need to be unique across all posts.
 * By default, WordPress only accounts for posts and pages where the slug is /post-name/.
 *
 * @param $query The current query.
 */
function ac_add_cpt_post_names_to_main_query( $query ) {

    if ( $query->is_main_query() ) {

        //return;
    }

    // Bail if this is not the main query.
    if ( ! $query->is_main_query() ) {
        return;
    }

    // Bail if this query doesn't match our very specific rewrite rule.
    if ( (! isset( $query->query['page'] ) ||
            2 !== count( $query->query ) ) &&
        (! isset( $query->query['attachment'] )
        ) ) {

        return;
    }

    // Bail if we're not querying based on the post name.
    if ( empty( $query->query['name'] )  &&  ! isset( $query->query['attachment'] ) ) {
        return;
    }

    // Add CPT to the list of post types WP will include when it queries based on the post name.
    $query->set( 'post_type', array( 'post', 'page', 'service' ) );
}
add_action( 'pre_get_posts', 'ac_add_cpt_post_names_to_main_query' );
