<?php

//Love, love, love, love all you functions
require_once get_template_directory() . '/lib/functions--ac-sidebars.php';
require_once get_template_directory() . '/lib/functions--ac-menus.php';
require_once get_template_directory() . '/lib/functions--ac-settings.php';

require_once get_template_directory() . '/lib/functions--timber.php';
require_once get_template_directory() . '/lib/functions--theme-setup.php';

require_once get_template_directory() . '/lib/functions--ac-shortcode.php';
require_once get_template_directory() . '/lib/functions--widget-areas.php';
require_once get_template_directory() . '/lib/functions--widgets.php';


require_once get_template_directory() . '/lib/functions--acf.php';
require_once get_template_directory() . '/lib/acf/functions--acf-options.php';
require_once get_template_directory() . '/lib/acf/functions--acf-video-settings.php';
require_once get_template_directory() . '/lib/acf/functions--acf-page-settings.php';
require_once get_template_directory() . '/lib/acf/functions--acf-service-settings.php';
require_once get_template_directory() . '/lib/acf/functions--acf-page-content.php';
require_once get_template_directory() . '/lib/acf/functions--acf-location-details.php';

require_once get_template_directory() . '/lib/functions--template-tags.php';
require_once get_template_directory() . '/lib/functions--ac-menu-filters.php';
require_once get_template_directory() . '/lib/functions--cpt.php';

require_once get_template_directory() . '/lib/admin/functions--admin-clean.php';
require_once get_template_directory() . '/lib/admin/functions--admin-widgets.php';
require_once get_template_directory() . '/lib/functions--walkers.php';

function theme_add_woocommerce_support() {
    add_theme_support( 'woocommerce' );
}

add_action( 'after_setup_theme', 'theme_add_woocommerce_support' );

function timber_set_product( $post )
{
    global $product;

    if (is_woocommerce())
    {
        $product = wc_get_product($post->ID);
    }
}

//remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail' );

//function comment_layout($comment, $args, $depth) {
//    $GLOBALS['comment'] = $comment;
//return 'commenters';
//}

//function add_style_select_buttons( $buttons ) {
//    array_unshift( $buttons, 'styleselect' );
//    return $buttons;
//}
//// Register our callback to the appropriate filter
//add_filter( 'mce_buttons_2', 'add_style_select_buttons' );
//
////add custom styles to the WordPress editor
//function my_custom_styles( $init_array ) {
//
//    $style_formats = array(
//        // These are the custom styles
//        array(
//            'title' => 'Width 100',
//            'block' => 'img',
//            'classes' => 'element-width--100',
//            'wrapper' => false,
//        ),
//        array(
//            'title' => 'Width 200',
//            'block' => 'img',
//            'classes' => 'element-width--200',
//            'wrapper' => false,
//        ),
//        array(
//            'title' => 'Width 300',
//            'block' => 'img',
//            'classes' => 'element-width--300',
//            'wrapper' => false,
//        ),
//        array(
//            'title' => 'Width 400',
//            'block' => 'img',
//            'classes' => 'element-width--400',
//            'wrapper' => false,
//        ),
//        array(
//            'title' => 'Width 500',
//            'block' => 'img',
//            'classes' => 'element-width--500',
//            'wrapper' => false,
//        ),
//
//    );
//    // Insert the array, JSON ENCODED, into 'style_formats'
//    $init_array['style_formats'] = json_encode( $style_formats );
//
//    return $init_array;
//
//}
//// Attach callback to 'tiny_mce_before_init'
//add_filter( 'tiny_mce_before_init', 'my_custom_styles' );