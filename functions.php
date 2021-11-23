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
    wp_enqueue_style('ac-admin-theme', get_stylesheet_directory_uri().'/assets/css/ac-admin.css');
}
add_action('admin_enqueue_scripts', 'my_admin_theme_style');
add_action('login_enqueue_scripts', 'my_admin_theme_style');


function act_disable_editor( $id = false ) {

    $excluded_templates = array(
        //'page-templates/mxb-home.php',
    );

    $excluded_ids = array(
        get_option( 'page_on_front' )
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

/**
 * Plugin Name: Testing ctrl+s and ctrl+p for saving and publishing posts.
 * Plugin URI:  https://wordpress.stackexchange.com/a/199411/26350
 */
add_action( 'after_wp_tiny_mce', function()
{?><script>
    ( function ( $ ) {
        'use strict';
        $( window ).load( function () {
            wpse.init();
        });
        var wpse = {
            keydown : function (e) {
                if( e.ctrlKey && 83 === e.which ) {
                    // ctrl+s for "Save Draft"
                    e.preventDefault();
                    $( '#save-post' ).trigger( 'click' );
                } else if ( e.ctrlKey && 80 === e.which ) {
                    // ctrl+p for "Publish" or "Update"
                    e.preventDefault();
                    $( '#publish' ).trigger( 'click' );
                }
            },
            set_keydown_for_document : function() {
                $(document).on( 'keydown', wpse.keydown );
            },
            set_keydown_for_tinymce : function() {
                if( typeof tinymce == 'undefined' )
                    return;
                for (var i = 0; i < tinymce.editors.length; i++)
                    tinymce.editors[i].on( 'keydown', wpse.keydown );
            },
            init : function() {
                wpse.set_keydown_for_document();
                wpse.set_keydown_for_tinymce();
            }
        }
    } ( jQuery ) );
</script><?php });

