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
//require_once get_template_directory() . '/lib/acf/functions--acf-project-settings.php';
require_once get_template_directory() . '/lib/acf/functions--acf-post-title-settings.php';
require_once get_template_directory() . '/lib/acf/functions--acf-page-content.php';
require_once get_template_directory() . '/lib/acf/functions--acf-menu-items.php';
require_once get_template_directory() . '/lib/acf/functions--acf-page-banner-image.php';
require_once get_template_directory() . '/lib/acf/functions--acf-testimonial-info.php';


require_once get_template_directory() . '/lib/functions--template-tags.php';
require_once get_template_directory() . '/lib/functions--ac-menu-filters.php';
require_once get_template_directory() . '/lib/functions--cpt.php';

require_once get_template_directory() . '/lib/admin/functions--admin-clean.php';
require_once get_template_directory() . '/lib/admin/functions--admin-widgets.php';
require_once get_template_directory() . '/lib/functions--walkers.php';


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

function my_admin_theme_style() {
    wp_enqueue_style('ac-admin-theme', get_stylesheet_directory_uri().'/assets/css/ac-admin.css', array(), filemtime(get_template_directory() . '/assets/css/ac-admin.css'));
}
add_action('admin_enqueue_scripts', 'my_admin_theme_style');
add_action('login_enqueue_scripts', 'my_admin_theme_style');


function act_disable_editor( $id = false ) {

    $excluded_templates = array(
        //'page-templates/mxb-home.php',
    );

    $excluded_ids = array(
        //get_option( 'page_on_front' )
    );

    if( empty( $id ) )
        return false;

    $id = intval( $id );
    $template = get_page_template_slug( $id );

    return in_array( $id, $excluded_ids ) || in_array( $template, $excluded_templates );
}

/**
 * Disable Gutenberg by template
 *
 */
function act_disable_gutenberg( $can_edit, $post_type ) {

    if( ! ( is_admin() && !empty( $_GET['post'] ) ) )
        return $can_edit;

    if( act_disable_editor( $_GET['post'] ) )
        $can_edit = false;

    return $can_edit;

}
add_filter( 'gutenberg_can_edit_post_type', 'act_disable_gutenberg', 10, 2 );
add_filter( 'use_block_editor_for_post_type', 'act_disable_gutenberg', 10, 2 );

/**
 * Disable Classic Editor by template
 *
 */
function act_disable_classic_editor() {

    $screen = get_current_screen();
    if( 'page' !== $screen->id || ! isset( $_GET['post']) )
        return;

    if( act_disable_editor( $_GET['post'] ) ) {
        remove_post_type_support( 'page', 'editor' );
    }

}
add_action( 'admin_head', 'act_disable_classic_editor' );

add_filter('wpcf7_autop_or_not', '__return_false');

/*
 * Filter the variable product price to show the from price
 */

add_filter('woocommerce_variable_price_html', 'act_variation_from_price', 10, 2);

function act_variation_from_price( $price, $product ) {

    $price = '';

    $price .= "<span>From </span>";
    $price .= wc_price($product->get_price());

    return $price;
}


/*
 * Remove the single excerpt (product content)
 */
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
remove_action( 'woocommerce_single_variation', 'woocommerce_single_variation_add_to_cart_button', 20);
//remove_action( 'woocommerce_single_variation', 'woocommerce_single_variation', 10);
add_action( 'woocommerce_single_variation', 'woocommerce_single_variation_add_to_cart_button', 0);
//remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
remove_action( 'woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20 );

function my_text_change() {
    return __( 'Buy Now', 'woocommerce' );
}
add_filter( 'woocommerce_product_add_to_cart_text', 'my_text_change' );

add_filter('woocommerce_checkout_fields', 'act_checkout_fields');
function act_checkout_fields($fields)
{
    //unset($fields['billing']['billing_address_2']);
    $fields['billing']['billing_company']['placeholder'] = 'Company Name';
    $fields['billing']['billing_company']['label'] = 'Business Name';
    $fields['billing']['billing_company']['label_class'] = 'u-d-n';
    $fields['billing']['billing_first_name']['placeholder'] = 'First Name';
    $fields['billing']['billing_first_name']['label_class'] = 'u-d-n';
    $fields['billing']['billing_last_name']['placeholder'] = 'Last Name';
    $fields['billing']['billing_last_name']['label_class'] = 'u-d-n';
    $fields['billing']['billing_email']['placeholder'] = 'Email Address ';
    $fields['billing']['billing_email']['label_class'] = 'u-d-n';
    $fields['billing']['billing_phone']['placeholder'] = 'Phone ';
    $fields['billing']['billing_phone']['label_class'] = 'u-d-n';
    $fields['billing']['billing_city']['placeholder'] = 'City ';
    $fields['billing']['billing_city']['label_class'] = 'u-d-n';
    $fields['billing']['billing_state']['placeholder'] = 'County ';
    $fields['billing']['billing_state']['label_class'] = 'u-d-n';
    $fields['billing']['billing_postcode']['placeholder'] = 'Postcode ';
    $fields['billing']['billing_postcode']['label_class'] = 'u-d-n';

    $fields['shipping']['shipping_company']['placeholder'] = 'Company Name';
    $fields['shipping']['shipping_company']['label'] = 'Business Name';
    $fields['shipping']['shipping_company']['label_class'] = 'u-d-n';
    $fields['shipping']['shipping_first_name']['placeholder'] = 'First Name';
    $fields['shipping']['shipping_first_name']['label_class'] = 'u-d-n';
    $fields['shipping']['shipping_last_name']['placeholder'] = 'Last Name';
    $fields['shipping']['shipping_last_name']['label_class'] = 'u-d-n';
    $fields['shipping']['shipping_email']['placeholder'] = 'Email Address ';
    $fields['shipping']['shipping_email']['label_class'] = 'u-d-n';
    $fields['shipping']['shipping_phone']['placeholder'] = 'Phone ';
    $fields['shipping']['shipping_phone']['label_class'] = 'u-d-n';
    $fields['shipping']['shipping_city']['placeholder'] = 'City ';
    $fields['shipping']['shipping_city']['label_class'] = 'u-d-n';
    $fields['shipping']['shipping_state']['placeholder'] = 'County ';
    $fields['shipping']['shipping_state']['label_class'] = 'u-d-n';
    $fields['shipping']['shipping_postcode']['placeholder'] = 'Postcode ';
    $fields['shipping']['shipping_postcode']['label_class'] = 'u-d-n';
    return $fields;
}
