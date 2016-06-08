<?php
function set_work_type($post_id){
    remove_action('save_post', 'set_work_type');

    $type = get_field('work_type', $post_id);
    wp_set_post_terms( $post_id, ucfirst($type), 'work_type', false );

    add_action('save_post', 'set_work_type');
}

add_action('save_post', 'set_work_type');