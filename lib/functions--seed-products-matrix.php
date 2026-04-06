<?php

/**
 * Manual, idempotent seed for product rows used in the product matrix.
 */
function act_get_product_matrix_seed_rows() {
    return array(
        array(
            'post_title' => 'Nurture',
            'product_matrix_seed_key' => 'nurture',
            'product_price' => 495,
            'price_frequency' => '/month',
            'matrix_items' => array(
                array( 'feature_key' => 'activity_report', 'matrix_value_type' => 'boolean', 'matrix_enabled' => 1 ),
                array( 'feature_key' => 'adhock_call', 'matrix_value_type' => 'boolean', 'matrix_enabled' => 1 ),
                array( 'feature_key' => 'regular_plugin_updates', 'matrix_value_type' => 'boolean', 'matrix_enabled' => 1 ),
                array( 'feature_key' => 'google_analytics_report', 'matrix_value_type' => 'boolean', 'matrix_enabled' => 1 ),
                array( 'feature_key' => 'accountability_call', 'matrix_value_type' => 'boolean', 'matrix_enabled' => 1 ),
                array( 'feature_key' => 'enquiry_tracker', 'matrix_value_type' => 'text', 'matrix_custom_text' => 'Top 5' ),
                array( 'feature_key' => 'strategy_and_planning_call', 'matrix_value_type' => 'boolean', 'matrix_enabled' => 0 ),
                array( 'feature_key' => 'development_site', 'matrix_value_type' => 'boolean', 'matrix_enabled' => 0 ),
                array( 'feature_key' => 'contact_form_database_backup', 'matrix_value_type' => 'boolean', 'matrix_enabled' => 0 ),
                array( 'feature_key' => 'organic_seo', 'matrix_value_type' => 'text', 'matrix_custom_text' => 'Basic onsite' ),
                array( 'feature_key' => 'creation_of_new_web_pages', 'matrix_value_type' => 'boolean', 'matrix_enabled' => 1 ),
                array( 'feature_key' => 'ppc_assistance_and_planning', 'matrix_value_type' => 'boolean', 'matrix_enabled' => 0 ),
                array( 'feature_key' => 'campaign_landing_pages', 'matrix_value_type' => 'boolean', 'matrix_enabled' => 0 ),
                array( 'feature_key' => 'shared_client_trello_board', 'matrix_value_type' => 'boolean', 'matrix_enabled' => 0 ),
                array( 'feature_key' => 'design_for_print_artwork_creation', 'matrix_value_type' => 'boolean', 'matrix_enabled' => 0 ),
                array( 'feature_key' => 'digital_design_work_for_social_media', 'matrix_value_type' => 'boolean', 'matrix_enabled' => 0 ),
                array( 'feature_key' => 'reduction_on_additional_work', 'matrix_value_type' => 'text', 'matrix_custom_text' => '10%' ),
            ),
        ),
        array(
            'post_title' => 'Grow',
            'product_matrix_seed_key' => 'grow',
            'product_price' => 695,
            'price_frequency' => '/month',
            'matrix_items' => array(
                array( 'feature_key' => 'activity_report', 'matrix_value_type' => 'boolean', 'matrix_enabled' => 1 ),
                array( 'feature_key' => 'adhock_call', 'matrix_value_type' => 'boolean', 'matrix_enabled' => 1 ),
                array( 'feature_key' => 'regular_plugin_updates', 'matrix_value_type' => 'boolean', 'matrix_enabled' => 1 ),
                array( 'feature_key' => 'google_analytics_report', 'matrix_value_type' => 'boolean', 'matrix_enabled' => 1 ),
                array( 'feature_key' => 'accountability_call', 'matrix_value_type' => 'boolean', 'matrix_enabled' => 1 ),
                array( 'feature_key' => 'enquiry_tracker', 'matrix_value_type' => 'text', 'matrix_custom_text' => 'Top 20 / CSV file' ),
                array( 'feature_key' => 'strategy_and_planning_call', 'matrix_value_type' => 'boolean', 'matrix_enabled' => 1 ),
                array( 'feature_key' => 'development_site', 'matrix_value_type' => 'boolean', 'matrix_enabled' => 1 ),
                array( 'feature_key' => 'contact_form_database_backup', 'matrix_value_type' => 'boolean', 'matrix_enabled' => 1 ),
                array( 'feature_key' => 'organic_seo', 'matrix_value_type' => 'text', 'matrix_custom_text' => 'Included' ),
                array( 'feature_key' => 'creation_of_new_web_pages', 'matrix_value_type' => 'boolean', 'matrix_enabled' => 1 ),
                array( 'feature_key' => 'ppc_assistance_and_planning', 'matrix_value_type' => 'boolean', 'matrix_enabled' => 0 ),
                array( 'feature_key' => 'campaign_landing_pages', 'matrix_value_type' => 'boolean', 'matrix_enabled' => 0 ),
                array( 'feature_key' => 'shared_client_trello_board', 'matrix_value_type' => 'boolean', 'matrix_enabled' => 0 ),
                array( 'feature_key' => 'design_for_print_artwork_creation', 'matrix_value_type' => 'boolean', 'matrix_enabled' => 0 ),
                array( 'feature_key' => 'digital_design_work_for_social_media', 'matrix_value_type' => 'boolean', 'matrix_enabled' => 0 ),
                array( 'feature_key' => 'reduction_on_additional_work', 'matrix_value_type' => 'text', 'matrix_custom_text' => '15%' ),
            ),
        ),
        array(
            'post_title' => 'Boost',
            'product_matrix_seed_key' => 'boost',
            'product_price' => 995,
            'price_frequency' => '/month',
            'matrix_items' => array(
                array( 'feature_key' => 'activity_report', 'matrix_value_type' => 'boolean', 'matrix_enabled' => 1 ),
                array( 'feature_key' => 'adhock_call', 'matrix_value_type' => 'boolean', 'matrix_enabled' => 1 ),
                array( 'feature_key' => 'regular_plugin_updates', 'matrix_value_type' => 'boolean', 'matrix_enabled' => 1 ),
                array( 'feature_key' => 'google_analytics_report', 'matrix_value_type' => 'boolean', 'matrix_enabled' => 1 ),
                array( 'feature_key' => 'accountability_call', 'matrix_value_type' => 'boolean', 'matrix_enabled' => 1 ),
                array( 'feature_key' => 'enquiry_tracker', 'matrix_value_type' => 'text', 'matrix_custom_text' => 'All enquiries / shared Excel tracker' ),
                array( 'feature_key' => 'strategy_and_planning_call', 'matrix_value_type' => 'boolean', 'matrix_enabled' => 1 ),
                array( 'feature_key' => 'development_site', 'matrix_value_type' => 'boolean', 'matrix_enabled' => 1 ),
                array( 'feature_key' => 'contact_form_database_backup', 'matrix_value_type' => 'boolean', 'matrix_enabled' => 1 ),
                array( 'feature_key' => 'organic_seo', 'matrix_value_type' => 'text', 'matrix_custom_text' => 'Included' ),
                array( 'feature_key' => 'creation_of_new_web_pages', 'matrix_value_type' => 'boolean', 'matrix_enabled' => 1 ),
                array( 'feature_key' => 'ppc_assistance_and_planning', 'matrix_value_type' => 'boolean', 'matrix_enabled' => 1 ),
                array( 'feature_key' => 'campaign_landing_pages', 'matrix_value_type' => 'boolean', 'matrix_enabled' => 1 ),
                array( 'feature_key' => 'shared_client_trello_board', 'matrix_value_type' => 'boolean', 'matrix_enabled' => 1 ),
                array( 'feature_key' => 'design_for_print_artwork_creation', 'matrix_value_type' => 'boolean', 'matrix_enabled' => 1 ),
                array( 'feature_key' => 'digital_design_work_for_social_media', 'matrix_value_type' => 'boolean', 'matrix_enabled' => 1 ),
                array( 'feature_key' => 'reduction_on_additional_work', 'matrix_value_type' => 'text', 'matrix_custom_text' => '20%' ),
            ),
        ),
    );
}

function act_update_product_matrix_field( $post_id, $field_name, $value ) {
    if ( function_exists( 'update_field' ) ) {
        update_field( $field_name, $value, $post_id );
        return;
    }

    update_post_meta( $post_id, $field_name, $value );
}

function act_get_product_feature_id_map() {
    $feature_posts = get_posts(array(
        'post_type' => 'product_feature',
        'post_status' => 'any',
        'numberposts' => -1,
        'fields' => 'ids',
        'suppress_filters' => true,
    ));

    $feature_id_map = array();

    foreach ( $feature_posts as $feature_post_id ) {
        $feature_key = get_post_meta( $feature_post_id, 'feature_key', true );

        if ( empty( $feature_key ) || isset( $feature_id_map[ $feature_key ] ) ) {
            continue;
        }

        $feature_id_map[ $feature_key ] = (int) $feature_post_id;
    }

    return $feature_id_map;
}

function act_rebuild_product_matrix_items( $post_id, $matrix_rows ) {
    if ( function_exists( 'update_field' ) ) {
        update_field( 'matrix_items', array(), $post_id );
        update_field( 'matrix_items', $matrix_rows, $post_id );
        return;
    }

    $old_count = (int) get_post_meta( $post_id, 'matrix_items', true );

    for ( $row_index = 0; $row_index < $old_count; $row_index++ ) {
        delete_post_meta( $post_id, 'matrix_items_' . $row_index . '_matrix_feature' );
        delete_post_meta( $post_id, 'matrix_items_' . $row_index . '_matrix_value_type' );
        delete_post_meta( $post_id, 'matrix_items_' . $row_index . '_matrix_enabled' );
        delete_post_meta( $post_id, 'matrix_items_' . $row_index . '_matrix_custom_text' );
        delete_post_meta( $post_id, 'matrix_items_' . $row_index . '_matrix_note' );
    }

    delete_post_meta( $post_id, 'matrix_items' );

    foreach ( $matrix_rows as $row_index => $matrix_row ) {
        update_post_meta( $post_id, 'matrix_items_' . $row_index . '_matrix_feature', (int) $matrix_row['matrix_feature'] );
        update_post_meta( $post_id, 'matrix_items_' . $row_index . '_matrix_value_type', $matrix_row['matrix_value_type'] );
        update_post_meta( $post_id, 'matrix_items_' . $row_index . '_matrix_enabled', isset( $matrix_row['matrix_enabled'] ) ? (int) $matrix_row['matrix_enabled'] : 0 );
        update_post_meta( $post_id, 'matrix_items_' . $row_index . '_matrix_custom_text', isset( $matrix_row['matrix_custom_text'] ) ? $matrix_row['matrix_custom_text'] : '' );
        update_post_meta( $post_id, 'matrix_items_' . $row_index . '_matrix_note', '' );
    }

    update_post_meta( $post_id, 'matrix_items', count( $matrix_rows ) );
}

function act_seed_products_for_matrix() {
    $products = act_get_product_matrix_seed_rows();
    $feature_id_map = act_get_product_feature_id_map();

    $created = 0;
    $updated = 0;
    $missing_feature_keys = array();
    $skipped_rows = array();

    foreach ( $products as $product ) {
        $existing_posts = get_posts(array(
            'post_type' => 'product',
            'post_status' => 'any',
            'meta_key' => 'product_matrix_seed_key',
            'meta_value' => $product['product_matrix_seed_key'],
            'numberposts' => 1,
            'fields' => 'ids',
            'suppress_filters' => true,
        ));

        $post_data = array(
            'post_type' => 'product',
            'post_title' => $product['post_title'],
            'post_status' => 'publish',
        );

        if ( ! empty( $existing_posts ) ) {
            $post_data['ID'] = (int) $existing_posts[0];
            $post_id = wp_update_post( $post_data, true );

            if ( is_wp_error( $post_id ) ) {
                continue;
            }

            $updated++;
        } else {
            $post_id = wp_insert_post( $post_data, true );

            if ( is_wp_error( $post_id ) ) {
                continue;
            }

            $created++;
        }

        $matrix_rows = array();

        foreach ( $product['matrix_items'] as $row_index => $row ) {
            if ( empty( $feature_id_map[ $row['feature_key'] ] ) ) {
                $missing_feature_keys[ $row['feature_key'] ] = true;
                $skipped_rows[] = $product['product_matrix_seed_key'] . ':' . ( $row_index + 1 ) . ':' . $row['feature_key'];
                continue;
            }

            $matrix_row = array(
                'matrix_feature' => (int) $feature_id_map[ $row['feature_key'] ],
                'matrix_value_type' => $row['matrix_value_type'],
                'matrix_enabled' => isset( $row['matrix_enabled'] ) ? (int) $row['matrix_enabled'] : 0,
                'matrix_custom_text' => isset( $row['matrix_custom_text'] ) ? $row['matrix_custom_text'] : '',
                'matrix_note' => '',
            );

            $matrix_rows[] = $matrix_row;
        }

        act_update_product_matrix_field( $post_id, 'product_price', $product['product_price'] );
        act_update_product_matrix_field( $post_id, 'price_frequency', $product['price_frequency'] );
        act_update_product_matrix_field( $post_id, 'product_matrix_seed_key', $product['product_matrix_seed_key'] );
        act_rebuild_product_matrix_items( $post_id, $matrix_rows );
    }

    return array(
        'created' => $created,
        'updated' => $updated,
        'total' => count( $products ),
        'missing_feature_keys' => array_keys( $missing_feature_keys ),
        'skipped_rows' => $skipped_rows,
    );
}

function act_run_product_matrix_seed_from_admin() {
    if ( ! is_admin() || ! current_user_can( 'manage_options' ) ) {
        return;
    }

    if ( empty( $_GET['ac_seed_products_matrix'] ) ) {
        return;
    }

    if ( empty( $_GET['_ac_seed_products_matrix_nonce'] ) || ! wp_verify_nonce( $_GET['_ac_seed_products_matrix_nonce'], 'ac_seed_products_matrix' ) ) {
        wp_die( 'Invalid product matrix seed request.' );
    }

    $results = act_seed_products_for_matrix();

    $redirect_url = add_query_arg(array(
        'post_type' => 'product',
        'ac_seed_products_matrix_done' => 1,
        'ac_seed_products_created' => (int) $results['created'],
        'ac_seed_products_updated' => (int) $results['updated'],
        'ac_seed_products_total' => (int) $results['total'],
        'ac_seed_products_missing_keys' => implode( ',', $results['missing_feature_keys'] ),
        'ac_seed_products_skipped_count' => count( $results['skipped_rows'] ),
    ), admin_url( 'edit.php' ));

    wp_safe_redirect( $redirect_url );
    exit;
}
add_action( 'admin_init', 'act_run_product_matrix_seed_from_admin' );

function act_product_matrix_seed_admin_notice() {
    if ( ! is_admin() || ! current_user_can( 'manage_options' ) ) {
        return;
    }

    if ( empty( $_GET['post_type'] ) || 'product' !== $_GET['post_type'] ) {
        return;
    }

    if ( ! empty( $_GET['ac_seed_products_matrix_done'] ) ) {
        $created = isset( $_GET['ac_seed_products_created'] ) ? (int) $_GET['ac_seed_products_created'] : 0;
        $updated = isset( $_GET['ac_seed_products_updated'] ) ? (int) $_GET['ac_seed_products_updated'] : 0;
        $total = isset( $_GET['ac_seed_products_total'] ) ? (int) $_GET['ac_seed_products_total'] : 0;
        $missing_feature_keys = isset( $_GET['ac_seed_products_missing_keys'] ) ? sanitize_text_field( wp_unslash( $_GET['ac_seed_products_missing_keys'] ) ) : '';
        $skipped_count = isset( $_GET['ac_seed_products_skipped_count'] ) ? (int) $_GET['ac_seed_products_skipped_count'] : 0;

        echo '<div class="notice notice-success is-dismissible"><p>';
        echo esc_html( sprintf( 'Product matrix seed complete. Created: %1$d, Updated: %2$d, Total processed: %3$d, Rows skipped: %4$d.', $created, $updated, $total, $skipped_count ) );
        echo '</p>';

        if ( ! empty( $missing_feature_keys ) ) {
            echo '<p>' . esc_html( 'Missing product_feature keys: ' . $missing_feature_keys ) . '</p>';
        }

        echo '</div>';
    }

    $seed_url = wp_nonce_url(
        add_query_arg(
            array(
                'ac_seed_products_matrix' => 1,
            ),
            admin_url( 'edit.php?post_type=product' )
        ),
        'ac_seed_products_matrix',
        '_ac_seed_products_matrix_nonce'
    );

    echo '<div class="notice notice-info"><p>';
    echo 'Need to seed the Nurture/Grow/Boost product matrix rows? ';
    echo '<a href="' . esc_url( $seed_url ) . '">Run Product Matrix Seed</a>.';
    echo '</p></div>';
}
add_action( 'admin_notices', 'act_product_matrix_seed_admin_notice' );
