<?php


function act_date( $atts ){

    $a = (isset($atts[0]))? $atts[0] : 'Y';
    
    return date($a);
}
add_shortcode( 'act_date', 'act_date' );