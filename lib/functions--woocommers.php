<?php


/**
 * Change text strings
 *
 * @link http://codex.wordpress.org/Plugin_API/Filter_Reference/gettext
 */
function my_text_strings( $translated_text, $text, $domain ) {
    switch ( $translated_text ) {
        case 'Coupon' :
            $translated_text = __( 'Discount Code', 'woocommerce' );
            break;
        case 'Apply Coupon' :
            $translated_text = __( 'Apply Code', 'woocommerce' );
            break;
        case 'First renewal:' :
            $translated_text = __('Some Text', 'woocommerce');
    }
    return $translated_text;
}
add_filter( 'gettext', 'my_text_strings', 20, 3 );



/**
 * Change the placeholder image
 */
add_filter('woocommerce_placeholder_img_src', 'custom_woocommerce_placeholder_img_src');

function custom_woocommerce_placeholder_img_src( $src ) {
    $upload_dir = wp_upload_dir();
    $uploads = untrailingslashit( $upload_dir['baseurl'] );
    // replace with path to your image
    $src = $uploads . '/2019/01/family-car.jpg';

    return $src;
}

add_filter('single_add_to_cart_text', 'woo_custom_cart_button_text');

function woo_custom_cart_button_text() {
    return __('Add Item', 'woocommerce');
}


function wc_subscriptions_custom_price_string( $pricestring ) {
    global $product;

    if($product)
    {
        $setup_fee = WC_Subscriptions_Product::get_sign_up_fee($product);
        $monthly_fee = WC_Subscriptions_Product::get_price($product);
        $length = WC_Subscriptions_Product::get_length($product);
        $length_edit = $length - 1;
        $period = WC_Subscriptions_Product::get_period($product) . 'ly';
        $total_subscription = $setup_fee + ($monthly_fee * $length);
        $month_one_price = $setup_fee + $monthly_fee;

        $pricestring = '';
        $pricestring .= 'Pay ';
        $pricestring .= wc_price($month_one_price);
        $pricestring .= ' today. </br>';
        $pricestring .= '<small>Followed by</small><br><strong><small>' . $length_edit . '</small></strong> ' . $period . ' payments of ';
        $pricestring .= wc_price($monthly_fee);
        $pricestring .= '<br>';
        //$pricestring .= '<small>The total subscription price will be </small>' . wc_price( $total_subscription);
    }
    return $pricestring;
}

add_filter( 'woocommerce_subscriptions_product_price_string', 'wc_subscriptions_custom_price_string' );

function filter_woocommerce_cart_item_price( $wc, $cart_item, $cart_item_key ) {
    // make filter magic happen here...
    $product_id = $cart_item['product_id'];
    $product = wc_get_product( $product_id );

    $setup_fee = WC_Subscriptions_Product::get_sign_up_fee($product);
    $monthly_fee = WC_Subscriptions_Product::get_price($product);
    $length = WC_Subscriptions_Product::get_length($product);
    $length_edit = $length - 1;
    $period = WC_Subscriptions_Product::get_period($product);
    $total_subscription = $setup_fee + ($monthly_fee * $length);
    $month_one_price = $setup_fee + $monthly_fee;

    $pricestring = '';
    $pricestring .= '';
    $pricestring .= wc_price($month_one_price) . '<br>' ;
    $pricestring .= '<small>Followed by</small><br><strong><small>';
    $pricestring .= wc_price($monthly_fee) . ' per ' . $period;
    //$pricestring .= '<small>The total subscription price will be </small>' . wc_price( $total_subscription);

    return $pricestring;
};

// add the filter
add_filter( 'woocommerce_cart_item_price', 'filter_woocommerce_cart_item_price', 10, 3 );

function filter_woocommerce_cart_item_subtotal( $wc, $cart_item, $cart_item_key ) {

    // make filter magic happen here...
    $product_id = $cart_item['product_id'];
    $cart_qty = $cart_item['quantity'];
    $product = wc_get_product( $product_id );

    $setup_fee = WC_Subscriptions_Product::get_sign_up_fee($product) * $cart_qty;
    $monthly_fee = WC_Subscriptions_Product::get_price($product) * $cart_qty;
    $length = WC_Subscriptions_Product::get_length($product) * $cart_qty;
    $length_edit = $length - 1;
    $period = WC_Subscriptions_Product::get_period($product);
    $total_subscription = $setup_fee + ($monthly_fee * $length) * $cart_qty;
    $month_one_price = $setup_fee + $monthly_fee * $cart_qty;

    $pricestring = '';
    $pricestring .= '';
    $pricestring .= wc_price($month_one_price) . '<br>' ;
    $pricestring .= '<small>Followed by</small><br><strong><small>';
    $pricestring .= wc_price($monthly_fee) . ' per ' . $period;
    //$pricestring .= '<small>The total subscription price will be </small>' . wc_price( $total_subscription);

    return $pricestring;

};

// add the filter
add_filter( 'woocommerce_cart_item_subtotal', 'filter_woocommerce_cart_item_subtotal', 10, 3 );


function filter_woocommerce_cart_subscription_string($subscription_array){
    $subscription_array['subscription_length'] = $subscription_array['subscription_length'] - 1;

    return $subscription_array;
}

add_filter('woocommerce_cart_subscription_string_details', 'filter_woocommerce_cart_subscription_string');


//add_action('init', 'ac_testing');
//function ac_testing(){
//    if(!is_admin()){
//        $product = wc_get_product( 111  );
//        $subscription_price_string = WC_Subscriptions_Product::get_price_string($product, array('subscription_price' => false));
//        $subscription_price = WC_Subscriptions_Product::get_price( $product );
//        $subscription_period =  WC_Subscriptions_Product::get_period( $product );
//        $subscription_ex_date =  WC_Subscriptions_Product::get_expiration_date( $product );
//        $subscription_length = WC_Subscriptions_Product::get_length( $product );
//        echo $subscription_price_string . '<br>' ;
//        echo $subscription_price. '<br>' ;
//        echo $subscription_period. '<br>' ;
//        echo $subscription_ex_date. '<br>' ;
//        echo $subscription_length. '<br>' ;
//        //echo wc_price(wc_get_price_to_display($product));
//        die;
//    }
//
//}

//* Function for Cart
//function wc_subscriptions_custom_price_string_cart( $pricestring ) {
//    global $woocommerce;
//    global $cart_item;
//
//    $cart = $woocommerce->cart;
//
//    ob_start();
//
//    $output = ob_get_clean();
//    // $output = $cart;
//
//    return  $cart_item;
//
//}
//add_filter( 'woocommerce_subscriptions_product_price_string', 'wc_subscriptions_custom_price_string_cart' );
//add_filter( 'woocommerce_subscription_price_string', 'wc_subscriptions_custom_price_string_cart' );

/**
 * Add the field to the checkout
 */
//add_action( 'woocommerce_before_order_notes', 'my_custom_checkout_field' );

//function my_custom_checkout_field( $checkout ) {
//
//    echo '<div id="fieldMileage"><h3>' . __('Vehicle Mileage') . '</h3>';
//
//    woocommerce_form_field( 'field_mileage', array(
//        'type'          => 'textarea',
//        'class'         => array('my-field-class form-row-wide'),
//        'label'         => __('Please provide your current mileage for each vehicle'),
//        'placeholder'   => __('Vehicle mileage, e.g. 50000 miles'),
//        'required'      => true
//    ), $checkout->get_value( 'field_mileage' ));
//
//    echo '</div>';
//
//    echo '<div id="fieldMake"><h3>' . __('Vehicle Make') . '</h3>';
//
//    woocommerce_form_field( 'field_make', array(
//        'type'          => 'textarea',
//        'class'         => array('my-field-class form-row-wide'),
//        'label'         => __('Please provide the make of each vehicle'),
//        'placeholder'   => __('Vehicle make, e.g. Toyota'),
//        'required'      => true
//    ), $checkout->get_value( 'field_make' ));
//
//    echo '</div>';
//
//    echo '<div id="fieldModel"><h3>' . __('Vehicle Model') . '</h3>';
//
//    woocommerce_form_field( 'field_model', array(
//        'type'          => 'textarea',
//        'class'         => array('my-field-class form-row-wide'),
//        'label'         => __('Please provide the model of each vehicle'),
//        'placeholder'   => __('Vehicle make, e.g. Avensis'),
//        'required'      => true
//    ), $checkout->get_value( 'field_model' ));
//
//    echo '</div>';
//
//    echo '<div id="fieldReg"><h3>' . __('Vehicle Reg') . '</h3>';
//
//    woocommerce_form_field( 'field_reg', array(
//        'type'          => 'textarea',
//        'class'         => array('my-field-class form-row-wide'),
//        'label'         => __('Please provide the vehicle reg of each vehicle'),
//        'placeholder'   => __('Vehicle make, e.g. KL59 SEV'),
//        'required'      => true
//    ), $checkout->get_value( 'field_reg' ));
//
//    echo '</div>';
//
//}


/**
 * ac_vehicle_fields extra checkout fields for the order
 */

add_filter( 'woocommerce_checkout_fields', 'ac_vehicle_checkout_fields' );

function ac_vehicle_checkout_fields($fields){
    $fields['ac_vehicle_fields'] = array(
        'ac_vehicle_mileage_field' => array(
            'type' => 'textarea',
            'required'      => true,
            'label' => __( 'Mileage' ),
            'description' =>  __( 'Please provide your current mileage for each vehicle' ),
            'placeholder'   => __('Vehicle mileage, e.g. 50000 miles'),
            'autocomplete' => true,
            'class'         => array('ac-field-class form-row-wide'),
        ),
        'ac_vehicle_make_field' => array(
            'type' => 'textarea',
            'required'      => true,
            'label' => __( 'Vehicle Make' ),
            'description' =>  __( 'Please provide the make of each vehicle' ),
            'placeholder'   => __('Vehicle make, e.g. Toyota'),
            'autocomplete' => true,
            'class'         => array('ac-field-class form-row-wide'),
        ),
        'ac_vehicle_model_field' => array(
            'type' => 'textarea',
            'required'      => true,
            'label' => __( 'Vehicle Model' ),
            'description' =>  __( 'Please provide the model of each vehicle' ),
            'placeholder'   => __('Vehicle model, e.g. Avensis'),
            'autocomplete' => true,
            'class'         => array('ac-field-class form-row-wide')
        ),
        'ac_vehicle_registration_field' => array(
            'type' => 'textarea',
            'required'      => true,
            'label' => __( 'Vehicle Registration' ),
            'description' =>  __( 'Please provide the vehicle registration of each vehicle' ),
            'placeholder'   => __('Vehicle registration, e.g. KL59 SEV'),
            'autocomplete' => true,
            'class'         => array('ac-field-class form-row-wide'),
        ),
    );
    return $fields;
}



/**
 * ac_vehicle_fields save the extra checkout fields for the order
 */

add_action( 'woocommerce_checkout_update_order_meta', 'ac_save_vehicle_fields', 10, 2 );

function ac_save_vehicle_fields( $order_id, $posted ){

    if( isset( $posted['ac_vehicle_mileage_field'] ) ) {
        update_post_meta( $order_id, '_ac_vehicle_mileage_field', sanitize_text_field( $posted['ac_vehicle_mileage_field'] ) );
    }
    if( isset( $posted['ac_vehicle_make_field'] ) ) {
        update_post_meta( $order_id, '_ac_vehicle_make_field', sanitize_text_field( $posted['ac_vehicle_make_field'] ) );
    }
    if( isset( $posted['ac_vehicle_model_field'] ) ) {
        update_post_meta( $order_id, '_ac_vehicle_model_field', sanitize_text_field( $posted['ac_vehicle_model_field'] ) );
    }
    if( isset( $posted['ac_vehicle_registration_field'] ) ) {
        update_post_meta( $order_id, '_ac_vehicle_registration_field', sanitize_text_field( $posted['ac_vehicle_registration_field'] ) );
    }

}

/**
 * ac_print_vehicle_fields print the extra checkout fields before the order notes
 */

add_action( 'woocommerce_before_order_notes' ,'ac_print_vehicle_fields' );

function ac_print_vehicle_fields(){
    $checkout = WC()->checkout(); ?>
    <div class="extra-fields">
        <h3><?php _e( 'Vehicle Information' ); ?></h3>
        <?php
        foreach ( $checkout->checkout_fields['ac_vehicle_fields'] as $key => $field ) : ?>
            <?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>
        <?php endforeach; ?>
    </div>
<?php }

/**
 * ac_display_order_data print the order data on the customer order page
 */

add_action( 'woocommerce_thankyou', 'ac_display_order_data', 20 );
add_action( 'woocommerce_view_order', 'ac_display_order_data', 20 );

function ac_display_order_data( $order_id ){  ?>
    <h2><?php _e( 'Vehicle Information' ); ?></h2>
    <table class="shop_table shop_table_responsive additional_info">
        <tbody>
        <tr>
            <th><?php _e( 'Vehicle Mileage:' ); ?></th>
            <td><?php echo get_post_meta( $order_id, '_ac_vehicle_mileage_field', true ); ?></td>
        </tr>
        <tr>
          <th><?php _e( 'Vehicle Make:' ); ?></th>
          <td><?php echo get_post_meta( $order_id, '_ac_vehicle_make_field', true ); ?></td>
        </tr>
        <tr>
          <th><?php _e( 'Vehicle Model:' ); ?></th>
          <td><?php echo get_post_meta( $order_id, '_ac_vehicle_model_field', true ); ?></td>
        </tr>
        <tr>
          <th><?php _e( 'Vehicle Registration:' ); ?></th>
          <td><?php echo get_post_meta( $order_id, '_ac_vehicle_registration_field', true ); ?></td>
        </tr>
        </tbody>
    </table>
<?php }

/**
 * ac_display_order_data_in_admin print the order data on the admin order page
 */

add_action( 'woocommerce_admin_order_data_after_order_details', 'ac_display_order_data_in_admin' );

function ac_display_order_data_in_admin( $order ){
    $order_id = $order->get_id();
    ?>
    <div class="order_data_column">
        <h4><?php _e( 'Vehicle Information', 'woocommerce' ); ?><a href="#" class="edit_address"><?php _e( 'Edit', 'woocommerce' ); ?></a></h4>
        <div class="address">
            <?php
            echo '<p><strong>' . __( 'Vehicle Mileage' ) . ':</strong>' . get_post_meta( $order_id, '_ac_vehicle_mileage_field', true ) . '</p>';
            echo '<p><strong>' . __( 'Vehicle Make' ) . ':</strong>' . get_post_meta( $order_id, '_ac_vehicle_make_field', true ) . '</p>';
            echo '<p><strong>' . __( 'Vehicle Model' ) . ':</strong>' . get_post_meta( $order_id, '_ac_vehicle_model_field', true ) . '</p>';
            echo '<p><strong>' . __( 'Vehicle Registration' ) . ':</strong>' . get_post_meta( $order_id, '_ac_vehicle_registration_field', true ) . '</p>';
             ?>
        </div>
        <div class="edit_address">
            <?php woocommerce_wp_text_input( array( 'id' => '_ac_vehicle_mileage_field', 'label' => __( 'Vehicle Mileage' ), 'wrapper_class' => '_billing_company_field' ) ); ?>
            <?php woocommerce_wp_text_input( array( 'id' => '_ac_vehicle_make_field', 'label' => __( 'Vehicle Make' ), 'wrapper_class' => '_billing_company_field' ) ); ?>
            <?php woocommerce_wp_text_input( array( 'id' => '_ac_vehicle_model_field', 'label' => __( 'Vehicle Model' ), 'wrapper_class' => '_billing_company_field' ) ); ?>
            <?php woocommerce_wp_text_input( array( 'id' => '_ac_vehicle_registration_field', 'label' => __( 'Vehicle Registration' ), 'wrapper_class' => '_billing_company_field' ) ); ?>

        </div>
    </div>
<?php }


/**
 * ac_save_vehicle_details save the vehicle information from the admin order page
 */

add_action( 'woocommerce_process_shop_order_meta', 'ac_save_vehicle_details', 45, 2 );

function ac_save_vehicle_details( $post_id, $post ){
    update_post_meta( $post_id, '_ac_vehicle_mileage_field', wc_clean( $_POST[ '_ac_vehicle_mileage_field' ] ) );
    update_post_meta( $post_id, '_ac_vehicle_make_field', wc_clean( $_POST[ '_ac_vehicle_make_field' ] ) );
    update_post_meta( $post_id, '_ac_vehicle_model_field', wc_clean( $_POST[ '_ac_vehicle_model_field' ] ) );
    update_post_meta( $post_id, '_ac_vehicle_registration_field', wc_clean( $_POST[ '_ac_vehicle_registration_field' ] ) );

}

/**
 * ac_email_order_meta_fields print the vehicle info on the admin email
 */

add_filter('woocommerce_email_order_meta_fields', 'ac_email_order_meta_fields', 10, 3 );

function ac_email_order_meta_fields( $fields, $sent_to_admin, $order ) {

    $order_id = $order->get_id();

    $fields['vehicle_mileage'] = array(
        'label' => __( 'Vehicle Mileage' ),
        'value' => get_post_meta( $order_id, '_ac_vehicle_mileage_field', true ),
    );
    $fields['vehicle_make'] = array(
        'label' => __( 'Vehicle Make' ),
        'value' => get_post_meta($order_id, '_ac_vehicle_make_field', true ),
    );
    $fields['vehicle_model'] = array(
        'label' => __( 'Vehicle model' ),
        'value' => get_post_meta( $order_id, '_ac_vehicle_model_field', true ),
    );
    $fields['vehicle_registration'] = array(
        'label' => __( 'Vehicle Registration' ),
        'value' => get_post_meta( $order_id, '_ac_vehicle_registration_field', true ),
    );
    return $fields;
}

/**
 * Auto Complete all WooCommerce orders.
 */
add_action( 'woocommerce_thankyou', 'custom_woocommerce_auto_complete_order' );
function custom_woocommerce_auto_complete_order( $order_id ) {
    if ( ! $order_id ) {
        return;
    }

    $order = wc_get_order( $order_id );
    $order->update_status( 'completed' );
}



/**
 * Do not allow any subscriptions to be changed to a new payment method.
 */
//add_filter('woocommerce_can_subscription_be_updated_to_new-payment-method', '__return_false', 100);

/**
 * Do not allow a customer to resubscribe to an expired or cancelled subscription.
 */
//add_filter( 'wcs_can_user_resubscribe_to_subscription', '__return_false', 100 );

/**
 * Do not allow any subscriptions to switched to a different subscription, regardless of settings (more: http://docs.woothemes.com/document/subscriptions/switching-guide/).
 */
//add_filter( 'woocommerce_subscriptions_can_item_be_switched_by_user', '__return_false', 100 );
// OR
//add_filter( 'woocommerce_subscriptions_can_item_be_switched', '__return_false', 100 );


/**
 * Subscriptions Status Changes
 **/

/**
 * Do not allow any subscriptions to be activated or reactivated (not a good idea).
 */
//add_filter( 'woocommerce_can_subscription_be_updated_to_active', '__return_false', 100 );

/**
 * Do not allow any subscription to be cancelled, either by the store manager or customer (not a good idea).
 */

//add_filter( 'woocommerce_can_subscription_be_updated_to_cancelled', '__return_false', 100 );

/**
 * Do not allow any subscription to be suspended, either by the store manager or customer (not a good idea).
 */
//add_filter( 'woocommerce_can_subscription_be_updated_to_on-hold', '__return_false', 100 );

