<?php
/**
 * Created by PhpStorm.
 * User: Richard
 * Date: 29/01/2016
 * Time: 07:06
 */

/**
 * Enqueue scripts and styles.
 */
function _act_scripts() {

//    wp_enqueue_style( '_act-style', get_stylesheet_uri() );
//    wp_enqueue_script( '_act-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );
//    wp_enqueue_script( '_act-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );
//    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
//        wp_enqueue_script( 'comment-reply' );
//    }
}
add_action( 'wp_enqueue_scripts', '_act_scripts' );