<?php

function _act_get_body_data() {
    global $post;
    $body_data =array();
//  echo 'pid';
//
    $post_type = get_post_type(get_the_ID());

    if (is_archive()){
        $post_type = "archive";
    }

    if (is_front_page()) {
        $post_type = 'home';
    }

    $body_data['post-type'] = $post_type;

    $post_slug = $post->post_name;

    if (is_archive() and isset(get_queried_object()->taxonomy)){
        $tax = get_taxonomy( get_queried_object()->taxonomy );
        $post_slug = sanitize_title( $tax->labels->singular_name);
    }elseif(is_archive() and !isset(get_queried_object()->taxonomy)){
        $post_slug = get_queried_object()->name;
    }

    if (is_home()) {
        $post_slug = 'blog';
    }

    if (is_home() && is_paged()) {
        $post_slug = 'blog_paged';
    }
    $body_data['post-slug'] = $post_slug;

    return $body_data;
}

function _act_body_data() {
    $body_data = _act_get_body_data();

    $output = '';
    foreach ($body_data as $key => $data) {
        $output .= 'data-' . $key . '=';
        $output .= str_replace('-', '_', $data);
        $output .= ' ';
    }
    echo $output;
}
