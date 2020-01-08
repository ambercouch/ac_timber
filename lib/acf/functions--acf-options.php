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
        'page_title' => 'Global Settings',
        'menu_title' => 'Global',
        'parent_slug' => 'theme-general-settings',
    ));

    acf_add_options_sub_page(array(
        'page_title' => 'Masthead Settings',
        'menu_title' => 'Masthead',
        'parent_slug' => 'theme-general-settings',
    ));

    acf_add_options_sub_page(array(
        'page_title' => 'Hero Banner Settings',
        'menu_title' => 'Hero Banner',
        'parent_slug' => 'theme-general-settings',
    ));

//    acf_add_options_sub_page(array(
//        'page_title' => 'Page Settings',
//        'menu_title' => 'Page',
//        'parent_slug' => 'theme-general-settings',
//    ));

    acf_add_options_sub_page(array(
        'page_title' => 'Service Settings',
        'menu_title' => 'Service',
        'parent_slug' => 'theme-general-settings',
    ));

    acf_add_options_sub_page(array(
        'page_title' => 'Theme Integrations',
        'menu_title' => 'Theme Integrations',
        'parent_slug' => 'theme-general-settings',
    ));

    acf_add_options_page(array(
        'page_title' => 'Company Settings',
        'menu_title' => 'Company Settings',
        'menu_slug' => 'company-settings',
        'capability' => 'edit_posts',
        'redirect' => true
    ));

    acf_add_options_sub_page(array(
        'page_title' => 'Company Settings',
        'menu_title' => 'General',
        'parent_slug' => 'company-settings',
    ));

}
require_once get_template_directory() . '/lib/acf/acf-options--global-page.php';
require_once get_template_directory() . '/lib/acf/acf-options--theme-integration.php';
require_once get_template_directory() . '/lib/acf/acf-options--masthead.php';
require_once get_template_directory() . '/lib/acf/acf-options--branding.php';
require_once get_template_directory() . '/lib/acf/acf-options--contact.php';
require_once get_template_directory() . '/lib/acf/acf-options--banner-hero.php';
require_once get_template_directory() . '/lib/acf/acf-options--banner-image.php';
require_once get_template_directory() . '/lib/acf/acf-options--banner-content.php';
require_once get_template_directory() . '/lib/acf/acf-options--banner-menu.php';
require_once get_template_directory() . '/lib/acf/acf-options--footer-info.php';
require_once get_template_directory() . '/lib/acf/acf-options--company-info.php';
require_once get_template_directory() . '/lib/acf/acf-options--service-menu.php';
