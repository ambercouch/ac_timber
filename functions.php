<?php

//Love, love, love, love all you functions
use Timber\PostQuery;

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
require_once get_template_directory() . '/lib/acf/functions-acf-mxb.php';


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
        'page-templates/mxb-home.php',
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

add_action( 'acf/input/admin_enqueue_scripts', function() {
    wp_enqueue_script( 'acf-custom-colors', get_template_directory_uri() . '/assets/js/admin/aw-colours.js', 'acf-input', '1.0', true );
});


/*
 * Load more functions
 */

function misha_my_load_more_scripts() {

    global $wp_query;
    global $gallery_item_show;

    $wp_query->set('posts_per_page', $gallery_item_show);

    // In most cases it is already included on the page and this line can be removed
    wp_enqueue_script('jquery');

    // register our main script but do not enqueue it yet
    wp_register_script( 'ac_timber', get_stylesheet_directory_uri() . '/dist/js/main.js', array('jquery'), '20210827-1', true );

    // now the most interesting part
    // we have to pass parameters to myloadmore.js script but we can get the parameters values only in PHP
    // you can define variables directly in your HTML but I decided that the most proper way is wp_localize_script()
    wp_localize_script( 'ac_timber', 'ac_timber_params', array(
        'ajaxurl' => admin_url( 'admin-ajax.php' ), // WordPress AJAX
        'posts' => json_encode( $wp_query->query_vars ), // everything about your loop is here
        'current_page' => get_query_var( 'paged' ) ? get_query_var('paged') : 1,
        'max_page' => $wp_query->max_num_pages
    ) );

    wp_enqueue_script( 'ac_timber' );
}

add_action( 'wp_enqueue_scripts', 'misha_my_load_more_scripts' );

function ac_loadmore_ajax_handler(){

    // prepare our arguments for the query
    $args = json_decode( stripslashes( $_POST['query'] ), true );
    $args['paged'] = $_POST['page'] + 1; // we need next page to be loaded
    $args['post_status'] = 'publish';

    // it is always better to use WP_Query but not here
    query_posts( $args );

    $query_object = get_queried_object();

    if($query_object->name == 'gallery-item' || $query_object->taxonomy == 'gallery-type'){
        $loop_template = 'content-loop.twig';
    }
    elseif ($query_object->name == 'Podcast' && $query_object->taxonomy == 'category'){
            $loop_template =  'content-loop-cat-pod.twig';
    }
    else {
        $loop_template =  'content-loop-blog.twig';
    }

    if(class_exists('Timber')){
        $context = Timber::get_context();
        $context['posts'] = new Timber\PostQuery();
        $templates = array( $loop_template );
        ob_start();
        Timber::render( $templates, $context );
        $ob = ob_get_contents();
        ob_end_clean();
    }else{
        ob_start();
        ?>
        <?php echo "<p>The Timber plugin is not active.<br> Activate Timber or set <code>timber='false'</code> in the short code</p>" ?>
        <?php
        $ob = ob_get_contents();
        ob_end_clean();
    }

    echo $ob;

    die; // here we exit the script and even no wp_reset_query() required!
}

add_action('wp_ajax_loadmore', 'ac_loadmore_ajax_handler'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_loadmore', 'ac_loadmore_ajax_handler'); // wp_ajax_nopriv_{action}


add_filter('wpcf7_autop_or_not', '__return_false');

add_filter( 'wp_theme_editor_filetypes', function( $filetypes ) {
    $filetypes[] = 'twig';
    return $filetypes;
} );
