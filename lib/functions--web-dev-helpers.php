<?php

function act_change_post_type() {

    $from_post_type = 'avada_faq';
    $to_post_type = 'act_faq';
    // Get all posts with post type 'avada_faq'
    $args = array(
        'post_type' => $from_post_type,
        'posts_per_page' => -1, // Retrieve all posts
        'post_status' => 'any', // Include all statuses (published, draft, etc.)
    );

    $act_posts = get_posts($args);

    // Loop through each post and update the post type to 'act_faq'
    foreach ($act_posts as $post) {
        // Set the post type to 'act_faq' and update the post
        wp_update_post(array(
            'ID' => $post->ID,
            'post_type' => $to_post_type
        ));
    }
}

// Hook to run the function only once (optional)
//add_action('init', 'act_change_post_type');

function act_cat_term_to_custom_post_type() {
    $from_tax_term = 'case-studies';
    $to_cpt = 'act_case_study';
    // Get all posts in the 'case-studies' category
    $args = array(
        'category_name' => 'case-studies', // Category slug
        'post_type' => 'post', // Original post type
        'posts_per_page' => -1, // Retrieve all posts
        'post_status' => 'any', // Include all statuses (published, draft, etc.)
    );

    $case_study_posts = get_posts($args);

    // Loop through each post and update the post type to 'act_case_study'
    foreach ($case_study_posts as $post) {
        wp_update_post(array(
            'ID' => $post->ID,
            'post_type' => 'act_case_study'
        ));
    }
}

// Hook to run the function once
//add_action('init', 'act_cat_term_to_custom_post_type');

