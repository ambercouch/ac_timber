<?php
/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */


//[actcard]
function actCall($atts, $content)
{
//    var_dump($atts);
//    die;
    $a = shortcode_atts(array(
        'title' => 'Add a Title',
        'text' => 'Add Some text',
        'btn' => 'Submit',
        'url' => '/'
    ), $atts);

    $a['text'] = '<p>'.$a['text'].'</p>';

    $output = '<div class="island">';
    $output .= '<div class="cta--ad">';
    $output .= '<h3 class="cta--ad__title">'.$a['title'].'</h3>';
    $output .= '<div class="cta--ad__content">'.$a['text'].'</div>';
    $output .= '<div class="cta--ad__link">';
    $output .= '<a class="cta--ad__btn" href="'.$a['url'].'">'.$a['btn'].'</a>';
    $output .= '</div>';
    $output .= '</div>';
    $output .= '</div>';

    return $output;
}

add_shortcode('actcall', 'actCall');