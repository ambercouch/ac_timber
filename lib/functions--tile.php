<?php
function set_tile_width($post_id){
    remove_action('save_post', 'set_tile_width');

    $width = get_field('width', $post_id);
    $height = get_field('height', $post_id);
    $tile_size = $width.'cm x '.$height.'cm';
    wp_set_post_terms( $post_id, $tile_size, 'tile_size', false );

    add_action('save_post', 'set_tile_width');
}

add_action('save_post', 'set_tile_width');