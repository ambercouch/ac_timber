<?php
/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */


//[actcard]
function actCard($atts, $content)
{

    $a = shortcode_atts( array(
        'type' => 'default',
        'title' => 'Add a title',
        'image' => ''
    ), $atts );


    $output = '<div class="card--'.$a['type'].'" >';
    $output .= '<div class="card--'.$a['type'].'__front">';
    $output .= '<div class="card--'.$a['type'].'__title">';
    $output .= $a['title'];
    $output .= '</div>';
    $output .= '<div class="card--'.$a['type'].'__image" >';
    $output .= '<img class="card--'.$a['type'].'__img" src="'.$a['image'].'" alt="'.$a['title'].'">';
    $output .= '</div>';
    $output .= '</div>';
    $output .= '<div class="card--'.$a['type'].'__back">';
    $output .= '<div class="card--'.$a['type'].'__content" >'.$content.'</div>';
    $output .= '</div>';
    $output .= '</div>';

    return $output;
}

add_shortcode('actcard', 'actCard');