<?php
function  act_cpt() {

    /*
     * CPT - Creators
     */

    $labels = array(
        'name' => _x('Creators', 'post type general name'),
        'singular_name' => _x('Creator', 'post type singular name'),
        'add_new' => _x('Add New', 'creator'),
        'add_new_item' => __('Add New Creator'),
        'edit_item' => __('Edit Creator'),
        'new_item' => __('New Creator'),
        'all_items' => __('All Creators'),
        'view_item' => __('View Creator'),
        'search_items' => __('Search Creators'),
        'not_found' => __('No creators found'),
        'not_found_in_trash' => __('No creators found in the Trash'),
        'parent_item_colon' => '',
        'menu_name' => 'Creators'
    );
    $args = array(
        'labels' => $labels,
        'description' => 'Cov19chronicles art work creators',
        'public' => true,
        'menu_position' => 7,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'comments','page-attributes' ),
        'has_archive' => true,
    );
    register_post_type('creator', $args);


    /*
     * CPT - Gallery Items
     */

    $labels = array(
        'name' => _x('Gallery Items', 'post type general name'),
        'singular_name' => _x('Gallery Item', 'post type singular name'),
        'add_new' => _x('Add New', 'gallery item'),
        'add_new_item' => __('Add New Gallery Item'),
        'edit_item' => __('Edit Gallery Item'),
        'new_item' => __('New Gallery Item'),
        'all_items' => __('All Gallery Items'),
        'view_item' => __('View Gallery Item'),
        'search_items' => __('Search Gallery Items'),
        'not_found' => __('No gallery items found'),
        'not_found_in_trash' => __('No gallery items found in the Trash'),
        'parent_item_colon' => '',
        'menu_name' => 'Gallery'
    );
    $args = array(
        'labels' => $labels,
        'description' => 'Cov19chronicles art work',
        'public' => true,
        'menu_position' => 5,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'comments','page-attributes' ),
        'has_archive' => true,
    );
    register_post_type('gallery-item', $args);

    /*
     * CPT TAX - Gallery Item - Item Type
     */

    $labels = array(
        'name'              => _x( 'Item Type', 'taxonomy general name' ),
        'singular_name'     => _x( 'Item Type', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Item Types' ),
        'all_items'         => __( 'All Item Types' ),
        'edit_item'         => __( 'Edit Item Type' ),
        'update_item'       => __( 'Update Item Type' ),
        'add_new_item'      => __( 'Add New Item Type' ),
        'new_item_name'     => __( 'New Item Type' ),
        'menu_name'         => __( 'Gallery Item Types' ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'gallery-type' ),
    );

    register_taxonomy( 'gallery-type', array( 'gallery-item' ), $args );

    /*
    * CPT TAX - Gallery Item - Item Tags
    */

    $labels = array(
        'name'              => _x( 'Item Tags', 'taxonomy general name' ),
        'singular_name'     => _x( 'Item Tag', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Item Tags' ),
        'all_items'         => __( 'All Item Tags' ),
        'edit_item'         => __( 'Edit Item Tag' ),
        'update_item'       => __( 'Update Item Tag' ),
        'add_new_item'      => __( 'Add New Item Tag' ),
        'new_item_name'     => __( 'New Item Tag' ),
        'menu_name'         => __( 'Gallery Item Tags' ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'gallery-tag' ),
    );

    register_taxonomy( 'gallery-tag', array( 'gallery-item' ), $args );

    /*
    * CPT - Gallery Collections
    */

    $labels = array(
        'name' => _x('Gallery Collections', 'post type general name'),
        'singular_name' => _x('Gallery Collections', 'post type singular name'),
        'add_new' => _x('Add New', 'gallery collection'),
        'add_new_item' => __('Add New Gallery collection'),
        'edit_item' => __('Edit Gallery Collection'),
        'new_item' => __('New Gallery Collection'),
        'all_items' => __('All Gallery Collections'),
        'view_item' => __('View Gallery Collection'),
        'search_items' => __('Search Gallery Collections'),
        'not_found' => __('No gallery collections found'),
        'not_found_in_trash' => __('No gallery collects found in the Trash'),
        'parent_item_colon' => '',
        'menu_name' => 'Collections'
    );
    $args = array(
        'labels' => $labels,
        'description' => 'Cov19chronicles collections of art work',
        'public' => true,
        'menu_position' => 5,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'comments','page-attributes' ),
        'has_archive' => true,
    );
    register_post_type('gallery-collection', $args);

    /*
    * CPT TAX - Gallery Colletion - Collection Tags
    */

    $labels = array(
        'name'              => _x( 'Collection Tags', 'taxonomy general name' ),
        'singular_name'     => _x( 'Collection Tag', 'taxonomy singular name' ),
        'search_Collections'      => __( 'Search Collection Tags' ),
        'all_Collections'         => __( 'All Collection Tags' ),
        'edit_Collection'         => __( 'Edit Collection Tag' ),
        'update_Collection'       => __( 'Update Collection Tag' ),
        'add_new_Collection'      => __( 'Add New Collection Tag' ),
        'new_Collection_name'     => __( 'New Collection Tag' ),
        'menu_name'         => __( 'Gallery Collection Tags' ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'collection-tag' ),
    );

    register_taxonomy( 'collection-tag', array( 'gallery-collection' ), $args );


}

add_action('init', 'act_cpt');
