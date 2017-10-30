<?php
//Love, love, love, love all you functions

require_once get_template_directory() . '/lib/functions--ac-settings.php';
require_once get_template_directory() . '/lib/functions--timber.php';
require_once get_template_directory() . '/lib/functions--theme-setup.php';
require_once get_template_directory() . '/lib/functions--template-tags.php';
require_once get_template_directory() . '/lib/functions--widget-areas.php';
require_once get_template_directory() . '/lib/functions--shortcode.php';
require_once get_template_directory() . '/lib/functions--cpt.php';
require_once get_template_directory() . '/lib/acf/functions--acf-options.php';
require_once get_template_directory() . '/lib/admin/functions--admin-clean.php';
require_once get_template_directory() . '/lib/admin/functions--admin-widgets.php';
require_once get_template_directory() . '/lib/functions--tile.php';
require_once get_template_directory() . '/lib/functions--our-work.php';

function my_enqueue($hook) {
//    if ('edit.php' !== $hook) {
//        return;
//    }
    wp_enqueue_script('my_custom_script', get_bloginfo('template_directory') . '/dist/js/adminscript.js');
}

add_action('admin_enqueue_scripts', 'my_enqueue');






