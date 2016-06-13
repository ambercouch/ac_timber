<?php
//Love, love, love, love all you functions

require_once get_template_directory() . '/lib/functions--ac-settings.php';
require_once get_template_directory() . '/lib/functions--timber.php';
require_once get_template_directory() . '/lib/functions--theme-setup.php';
require_once get_template_directory() . '/lib/functions--template-tags.php';
require_once get_template_directory() . '/lib/functions--widget-areas.php';
require_once get_template_directory() . '/lib/functions--shortcode.php';
require_once get_template_directory() . '/lib/functions--cpt.php';
require_once get_template_directory() . '/lib/functions--tile.php';
require_once get_template_directory() . '/lib/functions--our-work.php';


//Add archive links to menus
add_action('admin_head-nav-menus.php', 'wpclean_add_metabox_menu_posttype_archive');

function wpclean_add_metabox_menu_posttype_archive() {
    add_meta_box('wpclean-metabox-nav-menu-posttype', 'Custom Post Type Archives', 'wpclean_metabox_menu_posttype_archive', 'nav-menus', 'side', 'default');
}

function wpclean_metabox_menu_posttype_archive() {
    $post_types = get_post_types(array('show_in_nav_menus' => true, 'has_archive' => true), 'object');

    if ($post_types) :
        $items = array();
        $loop_index = 999999;

        foreach ($post_types as $post_type) {
            $item = new stdClass();
            $loop_index++;

            $item->object_id = $loop_index;
            $item->db_id = 0;
            $item->object = 'post_type_' . $post_type->query_var;
            $item->menu_item_parent = 0;
            $item->type = 'custom';
            $item->title = $post_type->labels->name;
            $item->url = get_post_type_archive_link($post_type->query_var);
            $item->target = '';
            $item->attr_title = '';
            $item->classes = array();
            $item->xfn = '';

            $items[] = $item;
        }

        $walker = new Walker_Nav_Menu_Checklist(array());

        echo '<div id="posttype-archive" class="posttypediv">';
        echo '<div id="tabs-panel-posttype-archive" class="tabs-panel tabs-panel-active">';
        echo '<ul id="posttype-archive-checklist" class="categorychecklist form-no-clear">';
        echo walk_nav_menu_tree(array_map('wp_setup_nav_menu_item', $items), 0, (object) array('walker' => $walker));
        echo '</ul>';
        echo '</div>';
        echo '</div>';

        echo '<p class="button-controls">';
        echo '<span class="add-to-menu">';
        echo '<input type="submit"' . disabled(1, 0) . ' class="button-secondary submit-add-to-menu right" value="' . __('Add to Menu', 'andromedamedia') . '" name="add-posttype-archive-menu-item" id="submit-posttype-archive" />';
        echo '<span class="spinner"></span>';
        echo '</span>';
        echo '</p>';

    endif;
}

//Add ACF options page
if( function_exists('acf_add_options_page') ) {

    acf_add_options_page(array(
        'page_title' 	=> 'Theme General Settings',
        'menu_title'	=> 'TVB Settings',
        'menu_slug' 	=> 'theme-general-settings',
        'capability'	=> 'edit_posts',
        'redirect'		=> true
    ));

    acf_add_options_sub_page(array(
        'page_title' 	=> 'General Settings',
        'menu_title'	=> 'General Settings',
        'parent_slug'	=> 'theme-general-settings',
    ));

    acf_add_options_sub_page(array(
        'page_title' 	=> 'Banner Settings',
        'menu_title'	=> 'Banner Settings',
        'parent_slug'	=> 'theme-general-settings',
    ));

//    acf_add_options_sub_page(array(
//        'page_title' 	=> 'Theme Footer Settings',
//        'menu_title'	=> 'Footer',
//        'parent_slug'	=> 'theme-general-settings',
//    ));

}

// disable default dashboard widgets
function disable_default_dashboard_widgets() {
    global $wp_meta_boxes;
    // unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);    // Right Now Widget
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity']);        // Activity Widget
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']); // Comments Widget
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);  // Incoming Links Widget
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);

    // unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);    // Quick Press Widget
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']);     // Recent Drafts Widget
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);           //
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);       //
    // remove plugin dashboard boxes
    unset($wp_meta_boxes['dashboard']['normal']['core']['yoast_db_widget']);           // Yoast's SEO Plugin Widget
    unset($wp_meta_boxes['dashboard']['normal']['core']['rg_forms_dashboard']);        // Gravity Forms Plugin Widget
    unset($wp_meta_boxes['dashboard']['normal']['core']['bbp-dashboard-right-now']);   // bbPress Plugin Widget

}

add_action( 'wp_dashboard_setup', 'disable_default_dashboard_widgets' );

