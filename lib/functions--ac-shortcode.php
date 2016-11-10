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

function act_quote_banner( $atts ) {

    extract(shortcode_atts(array(
        'cite' => 'Anon',
        'text' => '',
        'img' => false
    ), $atts));

    $has_image_class = '';

if ($img !== false){
    $attachment = get_page_by_title($img, OBJECT, 'attachment')  ;
    $thumbnail =  wp_get_attachment_image($attachment->ID );
    $has_image = ($thumbnail != false) ? true : false;
    $has_image_class = ($thumbnail != false) ? 'has-image' : '';
}


    $output = '';
    $output .= '<div class="quote '.$has_image_class.'">';
    if($has_image != false)
    {
        $output .= '<div class="quote__image">';
        $output .= $thumbnail;
        $output .= '</div><!-- .quote__image -->';
    }
    $output .= '<div class="quote__content">';
    $output .= '<blockquote class="quote__block">';
    $output .= '<q class="quote__text">'.$text.'</q>';
    $output .= '<div class="quote__footer">';
    $output .= '<cite class="quote__cite">'.$cite.'</cite>';
    $output .= '</div><!-- .quote__footer -->';
    $output .= '</blockquote><!-- .quote -->';
    $output .= '</div><!-- .quote__content -->';
    $output .= '</div><!-- .quote -->';

//    $logo = get_field('company_logo', 'option');
//    if ($logo == ''){
//        return;
//    }
//
//    $output = '<img class="'.$class.'" src="'.$logo['url'].'" alt="'.$logo['alt'].'" />';

    return  $output  ;
}
add_shortcode('act_quote_banner', 'act_quote_banner');