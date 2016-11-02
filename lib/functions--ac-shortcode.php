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

function act_option_logo( $atts ) {

    extract(shortcode_atts(array(
        'class' => 'company-logo',
    ), $atts));

    $logo = get_field('company_logo', 'option');
    if ($logo == ''){
        return;
    }

    $output = '<img class="'.$class.'" src="'.$logo['url'].'" alt="'.$logo['alt'].'" />';
    return $output  ;
}
add_shortcode('act_option_logo', 'act_option_logo');