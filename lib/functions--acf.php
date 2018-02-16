<?php
// CUSTOM FIELDS
// We embed Advanced Custom Fields sometimes to try and integrate things a bit more into the theme folder.
define('ACT_AFC_PATH', '/lib/acfp/' );
add_filter('acf/settings/path', 'my_acf_settings_path');
function my_acf_settings_path( $path ) {
    $path = get_stylesheet_directory() . ACT_AFC_PATH;
    return $path;
}
add_filter('acf/settings/dir', 'my_acf_settings_dir');
function my_acf_settings_dir( $dir ) {
    $dir = get_stylesheet_directory_uri() . ACT_AFC_PATH;
    return $dir;
}
//add_filter('acf/settings/show_admin', '__return_false');
include_once( get_stylesheet_directory() . ACT_AFC_PATH . 'acf.php' );
if( function_exists('acf_set_options_page_title') ) {
    acf_set_options_page_title( __('Options') );
}