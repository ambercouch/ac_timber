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
require_once get_template_directory() . '/lib/acf/functions--acf-page-banner-content.php';
require_once get_template_directory() . '/lib/acf/functions--acf-page-banner-image.php';
require_once get_template_directory() . '/lib/acf/functions--acf-page-content.php';

require_once get_template_directory() . '/lib/acf/functions--acf-service-settings.php';
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

add_action( 'after_setup_theme', 'yourtheme_setup' );

function yourtheme_setup() {

    add_theme_support( 'wc-product-gallery-zoom' );
//
    add_theme_support( 'wc-product-gallery-lightbox' );
//
    add_theme_support( 'wc-product-gallery-slider' );

}

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


add_filter('woocommerce_thankyou_order_received_text', 'woo_change_order_received_text', 10, 2 );
function woo_change_order_received_text( $str, $order ) {
    $output = '';
        $output .= '<b>'.esc_html( 'Thank you for shopping with No Waste Living.', 'act' ).'</b><br>';
        $output .= 'We have sent you and email to confirm your order details.<br>';
        $output .= 'For information on shipping and collections please see our <a href="/shipping" title="Shipping and Collections">shipping page</a>.<br>';
        $output .= 'Once your order is complete and your goods have been dispatch or are ready for collection we will email you with any further information.<br>';
    return $output;
}


function act_woocommerce_result_count(){
    ob_start();
    woocommerce_result_count();
    $output = ob_get_contents();
    ob_end_clean();
    return $output;
}
add_shortcode( 'act_woo_result_count', 'act_woocommerce_result_count' );

function act_woocommerce_catalog_ordering(){
    ob_start();
    woocommerce_catalog_ordering();
    $output = ob_get_contents();
    ob_end_clean();

    return $output;
}
add_shortcode( 'act_woo_ordering', 'act_woocommerce_catalog_ordering' );

add_filter( 'woocommerce_shipping_estimate_html', 'ac_shipping_text' );
function ac_shipping_text( $output ){
    // filter...
    $output = "Postal delivery is not possible for SESI refill products. We are providing free doorstep delivery for some postcodes in the Talbot Green area. Select <strong>Doorstep Delivery</strong> at checkout once you have entered your address." ;
    return $output;
}
