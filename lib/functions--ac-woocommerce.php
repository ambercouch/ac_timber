<?php
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

add_filter('woocommerce_thankyou_order_received_text', 'woo_change_order_received_text', 10, 2 );
function woo_change_order_received_text( $str, $order ) {
    $output = '';
    $output .= '<b>'.esc_html( 'Thank you for shopping with No Waste Living.', 'act' ).'</b><br>';
    $output .= 'We have sent you and email to confirm your order details.<br>';
    $output .= 'For information on shipping and collections please see our <a href="/shipping" title="Shipping and Collections">shipping page</a>.<br>';
    $output .= 'Once your order is complete and your goods have been dispatch or are ready for collection we will email you with any further information.<br>';
    return $output;
}


add_shortcode( 'act_woo_result_count', 'act_woocommerce_result_count' );
function act_woocommerce_result_count(){
    ob_start();
    woocommerce_result_count();
    $output = ob_get_contents();
    ob_end_clean();
    return $output;
}


add_shortcode( 'act_woo_ordering', 'act_woocommerce_catalog_ordering' );
function act_woocommerce_catalog_ordering(){
    ob_start();
    woocommerce_catalog_ordering();
    $output = ob_get_contents();
    ob_end_clean();
    return $output;
}


add_filter( 'woocommerce_shipping_estimate_html', 'ac_shipping_text' );
function ac_shipping_text( $output ){
    // filter...
    $output = "Postal delivery is not possible for SESI or Miniml refill products. We are providing free doorstep delivery for some postcodes in the Talbot Green area. Select <strong>Doorstep Delivery</strong> at checkout once you have entered your address." ;
    return $output;
}


add_filter( 'woocommerce_package_rates', 'act_conditional_shipping', 10, 2 );
function act_conditional_shipping( $rates, $package ) {

    $special_product_present = false;

    foreach ( $package['contents'] as $line_item ) {

        $shipping_class = $line_item['data']->get_shipping_class();

        if ( $shipping_class == 'not-shipped' ) {
            $special_product_present = true;
        }
    }

    $rates = array_filter( $rates, function ( $r ) use ( $special_product_present ) {

        // AC - only allow shipping methods that start with "doorstep" or "local"
        if ( $special_product_present ) {
            return preg_match( '/local|doorstep|click/', strtolower( $r->label ) );
        } else {
            return true;
        }

    } );

    return $rates;
}


add_filter( 'woocommerce_sale_flash', 'add_percentage_to_sale_badge', 20, 3 );
function add_percentage_to_sale_badge( $html, $post, $product ) {
    if( $product->is_type('variable')){
        $percentages = array();

        // Get all variation prices
        $prices = $product->get_variation_prices();

        // Loop through variation prices
        foreach( $prices['price'] as $key => $price ){
            // Only on sale variations
            if( $prices['regular_price'][$key] !== $price ){
                // Calculate and set in the array the percentage for each variation on sale
                $percentages[] = round(100 - ($prices['sale_price'][$key] / $prices['regular_price'][$key] * 100));
            }
        }
        $percentage = max($percentages) . '%';
    } else {
        $regular_price = (float) $product->get_regular_price();
        $sale_price    = (float) $product->get_sale_price();

        $percentage    = round(100 - ($sale_price / $regular_price * 100)) . '%';
    }
    return '<span class="onsale"><span class="onsale-text"><span class="onsale-text-sale">' . esc_html__( 'SALE', 'woocommerce' ) . '</span><br> ' . $percentage . ' Off</span></span>';
}

add_filter( 'wcs_view_subscription_actions', 'act_subscriptions_button', 100, 2 );
function act_subscriptions_button( $actions, $subscription ) {

    foreach ( $actions as $action_key => $action ) {

        switch ( $action_key ) {
//          case 'change_payment_method':	// Hide "Change Payment Method" button?
            case 'suspend':	// Hide "Change Payment Method" button?
                $actions[$action_key]['name'] = "Pause subscription";
                break;
//			case 'change_address':		// Hide "Change Address" button?
//			case 'switch':			// Hide "Switch Subscription" button?
//			case 'resubscribe':		// Hide "Resubscribe" button from an expired or cancelled subscription?
//			case 'pay':			// Hide "Pay" button on subscriptions that are "on-hold" as they require payment?
//			case 'reactivate':		// Hide "Reactive" button on subscriptions that are "on-hold"?
            case 'cancel':			// Hide "Cancel" button on subscriptions that are "active" or "on-hold"?
                $actions[$action_key]['name'] = "Cancel subscription";
                break;
            default:
                error_log( '-- $action = ' . print_r( $action, true ) );
                break;
        }
    }

    return $actions;
}


add_filter( 'woocommerce_subscription_period_interval_strings', 'eg_extend_subscription_period_intervals' );
function eg_extend_subscription_period_intervals( $intervals ) {

    $intervals[8] = sprintf( __( 'every %s', 'act' ), WC_Subscriptions::append_numeral_suffix( 8 ) );

    return $intervals;
}


add_filter( 'woocommerce_subscription_lengths', 'eg_extend_subscription_expiration_options' );
function eg_extend_subscription_expiration_options( $subscription_lengths ) {

    $subscription_lengths['week'][72] = wcs_get_subscription_period_strings( 72, 'week' );
    $subscription_lengths['week'][96] = wcs_get_subscription_period_strings( 96, 'week' );

    return $subscription_lengths;
}

add_action('wp', 'ac_remove_hidden_products');
function ac_remove_hidden_products(){
    global $post;
    if (is_product()) {

        $product = wc_get_product($post->ID);
        $product_visibility =  $product->get_catalog_visibility();

        if ($product_visibility === 'hidden') {
            global $wp_query;
            $wp_query->set_404();
            status_header(404);
        }

    }
}


add_filter('woocommerce_variable_price_html', 'act_variation_from_price', 10, 2);
add_filter('woocommerce_variable_subscription_price_html', 'act_variation_from_price', 10, 2);

function act_variation_from_price( $price, $product ) {

    $price = '';

    $price .= "<span>From: </span>";
    $price .= wc_price($product->get_price());

    return $price;
}




