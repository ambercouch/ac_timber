<?php
//Love, love, love, love all you functions

require_once get_template_directory() . '/lib/functions--ac-menus.php';

require_once get_template_directory() . '/lib/functions--ac-settings.php';
require_once get_template_directory() . '/lib/functions--ac-shortcode.php';
require_once get_template_directory() . '/lib/functions--timber.php';
require_once get_template_directory() . '/lib/functions--theme-setup.php';
require_once get_template_directory() . '/lib/functions--widget-areas.php';
require_once get_template_directory() . '/lib/functions--cpt.php';
require_once get_template_directory() . '/lib/functions--widgets.php';

require_once get_template_directory() . '/lib/acf/functions--acf-options.php';
require_once get_template_directory() . '/lib/acf/functions--acf-page-settings.php';
require_once get_template_directory() . '/lib/acf/functions--acf-service-category.php';

require_once get_template_directory() . '/lib/functions--template-tags.php';
require_once get_template_directory() . '/lib/admin/functions--admin-clean.php';
require_once get_template_directory() . '/lib/admin/functions--admin-widgets.php';
require_once get_template_directory() . '/lib/admin/functions--cpt-tax-filter.php';


new Tax_CTP_Filter(array(
    'service' => array('service_category')
));

//sets the service order to menu_order on the service type archive
add_action( 'pre_get_posts', 'my_change_sort_order');
function my_change_sort_order($query){
    if(is_archive()):
        //If you wanted it for the archive of a custom post type use: is_post_type_archive( $post_type )
        //Set the order ASC or DESC
        $query->set( 'order', 'ASC' );
        //Set the orderby
        $query->set( 'orderby', 'menu_order' );
    endif;
};

// Remove <p> and <br/> from Contact Form 7
add_filter('wpcf7_autop_or_not', '__return_false');



