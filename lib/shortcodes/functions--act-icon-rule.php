<?php
/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */


//[actcard]
function actIconRule($atts)
{

    $a = shortcode_atts(array(

    ), $atts);


    $output = '<div class="icon__rule">';
    $output .= '<svg class="icon--flourish-leaf ">';
    $output .= '<use xlink:href="#icon-flourish-leaf" />';
    $output .= '</svg>';
    $output .= '</div>';

    return $output;
}

add_shortcode('actirule', 'actIconRule');