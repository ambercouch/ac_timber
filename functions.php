<?php
//Love, love, love, love all you functions

require_once get_template_directory() . '/lib/functions--ac-settings.php';
require_once get_template_directory() . '/lib/functions--ac-shortcode.php';
require_once get_template_directory() . '/lib/functions--timber.php';
require_once get_template_directory() . '/lib/functions--theme-setup.php';
require_once get_template_directory() . '/lib/functions--widget-areas.php';
require_once get_template_directory() . '/lib/functions--cpt.php';
require_once get_template_directory() . '/lib/functions--widgets.php';
require_once get_template_directory() . '/lib/acf/functions--acf-options.php';
require_once get_template_directory() . '/lib/acf/functions--acf-page-settings.php';
require_once get_template_directory() . '/lib/functions--template-tags.php';
require_once get_template_directory() . '/lib/admin/functions--admin-clean.php';
require_once get_template_directory() . '/lib/admin/functions--admin-widgets.php';

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

function get_attachment_url_by_title( $title ) {

    $attachment = get_page_by_title($title, OBJECT, 'attachment');
    //print_r($attachment);

    if ( $attachment ){

        $attachment_url = $attachment->guid;

    }else{
        return 'image-not-found';
    }

    return $attachment;
}


