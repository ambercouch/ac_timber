<?php

/**
 * Manual, idempotent seed for product_feature rows.
 */
function act_get_product_feature_seed_rows() {
    return array(
        array(
            'title' => 'Activity Report',
            'feature_key' => 'activity_report',
            'value_mode' => 'boolean',
            'feature_group' => 'reporting',
        ),
        array(
            'title' => 'Adhock call',
            'feature_key' => 'adhock_call',
            'value_mode' => 'boolean',
            'feature_group' => 'support',
        ),
        array(
            'title' => 'Regular plugin updates',
            'feature_key' => 'regular_plugin_updates',
            'value_mode' => 'boolean',
            'feature_group' => 'development',
        ),
        array(
            'title' => 'Google Analytics report',
            'feature_key' => 'google_analytics_report',
            'value_mode' => 'boolean',
            'feature_group' => 'reporting',
        ),
        array(
            'title' => 'Accountability Call',
            'feature_key' => 'accountability_call',
            'value_mode' => 'boolean',
            'feature_group' => 'support',
        ),
        array(
            'title' => 'Enquiry tracker',
            'feature_key' => 'enquiry_tracker',
            'value_mode' => 'text',
            'feature_group' => 'reporting',
        ),
        array(
            'title' => 'Strategy and planning call',
            'feature_key' => 'strategy_and_planning_call',
            'value_mode' => 'boolean',
            'feature_group' => 'support',
        ),
        array(
            'title' => 'Development site (additional to your live site)',
            'feature_key' => 'development_site',
            'value_mode' => 'boolean',
            'feature_group' => 'development',
        ),
        array(
            'title' => 'Contact form database to back up your website enquiries',
            'feature_key' => 'contact_form_database_backup',
            'value_mode' => 'boolean',
            'feature_group' => 'development',
        ),
        array(
            'title' => 'Organic SEO',
            'feature_key' => 'organic_seo',
            'value_mode' => 'text',
            'feature_group' => 'marketing',
        ),
        array(
            'title' => 'Creation of new web pages',
            'feature_key' => 'creation_of_new_web_pages',
            'value_mode' => 'boolean',
            'feature_group' => 'development',
        ),
        array(
            'title' => 'PPC Assistance and planning',
            'feature_key' => 'ppc_assistance_and_planning',
            'value_mode' => 'boolean',
            'feature_group' => 'marketing',
        ),
        array(
            'title' => 'Creation of landing pages for dedicated campaigns',
            'feature_key' => 'campaign_landing_pages',
            'value_mode' => 'boolean',
            'feature_group' => 'marketing',
        ),
        array(
            'title' => 'Shared client trello board for task tracking and accountability',
            'feature_key' => 'shared_client_trello_board',
            'value_mode' => 'boolean',
            'feature_group' => 'support',
        ),
        array(
            'title' => 'Design for print artwork creation*',
            'feature_key' => 'design_for_print_artwork_creation',
            'value_mode' => 'boolean',
            'feature_group' => 'marketing',
        ),
        array(
            'title' => 'Digital Design work for social media*',
            'feature_key' => 'digital_design_work_for_social_media',
            'value_mode' => 'boolean',
            'feature_group' => 'marketing',
        ),
        array(
            'title' => 'Reduction on additional work',
            'feature_key' => 'reduction_on_additional_work',
            'value_mode' => 'text',
            'feature_group' => 'pricing',
        ),
    );
}

function act_update_product_feature_field( $post_id, $field_name, $value ) {
    if ( function_exists( 'update_field' ) ) {
        update_field( $field_name, $value, $post_id );
        return;
    }

    update_post_meta( $post_id, $field_name, $value );
}

function act_seed_product_features() {
    $rows = act_get_product_feature_seed_rows();

    $created = 0;
    $updated = 0;

    foreach ( $rows as $menu_order => $row ) {
        $existing_posts = get_posts(array(
            'post_type' => 'product_feature',
            'post_status' => 'any',
            'meta_key' => 'feature_key',
            'meta_value' => $row['feature_key'],
            'numberposts' => 1,
            'fields' => 'ids',
            'suppress_filters' => true,
        ));

        $post_data = array(
            'post_type' => 'product_feature',
            'post_title' => $row['title'],
            'menu_order' => $menu_order,
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

        act_update_product_feature_field( $post_id, 'feature_key', $row['feature_key'] );
        act_update_product_feature_field( $post_id, 'feature_label', $row['title'] );
        act_update_product_feature_field( $post_id, 'feature_short_label', '' );
        act_update_product_feature_field( $post_id, 'feature_description', '' );
        act_update_product_feature_field( $post_id, 'value_mode', $row['value_mode'] );
        act_update_product_feature_field( $post_id, 'feature_group', $row['feature_group'] );
        act_update_product_feature_field( $post_id, 'highlight_feature', 0 );
        act_update_product_feature_field( $post_id, 'admin_notes', '' );
    }

    return array(
        'created' => $created,
        'updated' => $updated,
        'total' => count( $rows ),
    );
}

function act_run_product_feature_seed_from_admin() {
    if ( ! is_admin() || ! current_user_can( 'manage_options' ) ) {
        return;
    }

    if ( empty( $_GET['ac_seed_product_features'] ) ) {
        return;
    }

    if ( empty( $_GET['_ac_seed_nonce'] ) || ! wp_verify_nonce( $_GET['_ac_seed_nonce'], 'ac_seed_product_features' ) ) {
        wp_die( 'Invalid product feature seed request.' );
    }

    $results = act_seed_product_features();

    $redirect_url = add_query_arg(array(
        'post_type' => 'product_feature',
        'ac_seed_product_features_done' => 1,
        'ac_seed_created' => (int) $results['created'],
        'ac_seed_updated' => (int) $results['updated'],
        'ac_seed_total' => (int) $results['total'],
    ), admin_url( 'edit.php' ));

    wp_safe_redirect( $redirect_url );
    exit;
}
add_action( 'admin_init', 'act_run_product_feature_seed_from_admin' );

function act_product_feature_seed_admin_notice() {
    if ( ! is_admin() || ! current_user_can( 'manage_options' ) ) {
        return;
    }

    if ( empty( $_GET['post_type'] ) || 'product_feature' !== $_GET['post_type'] ) {
        return;
    }

    if ( ! empty( $_GET['ac_seed_product_features_done'] ) ) {
        $created = isset( $_GET['ac_seed_created'] ) ? (int) $_GET['ac_seed_created'] : 0;
        $updated = isset( $_GET['ac_seed_updated'] ) ? (int) $_GET['ac_seed_updated'] : 0;
        $total = isset( $_GET['ac_seed_total'] ) ? (int) $_GET['ac_seed_total'] : 0;

        echo '<div class="notice notice-success is-dismissible"><p>';
        echo esc_html( sprintf( 'Product feature seed complete. Created: %1$d, Updated: %2$d, Total processed: %3$d.', $created, $updated, $total ) );
        echo '</p></div>';
    }

    $seed_url = wp_nonce_url(
        add_query_arg(
            array(
                'ac_seed_product_features' => 1,
            ),
            admin_url( 'edit.php?post_type=product_feature' )
        ),
        'ac_seed_product_features',
        '_ac_seed_nonce'
    );

    echo '<div class="notice notice-info"><p>';
    echo 'Need to seed product features from the approved matrix? ';
    echo '<a href="' . esc_url( $seed_url ) . '">Run Product Feature Seed</a>.';
    echo '</p></div>';
}
add_action( 'admin_notices', 'act_product_feature_seed_admin_notice' );
