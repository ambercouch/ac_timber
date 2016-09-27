<?php


function act_date( $atts ){

    $a = (isset($atts[0]))? $atts[0] : 'Y';

    return date($a);
}
add_shortcode( 'act_date', 'act_date' );

function act_bloginfo( $atts ) {
    extract(shortcode_atts(array(
        'key' => '',
    ), $atts));
    return get_bloginfo($key);
}
add_shortcode('act_bloginfo', 'act_bloginfo');