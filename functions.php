<?php

// Load Composer dependencies.
require_once __DIR__ . '/vendor/autoload.php';

$timber = new Timber\Timber();

//Love, love, love, love all you functions
require_once get_template_directory() . '/lib/functions--ac-sidebars.php';
require_once get_template_directory() . '/lib/functions--ac-menus.php';
require_once get_template_directory() . '/lib/functions--ac-settings.php';

require_once get_template_directory() . '/lib/functions--timber.php';
//require_once get_template_directory() . '/lib/functions--theme-setup.php';

require_once get_template_directory() . '/lib/functions--ac-shortcode.php';
require_once get_template_directory() . '/lib/functions--widget-areas.php';
require_once get_template_directory() . '/lib/functions--widgets.php';


require_once get_template_directory() . '/lib/functions--acf.php';
require_once get_template_directory() . '/lib/acf/functions--acf-options.php';
require_once get_template_directory() . '/lib/acf/functions--acf-video-settings.php';
require_once get_template_directory() . '/lib/acf/functions--acf-page-settings.php';
require_once get_template_directory() . '/lib/acf/functions--acf-service-settings.php';
require_once get_template_directory() . '/lib/acf/functions--acf-project-settings.php';
require_once get_template_directory() . '/lib/acf/functions--acf-post-title-settings.php';
require_once get_template_directory() . '/lib/acf/functions--acf-page-content.php';
require_once get_template_directory() . '/lib/acf/functions--acf-menu-items.php';
require_once get_template_directory() . '/lib/acf/functions--acf-page-banner-image.php';
require_once get_template_directory() . '/lib/acf/functions--acf-testimonial-info.php';
require_once get_template_directory() . '/lib/acf/functions--acf-season-settings.php';

require_once get_template_directory() . '/lib/acf/act-acf-team-member.php';




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
 * PMP functions
 */

function redirect_to_members_homepage($redirect_to, $request, $user) {
    // Check if the user has an active membership
    if (pmpro_hasMembershipLevel(null, $user->ID)) {
        return site_url('/this-season');
    }
    return $redirect_to;
}
add_filter('login_redirect', 'redirect_to_members_homepage', 10, 3);

function redirect_after_registration($user_id) {
    // Check if the new user has an active membership
    if (pmpro_hasMembershipLevel(null, $user_id)) {
        wp_set_auth_cookie($user_id, true);
        wp_redirect(site_url('/this-season'));
        exit();
    }
}
add_action('user_register', 'redirect_after_registration');


function redirect_logged_in_users_from_homepage() {
    // Check if the user is logged in, not an admin, and if they have an active membership
    if (is_user_logged_in() && is_front_page() && !current_user_can('administrator') && pmpro_hasMembershipLevel(null, get_current_user_id())) {
        wp_redirect(site_url('/this-season'));
        exit();
    }
}
add_action('template_redirect', 'redirect_logged_in_users_from_homepage');


function get_current_season() {
    // Get today's date in Ymd format
    $today = date('Ymd');

    // Query arguments
    $args = array(
        'post_type' => 'season',
        'posts_per_page' => 1,
        'meta_query' => array(
            'relation' => 'AND',
            array(
                'key' => 'season_start_date',
                'value' => $today,
                'compare' => '<=',
                'type' => 'DATE'
            ),
            array(
                'key' => 'season_end_date',
                'value' => $today,
                'compare' => '>=',
                'type' => 'DATE'
            )
        )
    );

    // Custom query
    $query = new WP_Query($args);

    // Start output buffering
    ob_start();

    // Check if we have posts
    if ($query->have_posts()) {
        // Load the template file
        while ($query->have_posts()) {
            $query->the_post();
            if ( function_exists( 'pmpro_has_membership_access' ) ) {
                global $post;

                // Check if the user has access to the current post/page
                if ( ! pmpro_has_membership_access( $post->ID ) ) {
                    // If the user doesn't have access, redirect to /seasons/
                    wp_redirect( home_url( '/seasons/' ) );
                    exit; // Always use exit after a redirect to stop further script execution
                }
            }
            include(locate_template('season-template.php'));
        }
        wp_reset_postdata();
    } else {
        echo 'No current season found';
    }

    // Return the buffered content
    return ob_get_clean();
}

// Register shortcode
add_shortcode('act_current_season', 'get_current_season');

function enable_excerpts_for_learndash_courses() {
    add_post_type_support('sfwd-courses', 'excerpt');
}
add_action('init', 'enable_excerpts_for_learndash_courses');

function my_remove_pmp_content_filter_on_archives() {
    if ( is_archive() ) {
        remove_filter( 'the_content', 'pmpro_membership_content_filter', 5 );
    }
}
add_action( 'wp', 'my_remove_pmp_content_filter_on_archives' );



