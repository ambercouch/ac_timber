<?php

//Add ACF options page
if( function_exists('acf_add_options_page') )
{

    acf_add_options_page(array(
        'page_title' => 'Theme General Settings',
        'menu_title' => 'Theme Settings',
        'menu_slug' => 'theme-general-settings',
        'capability' => 'edit_posts',
        'redirect' => true
    ));

    acf_add_options_sub_page(array(
        'page_title' => 'General Settings',
        'menu_title' => 'General Settings',
        'parent_slug' => 'theme-general-settings',
    ));

    acf_add_options_sub_page(array(
        'page_title' => 'Banner Settings',
        'menu_title' => 'Banner Settings',
        'parent_slug' => 'theme-general-settings',
    ));

//    acf_add_options_sub_page(array(
//        'page_title' 	=> 'Theme Footer Settings',
//        'menu_title'	=> 'Footer',
//        'parent_slug'	=> 'theme-general-settings',
//    ));

}

require_once get_template_directory() . '/lib/acf/acf-options--branding.php';
require_once get_template_directory() . '/lib/acf/acf-options--contact.php';
require_once get_template_directory() . '/lib/acf/acf-options--banner-image.php';
require_once get_template_directory() . '/lib/acf/acf-options--banner-content.php';
require_once get_template_directory() . '/lib/acf/acf-options--footer-info.php';