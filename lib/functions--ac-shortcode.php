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

function act_theme_settings( $atts ) {
    extract(shortcode_atts(array(
        'key' => '',
    ), $atts));
    return get_field($key, 'options');
}

add_shortcode('act_theme_settings', 'act_theme_settings');

function act_contact( $atts ) {
    extract(shortcode_atts(array(
        'row' => '',
    ), $atts));
    //return 'contact' . $row;
    $contact_items = get_field('contact', 'options');
    $contact_item = $contact_items[$row - 1];
    $contact_type = $contact_item['contact_type'];
    $contact_label = $contact_item['contact_label'];
    $contact_value_key = 'contact_'.$contact_type;
    $contact_value = $contact_item[$contact_value_key];

    switch ($contact_type){
        case 'email':
            $contact_link = '<a href="mailto:'.$contact_value.'">'.$contact_value.'</a>';
            break;
        case 'telephone':
            $contact_link = '<a href="tel:'.$contact_value.'">'.$contact_value.'</a>';
            break;
        case 'website':
            $contact_link = '<a href="'.$contact_value.'">'.$contact_value.'</a>';
            break;
        case 'other':
            $contact_link = $contact_value;
            break;
        default :
            $contact_link = $contact_value;
    }
    $output = '';
    $output .= $contact_label;
    $output .= ' : ';
    $output .= $contact_link;

    return $output;
}

add_shortcode('act_contact', 'act_contact');